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

Route::group(['prefix' => 'admin', 'middleware' => 'is.admin'], function () {
  Route::get('/{id}',['as' => 'admin.index', 'uses' => "AdminController@index"]);
  Route::post('/delete/{id}', ['as' => 'admin.delete', 'uses' => "AdminController@destroy"]);
  Route::post('/edit/{id}', ['as' => 'admin.edit', 'uses' => "AdminController@edit"]);
  Route::post('/delete_contact/{id}', ['as' => 'admin.delete_contact', 'uses' => "AdminController@destroy_contact"]);
  Route::post('/show/{id}', ['as' => 'admin.show', 'uses' => "AdminController@show"]);
});

Route::group(['prefix' => 'inbox', 'middleware' => 'auth'], function () {
  Route::get('/', ['as' => 'inboxe.index', 'uses' => "InboxController@index"]);
  Route::get('/{id}/show', ['as' => 'inboxe.show', 'uses' => "InboxController@show"]);
  Route::get('/contacts', ['as' => 'inboxe.contacts', 'uses' => "InboxController@contacts"]);
  Route::get('{id}/newgroup', ['as' => 'inboxe.newgroup', 'uses' => "InboxController@newgroup"]);
  Route::post('{id}/send',['as' => 'inboxe.send', 'uses' => "InboxController@send"]);
});


Route::get('/',['as' => 'index', 'uses' => "HomeController@index"]);
Route::get('/home',['as' => 'index', 'uses' => "HomeController@index"]);

Route::group(['prefix' => 'articles'], function () {
  Route::get('/',['as' => 'articles.index', 'uses' => "ArticlesController@index"]);
  Route::get('/create',['as' => 'articles.create', 'uses' => "ArticlesController@create", 'middleware' => 'auth']);
  Route::post('/store',['as' => 'articles.store', 'uses' => "ArticlesController@store", 'middleware' => 'auth']);
  Route::get('/{id}/show', ['as' => 'articles.show', 'uses' => "ArticlesController@show"]);
  Route::get('/{id}/edit', ['as' => 'articles.edit', 'uses' =>"ArticlesController@edit", 'middleware' => 'auth']);
  Route::post('/{id}/update',['as' => 'articles.update', 'uses' => "ArticlesController@update", 'middleware' => 'auth']);
  Route::post('/{id}/delete', ['as' => 'articles.delete', 'uses' => "ArticlesController@destroy", 'middleware' => 'auth']);
  Route::post('/{id}/comment/store',['as' => 'comments.store', 'uses' => "CommentaireController@store", 'middleware' => 'auth']);
  Route::post('/{id}/comment/update',['as' => 'comments.update', 'uses' => "CommentaireController@update", 'middleware' => 'auth']);
  Route::post('/{id}/comment/delete', ['as' => 'comments.delete', 'uses' => "CommentaireController@destroy", 'middleware' => 'auth']);
  Route::post('/{id}/like', ['as' => 'articles.like', 'uses' => "ArticlesController@like", 'middleware' => 'auth']);
  Route::post('/{id}/delete_like', ['as' => 'articles.delete_like', 'uses' => "ArticlesController@delete_like", 'middleware' => 'auth']);
});

Route::group(['prefix' => 'articleuser'], function () {
  Route::get('/',['as' => 'articleuser.index', 'uses' => "ArticleUserController@index"]);
  Route::get('/create',['as' => 'articleuser.create', 'uses' => "ArticleUserController@create", 'middleware' => 'auth']);
  Route::post('/store',['as' => 'articleuser.store', 'uses' => "ArticleUserController@store", 'middleware' => 'auth']);
  Route::get('/{id}/show', ['as' => 'articleuser.show', 'uses' => "ArticleUserController@show"]);
  Route::get('/{id}/edit', ['as' => 'articleuser.edit', 'uses' =>"ArticleUserController@edit", 'middleware' => 'auth']);
  Route::post('/{id}/update',['as' => 'articleuser.update', 'uses' => "ArticleUserController@update", 'middleware' => 'auth']);
  Route::post('/{id}/delete', ['as' => 'articleuser.delete', 'uses' => "ArticleUserController@destroy", 'middleware' => 'auth']);
});

Route::group(['prefix' => 'user'], function () {
  Route::get('/', ['as' => 'user.hisprofil', 'uses' => "UserController@index", 'middleware' => 'auth']);
  Route::post('/edit_img', ['as' => 'user.edit_img', 'uses' => "UserController@edit_img", 'middleware' => 'auth']);
  Route::get('/{id}/show', ['as' => 'user.profil', 'uses' => "UserController@show"]);
});

Route::group(['prefix' => 'contact'], function () {
  Route::get('/create', ['as' => 'contact.create', 'uses' => "ContactController@create"]);
  Route::post('/store', ['as' => 'contact.store', 'uses' => "ContactController@store"]);
});

Auth::routes();

// Route::get('/home', 'HomeController@index');
// Route::get('/', function () {
//      return view('welcome');
//  });
