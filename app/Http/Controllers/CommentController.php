<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests;
use Input,Redirect,Auth,Validator;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //
    public function post(Request $request){
        if(Auth::user()){
            $model = new Comment();
            if($this->validate($request)){
                $model->article_id = $request->input('articleId');
                $model->author = Auth::user()->name;
                $model->content = $request->input('comment');
                $model->parent_id = $request->input('parentId');
                $model->save();
                return Redirect::back()->withSuccess('comment succeed');
            }else{
                return Redirect::back()->withError('something wrong occurred,please fill in again')->withInput();
            }
        }else{
            return Redirect::back()->withError("you haven't logged in yet.")->withInput();
        }

    }

    public function validate(array $data){
        $validator = Validator::make($data,
            [
                'articleId' => 'required|integer',
                'parentId' => 'required|integer',
                'comment'   => 'required|max:255'
            ]);
        if($validator->passes()){
            return true;
        }else{
            return false;
        }
    }
}
