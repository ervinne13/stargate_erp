<?php

namespace App\Providers\Administration;

use App\SG\Impl\Administration\DefaultUserServiceImpl;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

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
        $this->app->bind('App\SG\Administration\UserService', function() {
            return new DefaultUserServiceImpl();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['App\SG\Administration\UserService'];
    }

}
