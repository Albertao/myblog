<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    //
    protected $table = "Articles";

    protected $fillable = ['slag','author','title','content'];

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

}
