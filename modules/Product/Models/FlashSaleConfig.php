<?php

namespace Modules\Product\Models;

use Modules\Setting\Models\Setting;

class FlashSaleConfig extends Setting
{
	const FLASH_SALE_EXPIRE_DATE = 'FLASH_SALE_EXPIRE_DATE';

	const FLASH_SALE_ADD_MORE_PRODUCTS = 'FLASH_SALE_ADD_MORE_PRODUCTS';

	const FLASH_SALE_FOR_60_PERCENT = 'FLASH_SALE_FOR_60_PERCENT';

	const FLASH_SALE_CONFIG = [
		'FLASH_SALE_EXPIRE_DATE'       => self::FLASH_SALE_EXPIRE_DATE,
		'FLASH_SALE_ADD_MORE_PRODUCTS' => self::FLASH_SALE_ADD_MORE_PRODUCTS,
		'FLASH_SALE_FOR_60_PERCENT' => self::FLASH_SALE_FOR_60_PERCENT,
	];

	/**
	 * @return array
	 */
	public static function getFlashSaleConfig()
	{
		return self::getBulkValueByKey(self::FLASH_SALE_CONFIG);
	}
}
