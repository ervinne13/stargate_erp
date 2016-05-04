<?php

namespace App\Providers\Administration;

use App\SG\Impl\Administration\DefaultReasonServiceImpl;
use Illuminate\Support\ServiceProvider;

class ReasonServiceProvider extends ServiceProvider {

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
        $this->app->bind('App\SG\Administration\ReasonService', function() {
            return new DefaultReasonServiceImpl();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['App\SG\Administration\ReasonService'];
    }

}
