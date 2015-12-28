<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article,App\Models\Category;
use Input,Session,Redirect;

class ArticleController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        $articles = Article::paginate(1);
        return view('article.index')->withArticles($articles)->withCategories($categories);
    }

    public function search(){
        $keyword = Request::input('kw');
        $res = Article::where('title',$keyword)->paginate(15);
        return view('article.index')->withArticles($res);

    }

    public function detail($id){
        $article = Article::findOrFail($id);
        return view('article.detail')->withArticle($article)->withCategories($categories)->withId($id);
    }

}
