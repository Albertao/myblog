<?php
namespace App\Services;
use Validator;

class validate{
    public function make($data,$rules){
        $validate = Validator::make($data,$rules);
        if($validate->passes()){
            return true;
        }else{
            return false;
        }
    }
}