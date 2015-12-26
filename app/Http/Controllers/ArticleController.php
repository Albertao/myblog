<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Input,Session,Redirect;

class ArticleController extends Controller
{
    //
    public function index(){

        $articles = Article::paginate(1);
        return view('article.index')->withArticles($articles);
    }

    public function search(){
        $keyword = Input::get('kw');
        $res = Article::where('title',$keyword)->findOrFail();
        return view('article')->withArticles($res);
    }

    public function detail($id){
        $article = Article::findOrFail($id);
        $comment = Article::find($id)->comment->paginate(15);
        return view('article.detail')->withArticles($article)->withComments($comment);
    }
}
