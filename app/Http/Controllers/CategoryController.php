<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Request;

class CategoryController extends Controller
{
    //
    public function index($categoryId)
    {
        $perPage = 2;
        $articles = Category::find($categoryId)->article;
        $maxPage = $articles->chunk($perPage)->count();
        if(Request::has('page')){
            $articles = $articles->forPage(Request::get('page'), $perPage);
            //dd($articles);
            $firstArticle = $articles->shift();
            $others = $articles;
            return view('category')->with(['first' => $firstArticle, 'others' => $others, 'maxPage' => $maxPage]);
        }else{
            $articles = $articles->forPage(1, $perPage);
            $firstArticle = $articles->shift();
            $others = $articles;
            return view('category')->with(['first' => $firstArticle, 'others' => $others, 'maxPage' => $maxPage]);
        }
        /*$article = Category::find($categoryId)->article;
        $maxPage = intval(ceil(Article::count()/$perPage));
        $firstArticle = $article->shift();
        $others = $article;
        return view('home')->with(['first' => $firstArticle, 'others' => $others, 'maxPage' => $maxPage]);*/
        /*$categories = Category::all();
        $articles = Article::paginate(15);
        return view('home')->withArticles($articles)->withCategories($categories);*/
    }
}
