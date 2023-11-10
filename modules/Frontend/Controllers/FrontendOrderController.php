<?php

namespace Modules\Frontend\Controllers;

use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Order\Models\Order;
use Modules\Order\Repositories\OrderService;
use Modules\Product\Services\ProductVariantService;
use Modules\Setting\Models\PaymentConfig;

class FrontendOrderController extends BaseController
{
	private $orderService;

	private $variantService;

	public function __construct(
		OrderService $orderService,
		ProductVariantService $variantService,
	) {
		$this->orderService   = $orderService;
		$this->variantService = $variantService;
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function getOrder(Request $request)
	{
		$variant = $this->variantService->detail($request->variant_id);
		if(!empty($variant)) {

			return view('Frontend::order.index', compact('variant'));
		}

		return back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function postOrder(Request $request)
	{
		$create = false;
		if(!empty($request->product_variant_id)) {
			$product_variant = $this->variantService->detail($request->product_variant_id);
			$product         = $product_variant->product;
			$quantity    = 1;
			$total_price = (int) (!empty($product_variant->discount) ? $product_variant->discount : $product_variant->price) * $quantity;
			$data        = $request->all();
			unset($data['quantity'], $data['variant_id'], $data['product_variant_id'], $data['product_id'], $data['product_attributes'], $data['proengsoft_jsvalidation']);
			$data['products'] = [
				$product_variant->id => [
					"quantity"           => ($quantity > $product_variant->stock || $quantity == 0) ? 1 : $quantity,
					"product_id"         => $product->id,
					"product_name"       => $product->has_variant ? $product_variant->name : $product->name,
					"product_variant_id" => $product_variant->id,
					"product_attributes" => $request->product_attributes,
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

		return redirect()->route('frontend.order.completed', $order->code);
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function orderCompleted($code)
	{
		$data = $this->orderService->findBy(['code' => $code])->first();
		if(!empty($data)) {
			$paymentConfig = PaymentConfig::getPaymentConfig();

			return view('Frontend::order.success', compact('data', 'paymentConfig'));
		}
		session()->flash('error', trans('This page is not ready!'));

		return redirect()->route('frontend.home');
	}
}