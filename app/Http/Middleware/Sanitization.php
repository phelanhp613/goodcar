<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Sanitization
{
    public function handle(Request $request, Closure $next)
    {
	    if (!session()->has('cache-data')) {
		    cacheData();
	    }

	    if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            $input = $request->all();
            $arraySkipFields = ['email', 'password', 'date', 'birthday', 'content', 'promotion', 'image', 'description'];
            array_walk_recursive($input, function (&$input, $key) use ($arraySkipFields) {
				if (!in_array($key, ['JAVASCRIPT', 'CSS_STYLE', 'ADDRESS'])) {
					if (!in_array($key, $arraySkipFields)) {
						$input = strip_tags($input);
					} else {
						$input = str_replace('script', '', $input);
					}
				}
            });
			$request->merge($input);
	    }


        return $next($request);
    }
}
