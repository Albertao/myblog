<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    //
    protected $table = "Articles";

    protected $fillable = ['slag','author','title','content','category','image_url'];

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'article_categories', 'article_id', 'category_id');
    }
}
