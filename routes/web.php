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
Route::group(['prefix' => 'articles', 'middleware' => 'auth'], function () {
  Route::get('/index',['as' => 'articles.index', 'uses' => "ArticlesController@index"]);
  Route::get('/create',['as' => 'articles.create', 'uses' => "ArticlesController@create"]);
  Route::post('/store',['as' => 'articles.store', 'uses' => "ArticlesController@store"]);
  Route::get('/{id}/show', ['as' => 'articles.show', 'uses' => "ArticlesController@show"]);
  Route::get('/{id}/edit', ['as' => 'articles.edit', 'uses' =>"ArticlesController@edit"]);
  Route::post('/{id}/update',['as' => 'articles.update', 'uses' => "ArticlesController@update"]);
  Route::post('/{id}/delete', ['as' => 'articles.delete', 'uses' => "ArticlesController@destroy"]);
});


Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
  Route::get('/', ['as' => 'user.profil', 'uses' => "UserController@index"]);
});


Auth::routes();


Route::get('/home', 'HomeController@index');
Route::get('/', function () {
    return view('welcome');
});
