<?php

namespace App\Providers;

use App\SG\Impl\WoFStaticDataLookup;
use Illuminate\Support\ServiceProvider;

class StaticDataLookupServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('App\SG\StaticDataLookup', function() {
            return new WoFStaticDataLookup();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['App\SG\StaticDataLookup'];
    }

}
