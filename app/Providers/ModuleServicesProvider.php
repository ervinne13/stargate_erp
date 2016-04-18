<?php

namespace App\Providers;

use App\SG\Impl\DefaultModuleServicesImpl;
use Illuminate\Support\ServiceProvider;

class ModuleServicesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

   /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('App\SG\ModuleServices', function() {
            return new DefaultModuleServicesImpl();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['App\SG\ModuleServices'];
    }
}
