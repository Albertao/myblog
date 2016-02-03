<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{

    public function index(){
        $users = User::withTrashed()->paginate(15);
        return view('admin.user')->withUsers($users);
    }

    public function delete($id){
        $id = intval($id);
        $userInstance = User::findOrFail($id);
        $userInstance->comments->each(function($comment){
            Comment::find($comment->id)->delete();
        });
        if($userInstance->delete()){
            return redirect()->back()->with('success', 'delete success');
        }else{
            return redirect()->back()->with('error', 'this user has already been deleted');
        }
    }

    public function restore($id){
        $id = intval($id);
        $userInstance = User::onlyTrashed()->findOrFail($id);
        $userInstance->comments->each(function($comment){
            Comment::withTrashed()->find($comment->id)->restore();
        });
        if($userInstance->restore()){
            return redirect()->back()->with('success', 'restore success');
        }else{
            return redirect()->back()->withError('this user haven\'t been deleted yet.');
        }
    }
}
