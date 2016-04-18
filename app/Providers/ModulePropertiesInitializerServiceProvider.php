<?php

namespace App\Providers;

use App\SG\Impl\DefaultModulePropertiesInitializerImpl;
use Illuminate\Support\ServiceProvider;

class ModulePropertiesInitializerServiceProvider extends ServiceProvider
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
        $this->app->bind('App\SG\ModulePropertiesInitializer', function() {
            return new DefaultModulePropertiesInitializerImpl();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['App\SG\ModulePropertiesInitializer'];
    }
}
