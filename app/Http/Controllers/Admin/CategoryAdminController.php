<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use validate,Redirect,Request;
use App\Models\Category;

class CategoryAdminController extends Controller
{
    //
    public function index(){
        $categories = Category::paginate(15);
        return view('admin.category')->withCategories($categories);
    }

    public function create(){
        $data = Request::only('name');
        if(count($data) >= 1){
            $model = new Category($data);
            $model->save();
            return Redirect::back()->withResult('create succeed');
        }else{
            return Redirect::back()->withResult('create failed');
        }
    }

    public function delete($id){
        $id = intval($id);
        $category = Category::findOrFail($id);
        if($category->delete()){
            return Redirect::back()->withResult('delete succeed');
        }else{
            return Redirect::back()->withResult('delete failed');
        }
    }
}
