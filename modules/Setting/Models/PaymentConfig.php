<?php

namespace Modules\Setting\Models;

/**
 * Class StripeConfig
 *
 * @package Modules\Setting\Models
 */
class PaymentConfig extends Setting
{
	const BANK_NAME = 'BANK_NAME';

	const BANK_ACCOUNT_NAME = 'BANK_ACCOUNT_NAME';

	const BANK_ACCOUNT_NUMBER = 'BANK_ACCOUNT_NUMBER';

	const CONFIG_KEY = [
		self::BANK_NAME,
		self::BANK_ACCOUNT_NUMBER,
		self::BANK_ACCOUNT_NAME,
	];

	const PAYMENT_METHOD = [
		"bank_20"  => 'Bank transfer 20%',
		"bank_100" => 'Bank transfer 100%',
	];

	public static function getPaymentConfig()
	{
		return self::getBulkValueByKey(self::CONFIG_KEY);
	}
}
