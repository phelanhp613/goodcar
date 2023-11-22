<?php

namespace Modules\Order\Repositories;

use App\Commons\SMS\Services\CMCSMSService;
use App\Jobs\SendMailJob;
use App\Jobs\ZaloNotifyJob;
use Exception;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Order\Models\Order;
use Modules\Product\Repositories\ProductVariantRepository;
use Modules\Setting\Models\MailConfig;
use Modules\Setting\Models\Setting;

class OrderService implements BaseServiceInterface
{
	private $moduleRepository;

	private $productVariantRepository;

	private $orderDetailRepository;

	private $customerRepository;

	private $sendSMSService;

	public function __construct(
		OrderRepository $moduleRepository,
		OrderDetailRepository $orderDetailRepository,
		ProductVariantRepository $productVariantRepository,
		CMCSMSService $CMCSMSService,
		CustomerRepository $customerRepository
	) {
		$this->moduleRepository         = $moduleRepository;
		$this->productVariantRepository = $productVariantRepository;
		$this->orderDetailRepository    = $orderDetailRepository;
		$this->customerRepository       = $customerRepository;
		$this->sendSMSService           = $CMCSMSService;
	}

	public function list($data)
	{
		return $this->moduleRepository->paginate($data);
	}

	/**
	 * @param $data
	 *
	 * @return bool|void
	 */
	public function create($data)
	{
		DB::beginTransaction();
		try {
			if(!empty($data['invoice']['status'])) {
				$data['invoice_info'] = [
					'type' => $data['invoice']['type'],
					'data' => $data['invoice'][$data['invoice']['type']],
				];

				$data['invoice_info'] = json_encode($data['invoice_info']);
			}
			unset($data['invoice']);
			$products            = $data['products'];
			$data['total_price'] = 0;
			$stockVariants       = $this->productVariantRepository->query()
			                                                      ->whereIn('id',
				                                                      array_column($products,
					                                                      'product_variant_id'))
			                                                      ->pluck('stock', 'id')
			                                                      ->toArray();


			unset($data['products'], $data['order_now']);
			foreach($products as $product) {
				$product['total_price'] = !empty($product['final_price']) ? $product['final_price'] * $product['quantity'] : $product['total_price'];
				$data['total_price']    = $data['total_price'] + $product['total_price'];
				if($product['quantity'] > $stockVariants[$product['product_variant_id']]) {
					session()->flash('error', $product['product_name'] . ' ' . implode(', ',
							json_decode($product['product_attributes'],
								1)) . ' ' . trans('Not enough quantity in stock.') . ' (' . $stockVariants[$product['product_variant_id']] . ' ' . trans('products left') . ' )');

					DB::rollBack();

					return false;
				}
			}
			$data['code']     = sprintf("%02d",
				$this->moduleRepository->findBy()->withTrashed()->count() + 1);
			$data['status']   = Order::STATUS_PENDING;
			$data['otp_code'] = strtoupper(Str::random(6));

			$customer = $this->customerRepository->findBy(['phone' => $data['phone']])->first();
			if(empty($customer)) {
				$customer = $this->customerRepository->create([
					'name'    => $data['name'] ?? "",
					'phone'   => $data['phone'] ?? "",
					'email'   => $data['email'] ?? "",
					'address' => $data['address'] ?? "",
				]);
			}
			$data['customer_id'] = $customer->id;
			$order               = $this->moduleRepository->create($data);
			$orderDetails        = [];
			foreach($products as $product) {
				$product['total_price'] = !empty($product['final_price']) ? $product['final_price'] * $product['quantity'] : $product['total_price'];
				$orderDetail            = [
					'product_name'       => $product['product_name'],
					'product_id'         => $product['product_id'],
					'product_variant_id' => $product['product_variant_id'],
					'product_attributes' => $product['product_attributes'],
					'sku'                => $product['sku'],
					'price'              => $product['price'],
					'discount'           => $product['discount'],
					'quantity'           => $product['quantity'],
					'total_price'        => $product['total_price'],
					'order_id'           => $order->id,
					'created_at'         => Carbon::today(),
					'updated_at'         => Carbon::today(),
				];

				$orderDetails[] = $orderDetail;
			}
			$this->orderDetailRepository->bulkCreate($orderDetails);

			DB::commit();
			session()->remove('shopping_cart');
			session()->remove('order_now_products');

			return $order;
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Created error.'));
		}
	}

	public function findBy($data)
	{
		return $this->moduleRepository->findBy($data);
	}

	public function detail($id)
	{
		return $this->moduleRepository->detailById($id);
	}

