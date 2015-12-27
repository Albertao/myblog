<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests;
use Input,Request,Redirect,Session;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //
    public function post(){
        $model = new Comment();
        $model->article_id = Input::get('articleId');
        $model->author = Session::get('username');
        $model->content = Input::get('comment');
        if($model->save()){
            return Redirect::back();
        }else{
            return Redirect::back()->withInput();
        }
    }
}
