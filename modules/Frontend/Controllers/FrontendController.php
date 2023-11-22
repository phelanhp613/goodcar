<?php

namespace Modules\Frontend\Controllers;

use App\Commons\CacheData\CacheDataService;
use App\Commons\Slug\SlugInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Frontend\Repositories\FrontendService;
use Modules\Product\Services\ProductService;
use Modules\Product\Services\ProductCategoryService;

class FrontendController extends Controller
{
	private $slugInterface;

	private $frontendService;

	private $cacheService;

	private $productService;

	private $productCategoryService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		SlugInterface $slugInterface,
		FrontendService $frontendService,
		CacheDataService $cacheService,
		ProductService $productService,
		ProductCategoryService $productCategoryService
	) {
		$this->slugInterface          = $slugInterface;
		$this->frontendService        = $frontendService;
		$this->cacheService           = $cacheService;
		$this->productService         = $productService;
		$this->productCategoryService = $productCategoryService;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$products          = $this->productService->findBy()->get()->take(4);
		$productCategories = $this->productCategoryService->findBy()
			->where('type', 'brand')
			->get()
			->take(4);
		$productByCategory = [];
		$productFeatured = $this->productService->findBy()->where('featured', 1)->get()->take(4);
		foreach ($productCategories as $item) {
			$productByCategory[$item->id] = $this->productService->findBy()
				->whereJsonContains(
					'product_category_ids',
					(string) $item->id
				)
				->get()
				->take(4);
		}

		return view(
			'Frontend::index',
			compact('products', 'productByCategory', 'productCategories', 'productFeatured')
		);
	}

	/**
	 * @param $slug
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function redirectToPage($slug)
	{
		$key      = "view_frontend_$slug";
		$dataView = $this->cacheService->get($key);
		if (env('CACHE_VIEW', false) && $dataView) {
			return $dataView;
		}

		$dataBySlug = $this->slugInterface->setSlug($slug)->init();
		if (empty($dataBySlug->model) || empty($dataBySlug->data)) {

			session()->flash('error', trans('Cannot find this page'));

			return redirect()->route('frontend.pageNotFound');
		}
		$dataView = view($dataBySlug->view, $this->frontendService->getData($dataBySlug));

		$this->cacheService->cache($key, $dataView->render());

		return $dataView;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function pageNotFound()
	{
		return view('Frontend::404');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function searchProduct(Request $request)
	{
		$keyword = $request->keyword;
		$categories = $this->productCategoryService->getArray();
		$data = $this->productService->search($request->all(), 9);

		return view('Frontend::product.product_search', compact('data', 'keyword', 'categories'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function contact(Request $request)
	{
		return view('Frontend::contact.contact');
	}
}
