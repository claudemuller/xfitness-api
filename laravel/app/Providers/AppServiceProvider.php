<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('svg', function($arguments) {
            list($path, $class) = array_pad(explode(',', trim($arguments, '() ')), 2, '');
            $path = trim($path, "' ");
            $class = trim($class, "' ");

            $svg = new \DOMDocument();
            $svg->load(public_path($path));
            $svg->documentElement->setAttribute('class', $class);
            $output = $svg->saveXML($svg->documentElement);

            return $output;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
