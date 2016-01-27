<?php

namespace App\Http\Controllers;

use App\Services\validate;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Request,Input;

class ProfileController extends Controller
{
    protected $validate;

    public function __construct(validate $validate){
        $this->validate = $validate;
    }

    //
    public function show(){
        if(Auth::check()){
            return view('profile');
        }else{
            abort(503);
        }
    }

    public function edit(){
        if(Auth::check()){
            $user = Auth::user();
            if(Request::hasFile('portrait')){
                $file = Input::file('portrait');
                $allowed_extensions = ["png", "jpg", "gif"];
                if( $file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions) ){
                    return redirect()->back()->with('error', '图片必须是jpg，png或者是gif格式');
                }
                $destination = '/asset/portraits/';
                $extension = $file->getClientOriginalExtension();
                $fileName = str_random(15).'.'.$extension;
                $file->move($destination, $fileName);
                $data = Request::only('introduction', 'sex');
                $data['head_url'] = $destination.$fileName;
            }else{
                $data = Request::only('intrdocution', 'sex');
            }
            $user->save($data);
            return redirect()->back()->with('success', 'edit success~!');
        }else{
            abort(503);
        }
    }
}
