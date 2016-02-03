<?php

namespace App\Providers;

use App\Services\uploadImage;
use Illuminate\Support\ServiceProvider;

class UploadImageProvider extends ServiceProvider
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
        $this->app->singleton('uploadImage',function(){
            return new uploadImage();
        });
    }
}
