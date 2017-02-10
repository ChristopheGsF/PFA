<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'articles'], function () {
  Route::get('/index',['as' => 'articles.index', 'uses' => "ArticlesController@index"]);
  Route::get('/create',['as' => 'articles.create', 'uses' => "ArticlesController@create", 'middleware' => 'auth']);
  Route::post('/store',['as' => 'articles.store', 'uses' => "ArticlesController@store", 'middleware' => 'auth']);
  Route::get('/{id}/show', ['as' => 'articles.show', 'uses' => "ArticlesController@show"]);
  Route::get('/{id}/edit', ['as' => 'articles.edit', 'uses' =>"ArticlesController@edit", 'middleware' => 'auth']);
  Route::post('/{id}/update',['as' => 'articles.update', 'uses' => "ArticlesController@update", 'middleware' => 'auth']);
  Route::post('/{id}/delete', ['as' => 'articles.delete', 'uses' => "ArticlesController@destroy", 'middleware' => 'auth']);
  Route::post('/{id}/comment/store',['as' => 'comments.store', 'uses' => "CommentaireController@store", 'middleware' => 'auth']);
  Route::post('/{id}/comment/update',['as' => 'comments.update', 'uses' => "CommentaireController@update", 'middleware' => 'auth']);
  Route::post('/{id}/comment/delete', ['as' => 'comments.delete', 'uses' => "CommentaireController@destroy", 'middleware' => 'auth']);
});

Route::group(['prefix' => 'user'], function () {
  Route::get('/', ['as' => 'user.hisprofil', 'uses' => "UserController@index", 'middleware' => 'auth']);
  Route::get('/edit_img', ['as' => 'user.edit_img', 'uses' => "UserController@edit_img", 'middleware' => 'auth']);
  Route::get('/{id}/show', ['as' => 'user.profil', 'uses' => "UserController@show"]);
});


Auth::routes();


Route::get('/home', 'HomeController@index');
Route::get('/', function () {
    return view('welcome');
});
