<?php

namespace App\Providers;

use App\Services\qiniu;
use Illuminate\Support\ServiceProvider;

class AdminAuthProvider extends ServiceProvider
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
        $this->app->singleton('qiniu',function(){
            return new qiniu();
        });
    }
}
