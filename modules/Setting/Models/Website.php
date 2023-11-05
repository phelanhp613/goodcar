<?php

namespace Modules\Setting\Models;

/**
 * Class Website
 *
 * @package Modules\Setting\Model
 */
class Website extends Setting
{

	const LOGO = 'LOGO';

	const LOGO_LIGHT = 'LOGO_LIGHT';

	const BACKGROUND = 'BACKGROUND';

	const FAVICON = 'FAVICON';

	const PHONE_NUMBER = 'PHONE_NUMBER';

	const EMAIL = 'EMAIL';

	const WEBSITE_NAME = 'WEBSITE_NAME';

	const FACEBOOK = 'FACEBOOK';

	const ZALO = 'ZALO';

	const INSTAGRAM = 'INSTAGRAM';

	const TWITTER = 'TWITTER';

	const ADDRESS = 'ADDRESS';

	const MENU_HEADER = 'MENU_HEADER';

	const MENU_HEADER_FONT_SIZE = 'MENU_HEADER_FONT_SIZE';

	const MENU_FOOTER = 'MENU_FOOTER';

	const META_TITLE = 'META_TITLE';

	const META_DESCRIPTION = 'META_DESCRIPTION';

	const META_KEYWORD = 'META_KEYWORD';

	const CANONICAL = 'CANONICAL';

	const CSS_STYLE = 'CSS_STYLE';

	const JAVASCRIPT = 'JAVASCRIPT';

	const SLOGAN = 'SLOGAN';

	const PRODUCT_BANNER = 'PRODUCT_BANNER';

	const PRODUCT_BANNER_LINK = 'PRODUCT_BANNER_LINK';

	const WEBSITE_CONFIG = [
		self::LOGO,
		self::LOGO_LIGHT,
		self::BACKGROUND,
		self::FAVICON,
		self::PHONE_NUMBER,
		self::EMAIL,
		self::WEBSITE_NAME,
		self::FACEBOOK,
		self::ZALO,
		self::INSTAGRAM,
		self::ADDRESS,
		self::MENU_HEADER,
		self::MENU_FOOTER,
		self::META_TITLE,
		self::META_DESCRIPTION,
		self::META_KEYWORD,
		self::CANONICAL,
		self::CSS_STYLE,
		self::JAVASCRIPT,
		self::SLOGAN,
		self::TWITTER,
		self::MENU_HEADER_FONT_SIZE,
		self::PRODUCT_BANNER,
		self::PRODUCT_BANNER_LINK,
	];

	/**
	 * @return array
	 */
	public static function getWebsiteConfig()
	{
		return self::getBulkValueByKey(self::WEBSITE_CONFIG);
	}
}
