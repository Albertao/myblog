<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "Comments";

    protected $fillable = ['parent_id','author','content'];

    public function comment(){
        return $this->belongsTo('App\Models\Article','article_id');
    }
}
