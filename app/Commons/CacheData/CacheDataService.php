<?php

namespace App\Commons\CacheData;


use Illuminate\Support\Facades\Cache;

class CacheDataService
{
	protected int $storage_minutes = 10080;

	/**
	 * @param $key
	 *
	 * @return false|mixed
	 */
	public function get($key)
	{
		if ($this->has($key)) {
			return Cache::get($key);
		}

		return FALSE;
	}

	/**
	 * @param $key
	 *
	 * @return bool
	 */
	public function has($key)
	{
		return Cache::has($key);
	}

	/**
	 * @param $minutes
	 *
	 * @return $this
	 */
	public function setExpiry($minutes)
	{
		$this->storage_minutes = $minutes;

		return $this;
	}

	/**
	 * @param $array
	 *
	 * @return $this
	 */
	public function bulkCache($array)
	{
		foreach ($array as $key => $value) {
			$this->cache($key, $value);
		}

		return $this;
	}

	/**
	 * @param $key
	 * @param $data
	 *
	 * @return $this
	 */
	public function cache($key, $data)
	{
		Cache::put($key, $data, $this->storage_minutes);

		return $this;
	}
}