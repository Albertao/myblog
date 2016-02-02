<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $firstArticle = Article::first();
        $others = Article::where('id','>',$firstArticle->id)->limit(5)->get();
        return view('home')->with(['first' => $firstArticle, 'others' => $others]);
    }

    public function about(){
        return view('about');
    }
}
