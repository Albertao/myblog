<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $perPage = 2;
        $article = Article::paginate($perPage);
        $maxPage = intval(ceil(Article::count()/$perPage));
        $firstArticle = $article->shift();
        $others = $article;
        return view('home')->with(['first' => $firstArticle, 'others' => $others, 'maxPage' => $maxPage]);
    }

    public function about(){
        return view('about');
    }
}
