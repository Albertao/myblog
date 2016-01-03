<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests;
use Auth,Input,Redirect,validate,Session;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //
    public function post(Request $request){
        if(Auth::user()){
            $model = new Comment();
            $rules = [
                'articleId' => 'required|integer',
                'parentId' => 'required|integer',
                'comment'   => 'required|max:255'
            ];
            $data = [
                'articleId' => $request->input('articleId'),
                'parentId'  => $request->input('parent_id'),
                'comment'   => $request->input('comment'),
            ];
            if(validate::make($data,$rules)){
                $model->article_id = $request->input('articleId');
                $model->author = Auth::user()->name;
                $model->content = $request->input('comment');
                $model->parent_id = $request->input('parent_id');
                $model->save();
                return redirect()->back()->with('success','succeed');
            }else{
                return Redirect::back()->with('error','something wrong occurred,please fill in again')->withInput();
            }
        }else{
            return Redirect::back()->withError("you haven't logged in yet.")->withInput();
        }

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