	/**
	 * @param $id
	 *
	 * @return false|void
	 */
	public function accept($id)
	{
		DB::beginTransaction();
		try {
			$order               = $this->moduleRepository->detailById($id);
			$order->status       = Order::STATUS_ACTIVE;
			$details             = $order->details;
			$product_sku_details = [];
			foreach($details as $detail) {
				if(empty($detail->productVariant)) {
					session()->flash('error',
						trans("Can't find products with some SKUs in the list."));

					return false;
				}
				if($detail->productVariant->stock < 0) {
					session()->flash('error',
						trans("There are products with insufficient quantity in stock."));

					return false;
				}
				$product_sku_details[]                 = $detail->product->has_variant ? $detail->productVariant->sku : $detail->product->sku;
				$detail->productVariant->stock         = (int) $detail->productVariant->stock - (int) $detail->quantity;
				$detail->productVariant->quantity_sold = (int) $detail->productVariant->quantity_sold + (int) $detail->quantity;
				$detail->productVariant->save();
			}
			$order->save();
			$this->notifyZALO($order, implode(', ', $product_sku_details));
			session()->flash('success', trans('Accepted successfully.'));

			DB::commit();
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Accepted error.'));
		}
	}

	protected function notifyZALO($order, $product_sku_details)
	{
		$product_sku_details = (strlen($product_sku_details) > 28)
			? substr($product_sku_details, 0, 25) . '...'
			: $product_sku_details;

		$phone = str_split($order->phone);
		if(count($phone) == 10) {
			$phone[0] = 84;
			$phone    = implode('', $phone);
		} else {
			$phone = "84$order->phone";
		}
		$templateID = json_decode(Setting::query()
		                                 ->where('key', 'ZALO_SETTING')
		                                 ->first()->value ?? '[]')->template_id_order ?? 0;

		$payments = [
			'cod'  => trans('Cash On Delivery (COD)'),
			'bank' => trans('Bank transfer'),
		];
		if(!empty($templateID)) {
			$data = [
				"order_code"    => $order->code,
				"customer_name" => $order->name,
				"date"          => formatDate($order->created_at, 'd/m/Y'),
				"product"       => $product_sku_details,
				"cost"          => (int) $order->total_price,
				"payment"       => $payments[$order->payment_method] ?? $payments['cod'],
			];

			$dispatcher = app(Dispatcher::class);
			$job        = app(ZaloNotifyJob::class)
				->template($templateID)
				->phone($phone)
				->data($data)
				->onQueue(config('queue.connections.database_zalo_notify.queue'));
			$dispatcher->dispatch($job);
		}
	}

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function abort($id)
	{
		DB::beginTransaction();
		try {
			$order         = $this->moduleRepository->detailById($id);
			$order->status = Order::STATUS_INACTIVE;
			$order->save();
			session()->flash('success', trans('Aborted successfully.'));

			DB::commit();
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Aborted error.'));
		}
	}

	/**
	 * @param $id
	 * @param $detail_id
	 *
	 * @return void
	 */
	public function deleteDetail($id, $detail_id)
	{
		DB::beginTransaction();
		try {
			$order  = $this->moduleRepository->detailById($id);
			$detail = $order->details->where('id', $detail_id)->first();
			if(!empty($detail)) {
				$order->total_price = $order->total_price - $detail->total_price;
				$detail->delete();
				$order->save();
			}
			session()->flash('success', trans('Deleted successfully.'));

			DB::commit();
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Deleted error.'));
		}
	}

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function delete($id)
	{
		try {
			$this->moduleRepository->deleteById($id);
			session()->flash('success', trans('Deleted successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Deleted error.'));
		}
	}

	/**
	 * @param $id
	 * @param $detail_id
	 *
	 * @return void
	 */
	public function updateDetail($id, $data)
	{
		DB::beginTransaction();
		try {
			$detail              = $this->orderDetailRepository->detailById($id);
			$data['total_price'] = (int) (($detail->discount > 0) ? $detail->discount : $detail->price) * (int) $data['quantity'];
			$detail->update($data);
			$order              = $this->moduleRepository->detailById($detail->order_id);
			$order->total_price = $order->details->sum('total_price');
			$order->save();
			session()->flash('success', trans('Updated successfully.'));

			DB::commit();
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Updated error.'));
		}
	}

	public function update($id, $data)
	{
		try {
			$this->moduleRepository->updateById($id, $data);
			session()->flash('success', trans('Updated successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Updated error.'));
		}
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function orderDetail($id)
	{
		return $this->orderDetailRepository->detailById($id);
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function getOrderDetailList($data)
	{
		return $this->orderDetailRepository->paginate($data);
	}

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return void
	 */
	public function updateOrderDetail($id, $data)
	{
		try {
			$detail = $this->orderDetailRepository->detailById($id);
			if(!empty($data['maintenance'])) {
				$maintenance                               = json_decode($detail->maintenance, 1);
				$maintenance[$data['maintenance']['date']] = $data['maintenance'];
				$data['maintenance']                       = $maintenance;
			}
			if(!empty($data['maintenance_remove'])) {
				$maintenance = json_decode($detail->maintenance, 1);
				unset($maintenance[$data['maintenance_remove']]);
				unset($data['maintenance_remove']);
				$data['maintenance'] = $maintenance;
			}
			$this->orderDetailRepository->updateById($id, $data);
			session()->flash('success', trans('Successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Something went wrong.'));
		}
	}
}
