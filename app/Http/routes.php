<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/art','ArticleController@index');



Route::post('/search','ArticleController@search');

Route::get('/comment','CommentController@post');

Route::get('/url','CommentController@test');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//these routes don't need auth
Route::get('/art/detail/{id}','ArticleController@detail');
//Route::get('/', 'HomeController@index');

//the front routes,where the normal authed user can accessed
Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');
    Route::auth();
    Route::post('/comment','CommentController@post');
});

//the admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('/login','AdminController@loginView');
    Route::post('/login','AdminController@login');
});

Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function(){

    Route::get('/index','AdminController@index');


    //Article admin routes
    Route::group(['prefix' => 'Article', 'as' => 'article'], function(){
        Route::get('/', 'ArticleAdminController@index');
        Route::get('edit', 'ArticleAdminControlle@edit');
        Route::post('post', 'ArticleAdminControlle@post');
        Route::get('show/{id}', 'ArticleAdminControlle@show');
        Route::post('update/{id}', 'ArticleAdminControlle@update');
        Route::post('restore/{id}', 'ArticleAdminControlle@restore');
        Route::post('delete/{id}', 'ArticleAdminControlle@delete');
    });

    //User admin routes
    Route::group(['prefix' => 'User', 'as' => 'user'], function(){
        Route::get('/', 'UserAdminController@index');
        Route::post('delete/{id}', 'UserAdminController@delete');
        Route::post('restore/{id}', 'UserAdminController@restore');
    });

    //Category admin routes
    Route::group(['prefix' => 'Category', 'as' => 'category'], function(){
        Route::get('/', 'CategoryAdminController@index');
        Route::post('create', 'CategoryAdminController@create');
        Route::post('delete/{id}', 'CategoryAdminController@delete');
    });

});
