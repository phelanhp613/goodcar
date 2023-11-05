<?php

namespace Modules\Base\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param string $attribute
	 * @param mixed $value
	 *
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
			'secret'   => '6Lf4eP0mAAAAAMTFs5vvZqw87q8N2Xq0IoRyj8id',
			'response' => $value
		]);

		return $response->json()["success"];
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'The google recaptcha is required.';
	}
}
