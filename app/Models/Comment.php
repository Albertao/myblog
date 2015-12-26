<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = "Comments";

    protected $fillable = ['parent_id','author','content'];

    public function comment(){
        return $this->belongsTo('App\Models\Article','article_id');
    }
}
