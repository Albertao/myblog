<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Request;

class CommentAdminController extends Controller
{
    //
    public function index(){
        $comments = Comment::withTrashed()->paginate(10);
        return view('admin.comment')->withComments($comments);
    }

    public function search(){
        //dd(Request::only('keyword'));
        $keyword = Request::only('keyword')['keyword'];
        $results = Comment::where('content', 'like', '%'.$keyword.'%')->orWhere('author', 'like', '%'.$keyword.'%')->paginate(10);
        //dd($results);
        return redirect()->back()->withComments($results);
    }

    public function delete($id){
        if($target = Comment::find($id)){
            if($target->delete()){
                return redirect()->back()->with('success','delete success');
            }else{
                return redirect()->back()->with('error','something wrong happende, please try again or contact your system manager.');
            }
        }else{
            return redirect()->back()->with('error', 'comment not found');
        }
    }

    public function restore($id){
        if($target = Comment::onlyTrashed()->find($id)){
            if($target->restore()){
                return redirect()->back()->with('success','restore success');
            }else{
                return redirect()->back()->with('error','something wrong happende, please try again or contact your system manager.');
            }
        }else{
            return redirect()->back()->with('error', 'comment not found');
        }
    }
}
