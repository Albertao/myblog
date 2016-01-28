<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests;
use Auth,Input,Redirect,Session;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //
    public function post(Request $request){
        if(Auth::user()){
            $model = new Comment();
            /*$rules = [
                'articleId' => 'required|integer',
                'parentId' => 'required|integer',
                'comment'   => 'required|max:255'
            ];
            $data = [
                'articleId' => $request->input('articleId'),
                'parentId'  => $request->input('parent_id'),
                'comment'   => $request->input('comment'),
            ];*/
            $model->article_id = $request->input('articleId');
            $model->author = Auth::user()->name;
            $model->content = $request->input('comment');
            $model->user_id = AUth::user()->id;
            $model->parent_id = $request->input('parent_id');
            if($model->save()){
                return redirect()->back()->with('success','comment succeed');
            }else{
                return redirect()->back()->with('error','something wrong occurred,please fill in again')->withInput();
            }
        }else{
            return redirect()->back()->with('error', "you haven't logged in yet")->withInput();
        }

    }
    public function lod(){

    }

/*
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
*/
}
