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
Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);


//the front routes,where the normal authed user can accessed
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/art/detail/{id}',['as' => 'detail', 'uses' => 'ArticleController@detail']);
    Route::get('edit', 'ProfileController@show');
    Route::post('edit', 'ProfileController@edit');
    Route::get('/', 'HomeController@index');
    Route::post('/comment','CommentController@post');
});

//the admin routes

Route::group(['middleware' => ['web'], 'prefix' => 'admin', 'as'  => 'admin::', 'namespace' => 'Admin'], function(){

    //these routes in admin needs authorization
    Route::group(['middleware' => ['admin'] ], function(){
        //admin index
        Route::get('/', ['as' => 'list', 'uses' => 'AdminController@index']);
        //Article admin routes
        Route::group(['prefix' => 'Article', 'as' => 'article::'], function(){
            Route::get('/', ['as' => 'list', 'uses' => 'ArticleAdminController@index']);
            Route::get('edit', ['as' => 'edit', 'uses' => 'ArticleAdminController@edit']);
            Route::post('post', ['as' => 'post', 'uses' => 'ArticleAdminController@post']);
            Route::get('show/{id}', ['as' => 'show', 'uses' => 'ArticleAdminController@show']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ArticleAdminController@update']);
            Route::post('restore/{id}', ['as' => 'restore', 'uses' => 'ArticleAdminController@restore']);
            Route::post('delete/{id}', ['as' => 'delete', 'uses' => 'ArticleAdminController@delete']);
        });

        //User admin routes
        Route::group(['prefix' => 'User', 'as' => 'user::'], function(){
            Route::get('/', ['as' => 'list', 'uses' => 'UserAdminController@index']);
            Route::post('delete/{id}', ['as' => 'delete', 'uses' => 'UserAdminController@delete']);
            Route::post('restore/{id}', ['as' => 'restore', 'uses' => 'UserAdminController@restore']);
        });

        //Category admin routes
        Route::group(['prefix' => 'Category', 'as' => 'category::'], function(){
            Route::get('/', ['as' => 'create', 'uses' => 'CategoryAdminController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'CategoryAdminController@create']);
            Route::post('delete/{id}', ['as' => 'delete', 'uses' => 'CategoryAdminController@delete']);
        });

        //Comment admin routes
    });

    Route::get('/login', ['as' => 'view', 'uses' => 'AdminController@loginView']);
    Route::post('/login', ['as' => 'login', 'uses' => 'AdminController@login']);



});

