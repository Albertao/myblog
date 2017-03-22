<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use adminAuth,Session;

class AdminController extends Controller
{
    //
    public function index(){
        if(adminAuth::admin()){
            $adminInstance = adminAuth::admin();
            return view('admin.index')->withAdmin($adminInstance);
        }else{
            return redirect()->route('admin::view');
        }

    }

    public function loginView(){
        return view('admin.login');
    }

    public function login(Request $request){
        $data = $request->only('username','password');
        $adminInstance = adminAuth::attempt($data);
        if($adminInstance){
            $request->session()->put('adminId',$adminInstance->id);
            return redirect()->route('admin::list');
        }else{
            return redirect()->back()->with('error', 'login failed');
        }
        //dd(crypt('hsb4325',env('APP_KEY')));

    }
}
