<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Validator,validate,Auth;

class ArticleAdminController extends Controller
{
    protected $validate;

    public function __construct(validate $validate){
        $this->validate = $validate;
    }
    //
    public function index(){
        $articles = Article::withTrashed()->paginate(10);
        return view('admin.article')->withArticles($articles);
    }

    public function edit(){
        $categories = Category::all();
        return view('admin.edit')->withCategories($categories);
    }

    public function post(){
        $data = Request::only('slag','title','content','category');
        $data['author'] = Auth::user()->name;
        $rules = ['slag' => 'required|max:255','author' => 'required|max:255','title' => 'required|max:255','content' => 'required'];
        if($this->validate($data,$rules)){
            $article = new Article($data);
            $article->save();
            return Redirect::back()->withResult('operation complete');
        }else{
            return Redirect::back()->withResult('woops!looks like somthing wrong happened');
        }
    }

    public function show($id){
        $id = intval($id);
        $articleInstance = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.detail')->withArticle($articleInstance)->withCategories($categories);
    }

    public function update($id){
        $id = intval($id);
        $articleInstance = Article::findOrFail($id);
        $data = Request::only('slag','content','title','category');
        $rules = ['slag' => 'required|max:255','title' => 'required|max:255','content' => 'required','category' => 'required|max:255'];
        if($this->validate->make($data,$rules)){
            $articleInstance->update($data);
            return Redirect::back()->withResult('operation complete');
        }else{
            return Redirect::back()->withResult('whoops!looks like something wrong happened');
        }
    }

    public function restore($id){
        $id = intval($id);
        $articleInstance = Article::onlyTrashed()->find($id);
        if($articleInstance){
            $articleInstance->restore();
            return Redirect::back()->withResult('operation complete');
        }else{
            return Redirect::back()->withResult('this article haven\'t been deleted yet.');
        }
    }

    public function delete($id){
        $id = intval($id);
        $articleInstance = Article::find($id);
        if(!$articleInstance->trashed()){
            $articleInstance->delete();
            return Redirect::back()->withResult('operation complete');
        }else{
            return Redirect::back()->withResult('this article has been deleted already.');
        }
    }

}
