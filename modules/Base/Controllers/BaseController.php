<?php

namespace Modules\Base\Controllers;

use App\Commons\CacheData\CacheDataService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Base\Models\Slug;


class BaseController extends Controller
{

	/**
	 * @param Request $request
	 * @param $key
	 *
	 * @return RedirectResponse
	 */
	public function changeLocale(Request $request, $key)
	{
		session()->put('locale', $key);

		return redirect()->back();
	}

	/**
	 * @param $link
	 *
	 * @return bool
	 */
	public function removeFile(Request $request)
	{
		$link = $request->link;
		if(!empty($link)) {
			$link = substr($link, 1);
			if(File::exists($link)) {
				File::delete($link);
			}
		}

		return true;
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function generateSitemap()
	{
		$cacheService = new CacheDataService();
		$data = $cacheService->get('slug_urls-sitemap');
		if(!$data) {
			$data = Slug::query()->select('slug', 'created_at')->get();
			$cacheService->cache('slug_urls-sitemap', $data);
		}

		return response()
			->view('Base::sitemap.index', compact('data'))
			->header('Content-Type', 'text/xml');
	}
}
