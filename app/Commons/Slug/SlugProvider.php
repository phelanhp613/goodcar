<?php

namespace App\Commons\Slug;

use Illuminate\Support\ServiceProvider;

class SlugProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SlugInterface::class, SlugService::class);
    }
}
