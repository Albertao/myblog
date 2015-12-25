<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "Articles";

    protected $fillable = ['slag','author','title','content'];

}
