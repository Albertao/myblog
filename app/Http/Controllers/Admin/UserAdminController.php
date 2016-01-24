<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;

class UserAdminController extends Controller
{

    public function index(){
        $users = User::withTrashed()->all()->paginate(15);
        return view('admin.user')->withUsers($users);
    }

    public function delete($id){
        $id = intval($id);
        $userInstance = User::find($id);
        if(!$userInstance->trashed()){
            $userInstance->delete();
        }else{
            return Redirect::back()->withError('this user have been deleted already.');
        }
    }

    public function restore($id){
        $id = intval($id);
        $userInstance = User::find($id);
        if($userInstance->trashed()){
            $userInstance->restore();
        }else{
            return Redirect::back()->withError('this user haven\'t been deleted yet.');
        }
    }
}
