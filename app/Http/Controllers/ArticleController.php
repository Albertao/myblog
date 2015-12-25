<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    //
    public function index(){

        $articles = Article::all()->paginate(15);
        return view('article')->withArticles($articles);
    }
}
