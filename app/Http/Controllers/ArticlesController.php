<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Comment;
use App\User;
use App\Like;
use \App\Http\Middleware\isAdmin;
use Validator;
use Input;

class ArticlesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $articles = Article::Paginate(9);
        $likes = Like::all();
        $articles->withPath('articles');
        return view("articles.index", ['articles' => $articles, 'likes' => $likes]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view("articles.create");
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
           'title' => 'required|unique:articles',
           'content' => 'required',
       ]);
       if (Input::hasFile('image') && (strpos("jpgpng", $request->file('image')->getClientOriginalExtension()) === false)) {
           $request->session()->flash('alert-danger', 'Image bad extension ! (only jpg or png)');
           return redirect('articles/create')
                       ->withErrors($validator)
                       ->withInput();
       }
       elseif ($validator->fails()) {
           return redirect('articles/create')
                       ->withErrors($validator)
                       ->withInput();
       }
        $article = new Article;
        $user_id = Auth::user()->id;
        if (empty(Article::all()))
          $articles = Article::all()->last()->id;
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
        $article->title = $request->title;
        $article->content = $request->content;
        $article->brand = $request->brand;
        $article->release = $request->release;
        $article->model = $request->model;
        $article->price = $request->price;
        $article->color = $request->color;
        $article->brand = $request->brand;
        $article->brand_img = '/images/brand/'. $request->brand .'.png';

        $article->user_id =  Auth::user()->id;
        $article->save();
        $request->session()->flash('alert-success', 'Article was successful created!');
        return redirect(route('articles.index'));
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
        $article = Article::find($id);
        $comments = Article::find($article->id)->comments()->Paginate(5);
        $comments->withPath('show');
        return view("articles.show", ['article' => $article, 'comments' => $comments]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $article = Article::find($id);
      if ($article->user_id != Auth::user()->id)
        if (!Auth::user()->isAdmin)
          return "error";
      return view("articles.edit", ['article' => $article]);
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
    $article = Article::find($id);
    if ($article->user_id != Auth::user()->id)
        if (!Auth::user()->isAdmin)
            return "error";
      $validator = Validator::make($request->all(), [
         'title' => 'required',
         'content' => 'required',
         'brand' => 'required',
         'model' => 'required',
         'price' => 'required|regex:/[0-9]/',
         'color' => 'required',
         'release' => 'required',
     ]);
     if (Input::hasFile('image') && (strpos("jpgpng", $request->file('image')->getClientOriginalExtension()) === false)) {
         $request->session()->flash('alert-danger', 'Image bad extension ! (only jpg or png)');
         return redirect('articles/'.$id.'/edit')
                     ->withErrors($validator)
                     ->withInput();
     }
     elseif ($validator->fails()) {
         return redirect('articles/'.$id.'/edit')
                     ->withErrors($validator)
                     ->withInput();
     }
      $user_id = Auth::user()->id;
      $article->title = $request->title;
      $article->brand = $request->brand;
      $article->model = $request->model;
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
      $article->brand_img = '/images/brand/'. $request->brand .'.png';
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
        $article = Article::find($id);
        if ($article->user_id != Auth::user()->id)
            if (!Auth::user()->isAdmin)
              return "error";
        $article->delete();
        session()->flash('alert-danger', 'Article was successful deleted!');
        return redirect('articles');
    }

    public function like(Request $request, $id)
{
    $article = Article::find($id);
    $existing_like = Like::all()->where('article_id', $article->id)->where('user_id', Auth::id())->first();
    if (is_null($existing_like)) {
      $like = new Like;
      $like->article_id = $article->id;
      $like->user_id =  Auth::user()->id;
      $like->save();
      return redirect('articles');
    }
    else {
      return redirect('articles');
    }
}

public function delete_like($id)
{
    $like = Like::find($id);
    if ($like->user_id != Auth::user()->id)
        if (!Auth::user()->isAdmin)
          return "error";
    $like->delete();
    return redirect('articles');
}
}
