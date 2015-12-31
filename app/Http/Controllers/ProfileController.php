<?php

namespace App\Http\Controllers;

use App\Services\validate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use App\Models\Profile;

class ProfileController extends Controller
{
    protected $validate;

    public function __construct(validate $validate){
        $this->validate = $validate;
    }

    //
    public function index($id){
        $id = intval($id);
        $profile = Profile::findOrFail($id);
        return view('profile.show')->withProfile($profile);
    }

    public function update($id){
        $id = intval($id);
        $profileInstance = Profile::findOrFail($id);
        $data = Request::only();
        $rules = [];
        if($this->validate->make($data,$rules)){
            $profileInstance->save($data);
        }else{
            return Redirect::back()->withResult('whoops!looks like something wrong happened');
        }
    }
}
