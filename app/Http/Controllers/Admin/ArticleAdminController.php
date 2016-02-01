<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;

use App\Models\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Validator,validate,Auth,Request,adminAuth,Input;

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
        //$rules = ['slag' => 'required|max:255','author' => 'required|max:255','title' => 'required|max:255','content' => 'required'];
        if(Request::hasFile('article_image')){
            $file = Input::file('article_image');
            $allowed_extensions = ["png", "jpg", "gif"];
            if( $file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions) ){
                return redirect()->back()->with('result', '图片必须是jpg，png或者是gif格式');
            }
            $destination = 'asset/article_image/';
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(15).'.'.$extension;
            $file->move($destination, $fileName);
            $data['image_url'] = $destination.$fileName;
        }
        //need validate
        if(true){
            $article = new Article($data);
            $article->save();
            //dd($categories);
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
            $file = Input::file('article_image');
            $allowed_extensions = ["png", "jpg", "gif"];
            if( $file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions) ){
                return redirect()->back()->with('result', '图片必须是jpg，png或者是gif格式');
            }
            $destination = 'asset/article_image/';
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(15).'.'.$extension;
            $file->move($destination, $fileName);
            $data['image_url'] = $destination.$fileName;
        }
        //$rules = ['slag' => 'required|max:255','title' => 'required|max:255','content' => 'required','category' => 'required|max:255'];
        //need validate
        if(true){
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
