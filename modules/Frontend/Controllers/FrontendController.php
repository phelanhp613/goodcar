<?php

namespace Modules\Frontend\Controllers;

use App\Commons\CacheData\CacheDataService;
use App\Commons\Slug\SlugInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Base\Models\Status;
use Modules\Consult\Models\ConsultConfig;
use Modules\Contact\Repositories\ContactService;
use Modules\Contact\Requests\ContactRequest;
use Modules\Frontend\Repositories\FrontendService;
use Modules\Page\Models\HomePage;
use Modules\Post\Models\Post;
use Modules\Product\Models\FlashSaleConfig;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Warranty\Models\WarrantyConfig;


class FrontendController extends Controller
{
	private $slugInterface;

	private $frontendService;

	private $cacheService;

	private $contactService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		SlugInterface $slugInterface,
		FrontendService $frontendService,
		ContactService $contactService,
		CacheDataService $cacheService,
	) {
		$this->slugInterface   = $slugInterface;
		$this->frontendService = $frontendService;
		$this->cacheService    = $cacheService;
		$this->contactService  = $contactService;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$dataView = $this->cacheService->get('HOME_VIEW');
		if(env('CACHE_VIEW', false) && $dataView) {
			return $dataView;
		}

		$cacheService       = new CacheDataService();
		$home_page_config   = $cacheService->get('home_page_config') ?? [];
		$banners            = $cacheService->get('banners') ?? [];
		$product_categories = $cacheService->get('product_categories') ?? [];
		$homeFeaturedVideo  = $home_page_config[HomePage::HOME_FEATURED_VIDEO] ?? [];
		$brandBannerImage   = $home_page_config[HomePage::HOME_BRAND_BANNER_IMAGE] ?? '';
		$products           = $cacheService->get('products') ?? [];
		$posts              = $cacheService->get('posts') ?? [];
		$flashSaleProducts  = $cacheService->get('flash_sale_products') ?: [];

		$flashSaleConfigCache                       = $cacheService->get('flash_sale_config') ?? [];
		$expireDate                                 = $flashSaleConfigCache[FlashSaleConfig::FLASH_SALE_EXPIRE_DATE] ?? '';
		$expireDate                                 = strtotime($expireDate) ? $expireDate : Carbon::now()
		                                                                                           ->format('d-m-Y');
		$expireDate                                 = Carbon::createFromFormat('d-m-Y', $expireDate)
		                                                    ->endOfDay();
		$flashSaleConfig['remaining_date']          = Carbon::now()->diff($expireDate);
		$flashSaleConfig['remaining_date']->total_s = Carbon::now()->diffInSeconds($expireDate);
		$flashSaleConfig['remaining_date']->date    = $expireDate->format('Y-m-d H:i:s');

		$dataView = view('Frontend::index',
			compact(
				'banners',
				'flashSaleProducts',
				'flashSaleConfig',
				'posts',
				'product_categories',
				'products',
				'brandBannerImage',
				'homeFeaturedVideo'
			)
		);

		$this->cacheService->cache('HOME_VIEW', $dataView->render());


		return $dataView;
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
		if(env('CACHE_VIEW', false) && $dataView) {
			return $dataView;
		}

		$dataBySlug = $this->slugInterface->setSlug($slug)->init();
		if(empty($dataBySlug->model) || empty($dataBySlug->data)) {

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
	public function news(Request $request)
	{
		/** Post News */
		$main_posts = $this->cacheService->get('main-post');
		if(!$main_posts || empty($main_posts)) {
			$main_posts = Post::query()
			                  ->where('status', true)
			                  ->orderBy('featured', 'DESC')
			                  ->orderBy('created_at', 'DESC')
			                  ->take(4)
			                  ->get();
			$this->cacheService->cache('main-post', $main_posts);
		}
		$post_list = Post::query()
		                 ->where('status', true)
		                 ->whereNotIn('id', $main_posts->pluck('id'))
		                 ->orderBy('featured', 'DESC')
		                 ->orderBy('created_at', 'DESC')
		                 ->paginate(10);

		return view('Frontend::post.post_listing', compact('main_posts', 'post_list'));
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function getContact()
	{
		return view('Frontend::pages.contact');
	}

	/**
	 * @param \Modules\Contact\Requests\ContactRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postContact(ContactRequest $request)
	{
		$this->contactService->create($request->all());
		session()->flash('send-success',
			trans('Send successfully, please wait for us to get back to you!'));

		return back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function searchProduct(Request $request)
	{
		$keyword = $request->keyword;
		if(empty($keyword)) {
			return back();
		}
		$data = $this->frontendService->searchProduct($request->all());

		return view('Frontend::product.product_search', compact('data', 'keyword'));
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function getConsult(Request $request)
	{
		$questions   = ConsultConfig::getValueByKey(ConsultConfig::ADVISE_QUESTIONS);
		$questions   = !empty($questions) ? json_decode($questions, 1) : [];
		$consultants = ConsultConfig::getValueByKey(ConsultConfig::ADVISE_CONSULTANTS);
		$consultants = !empty($consultants) ? json_decode($consultants, 1) : [];
		$productSlug = $request->product_slug ?? null;
		$previousUrl = !empty($request->product_slug) ? route('frontend.redirect_to_page',
			$request->product_slug) : url()->previous();

		return view('Frontend::pages.consult',
			compact('questions', 'consultants', 'previousUrl', 'productSlug'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function getWarranty(Request $request)
	{
		$questions = WarrantyConfig::getValueByKey(WarrantyConfig::WARRANTY_QUESTIONS);
		$questions = !empty($questions) ? json_decode($questions, 1) : [];

		return view('Frontend::pages.warranty', compact('questions'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function flashSale(Request $request)
	{
		$cacheService               = new CacheDataService();
		$flashSaleConfigCache       = $cacheService->get('flash_sale_config') ?? [];
		$flashSaleAddMoreProductIDs = json_decode($flashSaleConfigCache['FLASH_SALE_ADD_MORE_PRODUCTS'] ?? '[]',
			1);
		$flashSaleFor60Percent      = (int) ($flashSaleConfigCache['FLASH_SALE_FOR_60_PERCENT'] ?? 0);

		$products = Product::query()->join('product_variants', function($join) {
			$join->on('product_variants.product_id', '=', 'products.id');
		});
		$products = $products->select(
			'product_variants.product_id',
			'products.id',
			'products.name',
			'products.slug',
			'products.sku',
			'products.images',
			'products.has_variant',
			'products.product_category_id',
			'products.flash_sale_quantity',
			'products.status',
			DB::raw("COALESCE(NULLIF(MIN(product_variants.discount), 0), NULLIF(MIN(product_variants.price), 0)) as final_price"),
		)->groupBy([
			'product_variants.product_id',
			'products.id',
			'products.name',
			'products.slug',
			'products.sku',
			'products.images',
			'products.has_variant',
			'products.status',
			'products.product_category_id',
			'products.flash_sale_quantity',
		]);

		if(!empty($request->slug)) {
			$products = $products->where(function($q) use ($flashSaleAddMoreProductIDs) {
				$q->whereHas('variants', function($vq) {
					$vq->whereRaw('1 - (discount / price) >= 0.5')
					   ->where('discount', '>', 0);
				})->orWhereIn('products.id', $flashSaleAddMoreProductIDs);
			});

			$product_category = ProductCategory::query()
			                                   ->where('slug', $request->slug)
			                                   ->where('status', Status::STATUS_ACTIVE)
			                                   ->first();
			if(!empty($product_category)) {
				$products = $products->where('product_category_id', $product_category->id);
			}
		} else {
			$products = $products->whereIn('products.id', $flashSaleAddMoreProductIDs);
		}

		$products = $products->where('status', Status::STATUS_ACTIVE)
		                     ->with('variants')
		                     ->orderBy('final_price')
		                     ->paginate();

		$expireDate                                 = $flashSaleConfigCache[FlashSaleConfig::FLASH_SALE_EXPIRE_DATE] ?? '';
		$expireDate                                 = strtotime($expireDate) ? $expireDate : Carbon::now()
		                                                                                           ->format('d-m-Y');
		$expireDate                                 = Carbon::createFromFormat('d-m-Y', $expireDate)
		                                                    ->endOfDay();
		$flashSaleConfig['remaining_date']          = Carbon::now()->diff($expireDate);
		$flashSaleConfig['remaining_date']->total_s = Carbon::now()->diffInSeconds($expireDate);
		$flashSaleConfig['remaining_date']->date    = $expireDate->format('Y-m-d H:i:s');

		$categories = ProductCategory::query()
		                             ->with('products')
		                             ->whereHas('products',
			                             function($pq) use ($flashSaleAddMoreProductIDs) {
				                             $pq->with('variants')
				                                ->whereHas('variants',
					                                function($vq) {
						                                $vq->whereRaw('1 - (discount / price) >= 0.5')
						                                   ->where('discount', '>', 0);
					                                })
				                                ->orWhereIn('products.id',
					                                $flashSaleAddMoreProductIDs);
			                             })->get();

		return view('Frontend::pages.flash_sale',
			compact('products', 'flashSaleConfig', 'categories'));
	}
}
