<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use adminAuth,Request;

class AdminController extends Controller
{
    //
    public function index(){
        if(!adminAuth::admin()){
            $adminInstance = adminAuth::admin();
            return view('admin.index')->withAdmin($adminInstance);
        }else{
            return redirect('/admin/login');
        }

    }

    public function loginView(){
        return view('admin.login');
    }

    public function login(){
        $data = Request::only('username','password');
        $data['password'] = crypt($data['password'], env('APP_KEY'));
        if(adminAuth::attempt($data)){
            return redirect('/admin/index');
        }else{
            abort(503);
        }
    }
}
