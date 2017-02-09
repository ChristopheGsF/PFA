<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;
use \App\Http\Middleware\isAdmin;
use Validator;


class ArticlesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $articles = Article::simplePaginate(5);
        return view("articles.index", ['articles' => $articles]);
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

       if ($validator->fails()) {
           return redirect('articles/create')
                       ->withErrors($validator)
                       ->withInput();
       }
        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id =  Auth::user()->id;
        $article->save();
        $request->session()->flash('alert-success', 'Article was successful created!');
        return redirect('articles/index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $article = Article::find($id);
        return view("articles.show", ['article' => $article]);
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
     ]);

     if ($validator->fails()) {
         return redirect('articles/'.$id.'/edit')
                     ->withErrors($validator)
                     ->withInput();
     }
      $article = Article::find($id);
      $article->title = $request->title;
      $article->content = $request->content;
      $article->save();
      $request->session()->flash('alert-success', 'Article was successful edited!');
      return redirect('articles/index');
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
        return redirect('articles/index');
    }
}
