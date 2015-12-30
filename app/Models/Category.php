<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    protected $table = 'Categories';

    protected $fillable = ['name'];

    public function article(){
        return $this->hasMany('App\Models\Article');
    }
}
