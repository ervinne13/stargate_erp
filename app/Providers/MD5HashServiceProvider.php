<?php

namespace App\Providers;

use App\Libraries\MD5Hasher;
use Illuminate\Support\ServiceProvider;

class MD5HashServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->app['hash'] = $this->app->share(function () {
            return new MD5Hasher();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        return array('hash');
    }

}
