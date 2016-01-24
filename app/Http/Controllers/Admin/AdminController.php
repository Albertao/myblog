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
        //$data['password'] = crypt($data['password'], env('APP_KEY'));
        $adminInstance = adminAuth::attempt($data);
        //dd($adminInstance);
        if($adminInstance){
            //dd($adminInstance);
            $request->session()->put('adminId',$adminInstance->id);
            //if($request->session()->save()){
                return redirect()->route('admin::list');
            //}else{
            //    abort(503);
            //}
        }else{
            abort(404);
        }
        //dd(crypt('hsb4325',env('APP_KEY')));

    }
}
