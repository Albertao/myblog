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
        if(empty(Input::get('category'))){
            $categories = Category::all();
            $articles = Article::paginate(15);
            return view('article.index')->withArticles($articles)->withCategories($categories);
        }
        else{
            $category = Input::get('category');
            $articles = Category::where('name',$category)->article;
            return view('article.index')->withArticles($articles)->withCategories($category);
        }

    }

    public function search(){
        $keyword = Request::input('kw');
        $res = Article::where('title',$keyword)->paginate(15);
        return view('article.index')->withArticles($res);

    }

    public function detail($id){
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('article.detail')->withArticle($article)->withCategories($categories)->withId($id);
    }

}
