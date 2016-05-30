<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
class qiniuFacade extends Facade{
    protected static function getFacadeAccessor() { return 'qiniu'; }
}
