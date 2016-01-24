<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentAdminController extends Controller
{
    //
    public function index(){
        $comments = Comment::withTrashed()->paginate(15);
        return view('admin.comment')->withComments($comments);
    }

    public function search($keyword){
        $results = Comment::where('content', 'like', '%'.$keyword.'%');->orWhere('article_id',$keyword)->all();
        return view('admin.comment')->withComment($results);
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
                return redirect()->back()->with('success','delete success');
            }else{
                return redirect()->back()->with('error','something wrong happende, please try again or contact your system manager.');
            }
        }else{
            return redirect()->back()->with('error', 'comment not found');
        }
    }
}
