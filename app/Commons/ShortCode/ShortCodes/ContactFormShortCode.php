<?php

namespace App\Commons\ShortCode\ShortCodes;

use App\Commons\ShortCode\ShortCodeAbstract;

class ContactFormShortCode extends ShortCodeAbstract {
	/**
	 * @param $isCached
	 *
	 * @return string
	 */
	public function init($isCached = true)
	{
		$info = cache('setting_website');
		$params = $this->handleParams();

		return view('Base::shortcodes.contact_form', compact('info', 'params'))->render();
	}

	public function handle($isCached = true)
	{
	}
}