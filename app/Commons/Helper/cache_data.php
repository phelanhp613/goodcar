<?php

use App\Commons\CacheData\CacheDataService;
use Modules\Base\Models\Slug;
use Modules\Product\Models\Product;
use Modules\Setting\Models\Setting;

if(!function_exists('cacheData')) {
	/**
	 * @return void
	 */
	function cacheData()
	{
		session()->put('cache-data', true);
		$storage_minutes = 525600;
		$cacheService    = new CacheDataService();
		$cacheService->setExpiry($storage_minutes);

		/** Setting Website */
		$settingData = Setting::query()->get();
		$settings    = [];
		foreach($settingData as $setting) {
			$settings[$setting->key] = [
				'value'   => $setting->value,
				'content' => $setting->content,
			];
		}

		$cacheService->cache('setting_website', $settings);
	}
}