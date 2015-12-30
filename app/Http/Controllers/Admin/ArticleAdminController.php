<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleAdminController extends Controller
{

    public function __construct(){
        $this->middleware('Admin');
    }
    //
    public function index(){
        $articles = Article::withTrashed()->all()->paginate(15);
        return view
    }
}
