<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = "Comments";

    protected $fillable = ['parent_id','author','content','article_id'];

    public function remarks(){
        return $this->hasMany('App\Models\Comment','parent_id', 'id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
