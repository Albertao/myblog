<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
class uploadImageFacade extends Facade{
    protected static function getFacadeAccessor() { return 'uploadImage'; }
}
