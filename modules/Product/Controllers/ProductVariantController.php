<?php

namespace Modules\Product\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Product\Repositories\ProductVariantRepository;
use Modules\Product\Services\ProductAttributeService;
use Modules\Product\Services\ProductService;
use Modules\Product\Services\ProductVariantService;

class ProductVariantController extends BaseController
{

	private $moduleService;

	private $productService;

	private $productAttributeService;

	private $productVariantRepository;

	public function __construct(
		ProductService $productService,
		ProductVariantService $productVariantService,
		ProductAttributeService $productAttributeService,
		ProductVariantRepository $productVariantRepository,
	) {
		$this->productService           = $productService;
		$this->moduleService            = $productVariantService;
		$this->productAttributeService  = $productAttributeService;
		$this->productVariantRepository = $productVariantRepository;
	}

	/**
	 * @param $id
	 *
	 * @return Application|Factory|View
	 */
	public function getUpdate($id)
	{
		$data = $this->moduleService->detail($id);

		$suggestProductsQuery = $this->productVariantRepository->query()
		                                                       ->select('id', 'name', 'sku',
			                                                       'product_id')
		                                                       ->with('product')
		                                                       ->whereHas('product', function($pq) {
			                                                       $pq->where('deleted_at', null);
		                                                       })
		                                                       ->whereIn('id',
			                                                       json_decode($data->suggest_product_ids,
				                                                       1))
		                                                       ->get();
		$suggestProducts      = [];

		foreach($suggestProductsQuery as $suggestProduct) {
			$suggestProducts[$suggestProduct->id] = $suggestProduct->name . ' | ' . $suggestProduct->sku;
		}

		return view('Product::product.attributes.variant.update',
			compact('data', 'suggestProducts'));
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(Request $request, $id)
	{
		$this->moduleService->update($id, $request->all());

		return redirect()->back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postQuickUpdate(Request $request, $id)
	{
		if(!empty($request->variants)) {
			foreach($request->variants as $id => $data) {
				$data['quick_update'] = 1;
				$this->moduleService->update($id, $data);
			}
		}

		return redirect()->back();
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->moduleService->delete($id);

		return redirect()->back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateAttribute(Request $request, $id)
	{
		$this->productService->updateAttributeHasVariant($id, $request->all());

		return back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function find(Request $request)
	{
		$filter = $request->all();
		try {
			$data = [
				'status'   => 200,
				'messeage' => 'Successfully',
				'data'     => $this->moduleService->list($filter),
			];
		} catch(Exception $e) {
			$data = [
				'status'   => 500,
				'messeage' => $e->getMessage(),
				'data'     => [],
			];
		}

		return response()->json($data);
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function list($id)
	{
		$data = $this->productService->detail($id);
		if(empty($data)) {
			return redirect()->route('get.product.list');
		}
		$attributes = $this->productAttributeService->get(['parent_id' => null]);

		return view('Product::product.attributes.variant.listing',
			compact('data', 'attributes'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postAddImage(Request $request, $id)
	{
		$this->moduleService->updateImages($id, $request->all());

		return back();
	}
}
