<?php

namespace Modules\Product\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Base\Models\Status;
use Modules\Comment\Repositories\CommentService;
use Modules\Product\Models\FlashSaleConfig;
use Modules\Product\Models\ProductAttribute;
use Modules\Product\Models\ProductValue;
use Modules\Product\Models\ProductVariant;
use Modules\Product\Repositories\ProductVariantRepository;
use Modules\Product\Requests\ProductRequest;
use Modules\Product\Services\ProductAttributeService;
use Modules\Product\Services\ProductCategoryService;
use Modules\Product\Services\ProductService;
use Modules\Tag\Repositories\TagService;

class ProductController extends BaseController
{

	private $moduleService;

	private $productCategoryService;

	private $productAttributeService;

	private $tagService;

	private $productVariantRepository;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		ProductService $moduleService,
		ProductCategoryService $productCategoryService,
		ProductAttributeService $productAttributeService,
		ProductVariantRepository $productVariantRepository,
		TagService $tagService,
	) {
		$this->moduleService            = $moduleService;
		$this->productCategoryService   = $productCategoryService;
		$this->productAttributeService  = $productAttributeService;
		$this->tagService               = $tagService;
		$this->productVariantRepository = $productVariantRepository;
	}

	/**
	 * @param Request $request
	 *
	 * @return Application|Factory|View
	 */
	public function index(Request $request)
	{
		$filter     = $request->all();
		$data       = $this->moduleService->list($filter);
		$categories = $this->productCategoryService->getArray();

		return view('Product::product.index', compact('data', 'categories', 'filter'));
	}

	/**
	 * @return Application|Factory|View
	 */
	public function getCreate()
	{
		$statuses   = Status::getStatuses();
		$categories = $this->productCategoryService->getArray();
		$tags       = $this->tagService->getArray();
		$attributes = $this->productAttributeService->getArray();

		return view(
			'Product::product.create',
			compact('statuses', 'categories', 'tags', 'attributes')
		);
	}

	/**
	 * @param ProductRequest $request
	 *
	 * @return RedirectResponse
	 */
	public function postCreate(ProductRequest $request)
	{
		$data = $this->moduleService->create($request->all());
		if (!empty($data)) {
			if ((int) $data->has_variant == 0) {
				return redirect()->route(
					'get.product.update',
					[$data->id, 'next-step' => 1]
				);
			} else {
				return redirect()->route('get.product_variant.list', $data->id);
			}
		}

		return redirect()->back();
	}

	/**
	 * @param $id
	 *
	 * @return Application|Factory|View|RedirectResponse
	 */
	public function getUpdate($id)
	{
		$data = $this->moduleService->detail($id);
		if (empty($data)) {
			return redirect()->route('get.product.list');
		}
		$statuses             = Status::getStatuses();
		$tags                 = $this->tagService->getArray();
		$categories           = $this->productCategoryService->getArray();
		$attributes           = $this->productAttributeService->getArray();
		$suggest_product_ids  = !empty($data->rootVariant()->suggest_product_ids)
			? json_decode($data->rootVariant()->suggest_product_ids ?? '[]', 1)
			: [];
		$suggestProductsQuery = $this->productVariantRepository->query()
			->select(
				'id',
				'name',
				'sku',
				'product_id'
			)
			->with('product')
			->whereHas('product', function ($pq) {
				$pq->where('deleted_at', null);
			})
			->whereIn('id', $suggest_product_ids)
			->get();
		$suggestProducts      = [];
		foreach ($suggestProductsQuery as $suggestProduct) {
			$suggestProducts[$suggestProduct->id] = $suggestProduct->name . ' | ' . $suggestProduct->sku;
		}

		return view(
			'Product::product.update',
			compact('data', 'statuses', 'categories', 'tags', 'attributes', 'suggestProducts')
		);
	}

	/**
	 * @param ProductRequest $request
	 * @param $id
	 *
	 * @return RedirectResponse
	 */
	public function postUpdate(ProductRequest $request, $id)
	{
		$this->moduleService->update($id, $request->all());

		return back();
	}

	/**
	 * @param Request $request
	 *
	 * @return Application|Factory|View|RedirectResponse
	 */
	public function addAttributeInput(Request $request)
	{
		if (!$request->ajax()) {
			return redirect()->back();
		}
		$data       = !empty($request->product_id) ? $this->moduleService->detail($request->product_id) : [];
		$attributes = $this->productAttributeService->getArray();

		return view(
			'Product::product.attributes.' . (!empty($request->hasVersion) && $request->hasVersion == 1 ? '_variant' : '_attribute'),
			compact('data', 'attributes')
		);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postAddAttribute(Request $request, $id)
	{
		$data                = $this->moduleService->detail($id);
		$data->attribute_ids = json_encode($request->attribute_ids);
		$data->save();
		$this->moduleService->updateAttribute($data, $request->attribute_ids ?? []);

		return back();
	}

	/**
	 * @param $id
	 *
	 * @return RedirectResponse
	 */
	public function delete($id)
	{
		$this->moduleService->delete($id);

		return back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function view(Request $request, $id)
	{
		$data = $this->moduleService->detail($id);
		if (!empty($request->attr)) {
			$attr                  = $request->attr;
			$productAttributeNames = ProductAttribute::query()
				->whereIn('id', $attr)
				->pluck('name')
				->toArray();

			$productValue = ProductValue::query()
				->with('variant')
				->whereHas('variant', function ($vq) use ($data) {
					$vq->where('product_id', $data->id);
				})
				->whereIn('value', $productAttributeNames)
				->get();

			$productValueGroups = [];
			foreach ($data->variants->pluck('id') as $variant_ids) {
				foreach ($productValue as $value) {
					if ($variant_ids == $value->product_id) {
						$productValueGroups[$value->product_id][] = $value->toArray();
					}
				}
			}
			$variant_selected = [];
			foreach ($productValueGroups as $key => $group) {
				if (count($group) == count($attr)) {
					$variant_selected = ProductVariant::query()->find($key);
					break;
				}
			}
		} else {
			$variant_selected = $data->rootVariant();
		}
		$variant_selected->suggest_products = ProductVariant::query()
			->with('product', function ($pq) {
				$pq->with('variants');
			})
			->whereHas('product', function ($pq) {
				$pq->where('deleted_at', null);
			})
			->whereIn(
				'id',
				json_decode(
					$variant_selected->suggest_product_ids,
					1
				)
			)
			->get();

		$product_attributes = ProductAttribute::query()
			->with('children')
			->whereIn(
				'id',
				json_decode($data->attribute_ids, 1)
			)
			->get();
		$related_products   = $data->category->products->where('id', '<>', $data->id)->take(20);

		return view(
			'Frontend::product.product_detail',
			compact('data', 'variant_selected', 'product_attributes', 'related_products')
		);
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
		} catch (Exception $e) {
			$data = [
				'status'   => 500,
				'messeage' => $e->getMessage(),
				'data'     => [],
			];
		}

		return response()->json($data);
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

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdateProductFeatured(Request $request)
	{
		$this->moduleService->postUpdateProductFeatured($request->id, $request->all());

		return back();
	}
}
