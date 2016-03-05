<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;

use App\Models\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,validate,Auth,Request,adminAuth,Input,upload;

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
        $data = Request::only('slag','title');
        $data['content'] = htmlentities($_POST['content']);
        $data['author'] = adminAuth::admin()->name;
        if(Request::hasFile('article_image')){
            $data['image_url'] = upload::upload('asset/article_image/', 'article_image');
        }
        $rules = ['slag' => 'required|max:255','author' => 'required|max:255','title' => 'required|max:255','content' => 'required'];
        if(validate::make($data, $rules)){
            $article = new Article($data);
            $article->save();
            $categories = Request::only('category');
            $article->categories()->sync($categories['category']);
            return Redirect::back()->withResult('operation complete');
        }else{
            return Redirect::back()->withResult('woops!looks like somthing wrong happened');
        }
    }

    public function show($id){
        $id = intval($id);
        $articleInstance = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.detail')->withArticle($articleInstance)->withCategories($categories)->withId($id);
    }

    public function update($id){
        $id = intval($id);
        $articleInstance = Article::findOrFail($id);
        $data = Request::only('slag','content','title');
        if(Request::hasFile('article_image')){
            $data['image_url'] = upload::upload('asset/article_image/', 'article_image');
        }
        $rules = ['slag' => 'required|max:255','title' => 'required|max:255','content' => 'required'];
        if(validate::make($data, $rules)){
            $categories = Request::only('category');
            $articleInstance->update($data);
            $articleInstance->categories()->sync($categories['category']);
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
