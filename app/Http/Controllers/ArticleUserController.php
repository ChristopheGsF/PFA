<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ArticleUser;
use App\Comment;
use App\User;
use App\Like;
use \App\Http\Middleware\isAdmin;
use Validator;
use Input;

class ArticleUserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $articles = ArticleUser::Paginate(3);
    $articles->withPath('articles');
    return view("articleuser.index", ['articles' => $articles]);
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view("articleuser.create");
  }
  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'brand' => 'required',
      'model' => 'required',
      'size' => 'required|regex:/[0-9]{2}/',
      'price' => 'required|regex:/[0-9]/',
      'color' => 'required',
      'release' => 'required',
      'content' => 'required',
    ]);
    if (Input::hasFile('image') && (strpos("jpgpng", $request->file('image')->getClientOriginalExtension()) === false)) {
      $request->session()->flash('alert-danger', 'Image bad extension ! (only jpg or png)');
      return redirect('articleuser/create')
      ->withErrors($validator)
      ->withInput();
    }
    elseif ($validator->fails()) {
      return redirect('articleuser/create')
      ->withErrors($validator)
      ->withInput();
    }
    $article = new ArticleUser;
    $user_id = Auth::user()->id;
    if (empty(ArticleUser::all()))
      $articles = ArticleUser::all()->last()->id;
    else
      $articles = 0;
    $articles += 1;
    if (Input::hasFile('image')) {
      $imageName = 'Article_image_'. $articles .'_utilisateur_numero_' . $user_id . '.' .
      $request->file('image')->getClientOriginalExtension();
      $requete_nom_image = $request->file('image')->move(
        base_path() . '/public/images/catalog/', $imageName
      );
      $article->img = '/images/catalog/'. $imageName;
    }
    $article->content = $request->content;
    $article->brand = $request->brand;
    $article->release = $request->release;
    $article->model = $request->model;
    $article->price = $request->price;
    $article->size = $request->size;
    $article->color = $request->color;
    $article->brand = $request->brand;
    $article->user_id =  Auth::user()->id;
    $article->brand_img = '/images/brand/'. $request->brand .'.png';
    $article->save();
    $request->session()->flash('alert-success', 'Article was successful created!');
    return redirect(route('articleuser.index'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $article = ArticleUser::find($id);
    return view("articleuser.show", ['article' => $article]);
  }
  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $article = ArticleUser::find($id);
    if ($article->user_id != Auth::user()->id)
    if (!Auth::user()->isAdmin)
    return "error";
    return view("articleuser.edit", ['article' => $article]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $article = ArticleUser::find($id);
    if ($article->user_id != Auth::user()->id)
    if (!Auth::user()->isAdmin)
    return "error";
    $validator = Validator::make($request->all(), [
      'brand' => 'required',
      'model' => 'required',
      'size' => 'required|regex:/[0-9]{2}/',
      'price' => 'required|regex:/[0-9]/',
      'color' => 'required',
      'release' => 'required',
      'content' => 'required',
    ]);
    if (Input::hasFile('image') && (strpos("jpgpng", $request->file('image')->getClientOriginalExtension()) === false)) {
      $request->session()->flash('alert-danger', 'Image bad extension ! (only jpg or png)');
      return redirect('articleuser/'.$id.'/edit')
      ->withErrors($validator)
      ->withInput();
    }
    elseif ($validator->fails()) {
      return redirect('articleuser/'.$id.'/edit')
      ->withErrors($validator)
      ->withInput();
    }
    $user_id = Auth::user()->id;
    $article->brand = $request->brand;
    $article->model = $request->model;
    $article->size = $request->size;
    $article->price = $request->price;
    $article->color = $request->color;
    $article->release = $request->release;
    $article->content = $request->content;
    if (Input::hasFile('image')) {
      $imageName = 'Article_image_'. $article->id .'_utilisateur_numero_' . $user_id . '.' .
      $request->file('image')->getClientOriginalExtension();
      $requete_nom_image = $request->file('image')->move(base_path() . '/public/images/catalog/', $imageName);
      $article->img = '/images/catalog/'. $imageName;
    }
    $article->brand_img = '/images/brand/'. $request->brand . '.png';
    $article->save();
    $request->session()->flash('alert-success', 'Article was successful edited!');
    return redirect('/articles');
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $article = ArticleUser::find($id);
    if ($article->user_id != Auth::user()->id)
    if (!Auth::user()->isAdmin)
    return "error";
    $article->delete();
    session()->flash('alert-danger', 'Article was successful deleted!');
    return redirect('articles');
  }
}
