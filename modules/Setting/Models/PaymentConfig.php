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
		"cod" => 'Cash On Delivery (COD)',
		"bank" => 'Bank transfer',
	];

	public static function getPaymentConfig()
	{
		return self::getBulkValueByKey(self::CONFIG_KEY);
	}
}
