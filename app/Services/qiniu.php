<?php
/**
 * Created by PhpStorm.
 * User: albert
 * Date: 16-5-30
 * Time: 下午11:09
 */
namespace App\Services;
use \Qiniu\Auth as QA;
use \Qiniu\Storage\UploadManager;

class qiniu{
    public function upload($file){
        $auth = new QA(env('ACCESS_KEY'), env('SECRET_KEY'));
        $bucket = env('QINIU_BUCKET');
        $token  =$auth->uploadToken($bucket);
        $key = md5($file);
        $uploadMgr = new UploadManager();
        if ($uploadMgr->putFile($token, $key, $file)){
            return true;
        }
        return false;
    }
}