<?php

namespace Modules\Setting\Models;

/**
 * Class MailConfig
 *
 * @package Modules\Setting\Model
 */
class MailConfig extends Setting
{
	const MAIL_DRIVER = 'MAIL_DRIVER';

	const MAIL_HOST = 'MAIL_HOST';

	const MAIL_PORT = 'MAIL_PORT';

	const MAIL_USERNAME = 'MAIL_USERNAME';

	const MAIL_PASSWORD = 'MAIL_PASSWORD';

	const PROTOCOL = 'MAIL_ENCRYPTION';

	const MAIL_ADDRESS = 'MAIL_ADDRESS';

	const MAIL_NAME = 'MAIL_NAME';

	const MAIL_LIST = 'MAIL_LIST';

	const MAIL_CONFIG = [
		self::MAIL_DRIVER,
		self::MAIL_HOST,
		self::MAIL_PORT,
		self::MAIL_USERNAME,
		self::MAIL_PASSWORD,
		self::PROTOCOL,
		self::MAIL_ADDRESS,
		self::MAIL_NAME,
		self::MAIL_LIST,
	];

	/**
	 * @return array
	 */
	public static function getMailConfig()
	{
		return self::getBulkValueByKey(self::MAIL_CONFIG);
	}
}
