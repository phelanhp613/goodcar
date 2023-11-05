<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
    }

    /**
     * @return void
     */
    public function boot()
    {
        $path = base_path() . '/modules';
        if (!File::exists($path)) {
            mkdir($path);
        }
        $directories = array_map('basename', File::directories($path));
        foreach ($directories as $module) {
            $module_path = $path . '/' . $module . '/';
            $namespace = 'Modules\\' . $module;
	        /** Component */
			if (File::exists($module_path . "Components")) {
				Blade::componentNamespace($namespace . "\Components", Str::slug($module));
			}
            /** Migrations */
            if (File::exists($module_path . "Migrations")) {
                $this->loadMigrationsFrom($module_path . "Migrations");
            }
            /** Route */
            Route::group(['module' => $module, 'namespace' => $namespace . '\Controllers'], function () use ($module_path, $module) {
                if (File::exists($module_path . "Routes/routes.php")) {
                    $this->loadRoutesFrom($module_path . "Routes/routes.php");
                }
            });
            if (is_dir($module_path . 'Views')) {
                $this->loadViewsFrom($module_path . 'Views', $module);
            }
        }
    }
}
