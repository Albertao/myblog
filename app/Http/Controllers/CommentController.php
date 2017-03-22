<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests;
use Auth,Input,Redirect,Session,validate;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function post(Request $request){
        if(Auth::user()){
            $rules = [
                'article_id' => 'required|integer',
                'parent_id' => 'required|integer',
                'content'   => 'required|max:255'
            ];
            $data = [
                'article_id' => $request->input('articleId'),
                'parent_id'  => $request->input('parent_id'),
                'content'   => $request->input('comment'),
            ];
            if(validate::make($data, $rules)){
                $model = new Comment($data);
                $model->author = Auth::user()->name;
                $model->user_id = AUth::user()->id;
                if($model->save()){
                    return redirect()->back()->with('success','comment succeed');
                }else{
                    return redirect()->back()->with('error','something wrong occurred,please fill in again')->withInput();
                }
            }else{

            }
        }else{
            return redirect()->back()->with('error', "you haven't logged in yet")->withInput();
        }

    }


}
