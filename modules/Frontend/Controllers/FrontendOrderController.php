<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\Cart\Repositories\CartService;
use Modules\Order\Models\Order;
use Modules\Order\Repositories\OrderService;
use Modules\Order\Requests\OrderRequest;
use Modules\Product\Repositories\ProductVariantRepository;
use Modules\Setting\Models\PaymentConfig;
use Modules\Voucher\Repositories\VoucherService;


class FrontendOrderController extends Controller
{
	private $cartService;

	private $orderService;

	private $productVariantRepository;

	private $voucherService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		OrderService $orderService,
		CartService $cartService,
		ProductVariantRepository $productVariantRepository,
		VoucherService $voucherService,
	) {
		$this->cartService              = $cartService;
		$this->orderService             = $orderService;
		$this->productVariantRepository = $productVariantRepository;
		$this->voucherService           = $voucherService;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function getOrder(Request $request)
	{
		$products = session('shopping_cart') ?? [];
		if(!empty($request->order_now)) {
			$products = session()->get('order_now_products') ?? [];
		}
		$stockVariants = $this->productVariantRepository->query()
		                                                ->whereIn('id',
			                                                array_column($products,
				                                                'product_variant_id'))
		                                                ->pluck('stock', 'id')
		                                                ->toArray();

		return view('Frontend::order.order', compact('products', 'stockVariants'));
	}

	/**
	 * @param \Modules\Order\Requests\OrderRequest $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function postOrder(OrderRequest $request)
	{
		$create = false;
		if(!empty($request->products)) {
			$create = $this->orderService->create($request->all());
		}
		if(!empty($request->product_variant_id)) {
			$product_variant = $this->productVariantRepository->detailById($request->product_variant_id);
			$product         = $product_variant->product;
			$attributeData   = [];
			foreach(($product['product_attributes'] ?? []) as $attribute => $value) {
				$attributeData[] = $attribute . ': ' . $value;
			}
			$quantity    = (int) ($request->quantity ?? 1);
			$total_price = (int) (!empty($product_variant->discount) ? $product_variant->discount : $product_variant->price) * $quantity;
			$data        = $request->all();
			unset($data['quantity'], $data['product_variant_id']);
			$data['products'] = [
				$product_variant->id => [
					"quantity"           => ($quantity > $product_variant->stock || $quantity == 0) ? 1 : $quantity,
					"product_id"         => $product->id,
					"product_name"       => $product->has_variant ? $product_variant->name : $product->name,
					"product_variant_id" => $product_variant->id,
					"product_attributes" => json_encode($attributeData),
					"sku"                => $product->has_variant ? $product_variant->sku : $product->sku,
					"price"              => $product_variant->price,
					"discount"           => $product_variant->discount,
					"total_price"        => $total_price,
					"quantity_base"      => $product_variant->stock,
				],
			];

			$create = $this->orderService->create($data);
		}
		if(!$create) {
			return redirect()->back();
		}
		$order = $this->orderService->detail($create->id);

		return redirect()->route('frontend.order.confirm', $order->code);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $slug
	 *
	 * @return string
	 */
	public function getOrderNow(Request $request, $slug)
	{
		try {
			$order_now_products = $this->cartService->repairProductData($request, $slug, []);
			session()->put('order_now_products', $order_now_products);
		} catch(Exception $exception) {
			session()->flash('error', trans('Something went wrong!'));
		}

		return route('frontend.get.order', ['order_now' => 1]);
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function orderConfirm($code)
	{
		$data = $this->orderService->findBy(['code' => $code])->first();
		if(!empty($data) && $data->status === Order::STATUS_UNCONFIRMED) {
			$paymentConfig = PaymentConfig::getPaymentConfig();

			return view('Frontend::order.confirm_order', compact('data', 'paymentConfig'));
		}
		session()->flash('error', trans('This page is not ready!'));

		return redirect()->route('frontend.home');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $code
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postOrderConfirm(Request $request, $code)
	{
		$data    = $this->orderService->findBy(['code' => $code])->first();
		if(!empty($request->voucher_code)) {
			$voucher = $this->voucherService->findBy(['code' => $request->voucher_code])->first();
			if(empty($voucher) || $voucher->quantity < 1) {
				session()->flash('error', trans('This voucher has expired'));
			} else {
				try {
					if(!empty($data) && $data->status == Order::STATUS_UNCONFIRMED) {
						if(!empty($request->otp_code) && $request->otp_code === $data->otp_code) {
							$voucher->quantity  = $voucher->quantity - 1;
							$voucher->save();

							$data->voucher_code = $request->voucher_code;
							$data->voucher_price = $request->voucher_price;
							$data->status = Order::STATUS_PENDING;
							$data->save();

							return redirect()->route('frontend.order.completed', $data->id);
						}
					}

					session()->flash('error', trans('Sai mã OTP!'));
				} catch(Exception $e) {
					session()->flash('error', trans('Something went wrong!'));
				}
			}
		} else {
			try {
				if(!empty($data) && $data->status == Order::STATUS_UNCONFIRMED) {
					if(!empty($request->otp_code) && $request->otp_code === $data->otp_code) {
						$data->status = Order::STATUS_PENDING;
						$data->save();

						return redirect()->route('frontend.order.completed', $data->id);
					}
				}

				session()->flash('error', trans('Sai mã OTP!'));
			} catch(Exception $e) {
				session()->flash('error', trans('Something went wrong!'));
			}
		}

		return back();
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function orderAbort($code)
	{
		$data = $this->orderService->findBy(['code' => $code])->first();

		if(!empty($data) && $data->status == Order::STATUS_UNCONFIRMED) {
			$this->orderService->abort($data->id);

			return view('Frontend::order.abort_order');
		}
		session()->flash('error', trans('This page is not ready!'));

		return redirect()->route('frontend.home');
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function orderCompleted($code)
	{
		$data = $this->orderService->findBy(['code' => $code])->first();
		if(!empty($data) && $data->status == Order::STATUS_PENDING) {
			$paymentConfig = PaymentConfig::getPaymentConfig();

			return view('Frontend::order.success', compact('data', 'paymentConfig'));
		}
		session()->flash('error', trans('This page is not ready!'));

		return redirect()->route('frontend.home');
	}

	/**
	 * @param $code
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function resendSMS($code)
	{
		$data = $this->orderService->findBy(['code' => $code])->first();

		if(!empty($data)) {
			$this->orderService->sendSMS($data->phone, $data->otp_code, $data->code);

			session()->flash('frontend_success', trans('Send SMS successfully. Please wait a few minutes'));
		} else {
			session()->flash('error', trans('Cannot send sms. Please contact with us!'));
		}

		return redirect()->back();
	}
}
