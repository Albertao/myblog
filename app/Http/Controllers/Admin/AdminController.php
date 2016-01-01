<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use adminAuth;

class AdminController extends Controller
{
    //
    public function index(){
        $adminInstance = adminAuth::admin();
        return view('admin.index')->withAdmin($adminInstance);
    }
}
