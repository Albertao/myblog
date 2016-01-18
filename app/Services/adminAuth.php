<?php
namespace App\Services;
use App\Models\Admin;
use Session;

class adminAuth{

    public function attempt($data){
        if(is_array($data)){
            $adminInstance = Admin::where($data)->first();
            if(!empty($adminInstance)){
                if(Session::put('adminId',1)){
                    unset($adminInstance);
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function admin(){
        if(!empty(Session::get('adminId'))){
            $adminInstance = Admin::find(Session::get('adminId'));
            return $adminInstance;
        }else{
            return false;
        }
    }

    public function check(){
        if(!empty(Session::get('adminId'))){
            return true;
        }else{
            return false;
        }
    }

}