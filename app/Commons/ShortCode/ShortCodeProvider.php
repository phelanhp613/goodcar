<?php

namespace App\Commons\ShortCode;

use App\Commons\ShortCode\ShortCodes\ContactFormShortCode;

class ShortCodeProvider
{
	public array $registers = [
		'contactForm' => ContactFormShortCode::class,
	];
}