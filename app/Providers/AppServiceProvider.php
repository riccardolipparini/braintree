<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'k43twzy3ddd384h9',
                    'publicKey' => 'bvx78nwjkmqrc9qn',
                    'privateKey' => '71b77a446b30c03d2cb369f2d8dd118e'

                ]
            );
        });
    }
}


