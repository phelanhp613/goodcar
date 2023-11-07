<?php

namespace Modules\Frontend\Controllers;

use App\Commons\CacheData\CacheDataService;
use App\Commons\Slug\SlugInterface;
use App\Http\Controllers\Controller;
use Modules\Frontend\Repositories\FrontendService;


class FrontendController extends Controller
{
	private $slugInterface;

	private $frontendService;

	private $cacheService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		SlugInterface $slugInterface,
		FrontendService $frontendService,
		CacheDataService $cacheService,
	) {
		$this->slugInterface   = $slugInterface;
		$this->frontendService = $frontendService;
		$this->cacheService    = $cacheService;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		return view('Frontend::index');
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
}