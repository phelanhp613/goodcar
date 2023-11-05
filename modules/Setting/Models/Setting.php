<?php

namespace Modules\Setting\Models;

use Modules\Base\Models\BaseModel;

class Setting extends BaseModel
{

	const POINT = 'POINT';

	public $timestamps = FALSE;

	protected $table = "settings";

	protected $primaryKey = "id";

	protected $guarded = [];

	/**
	 * @param $key
	 *
	 * @return |null
	 */
	public static function getValueByKey($key)
	{

		$setting = self::query()->where('key', $key)->first();

		if (!empty($setting)) {
			return $setting->value;
		}

		return NULL;
	}

	/**
	 * @param $keys
	 *
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public static function getBulkValueByKey($keys)
	{

		return self::query()->whereIn('key', $keys)
		                    ->pluck('value', 'key')
		                    ->toArray();
	}

}
