<?php

namespace App\Providers;

use App\Services\validate;
use Illuminate\Support\ServiceProvider;

class validateProvider extends ServiceProvider
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
    public function register()
    {
        //
        $this->app->singleton('validate',function(){
            return new validate();
        });
    }
}
