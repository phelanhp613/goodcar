<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    /**
	     * Validation accept warranty
	     */
	    Validator::extend('accept_warranty', function($attribute, $value, $parameters, $validator){
		    if(empty($value) || Str::contains($value, '{ngay}') || Str::contains($value,'{model}')){
			    return false;
		    }

		    return true;
	    });
    }
}
