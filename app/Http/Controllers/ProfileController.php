<?php

namespace App\Http\Controllers;

use App\Services\validate;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Request,Input,Auth,upload;

class ProfileController extends Controller
{
    protected $validate;

    public function __construct(validate $validate){
        $this->validate = $validate;
    }

    public function show(){
        if(Auth::check()){
            return view('profile');
        }else{
            abort(503);
        }
    }

    public function edit(){
        if(Auth::check()){
            $model = User::find(Auth::user()->id);
            if(Request::hasFile('portrait')){
                $data['head_url'] = upload::upload('asset/portraits/', 'portrait');
            }else{
                $data = Request::only('introduction', 'sex', 'name');
            }
            //dd($model);
            if($model->update($data)){
                return redirect()->back()->with('success', 'edit success~!');
            }else{
                abort(404);
            }
        }else{
            abort(503);
        }
    }
}
