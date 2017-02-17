<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Article;
use Validator;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
           'content' => 'required',
       ]);

       if ($validator->fails()) {
           return redirect('articles/'.$request->id.'/show')
                       ->withErrors($validator)
                       ->withInput();
       }
        $comment = new Comment;
        $comment->article_id = $request->article_id;
        $comment->content = $request->content;
        $comment->user_id =  Auth::user()->id;
        $comment->save();
        $request->session()->flash('alert-success', 'Comment was successful created!');
       return redirect('articles/'.$request->id.'/show');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $comment = Comment::find($id);
        if ($comment->user_id != Auth::user()->id)
            if (!Auth::user()->isAdmin)
              return "error";
      $validator = Validator::make($request->all(), [
         'content' => 'required'
     ]);

     if ($validator->fails()) {
         return redirect('articles/'.$comment->article_id.'/show')
                     ->withErrors($validator)
                     ->withInput();
     }
      $comment->content = $request->content;
      $comment->save();
      $request->session()->flash('alert-success', 'Comment was successful edited!');
      return redirect('articles/'.$comment->article_id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment = Comment::find($id);
      $id = $comment->article->id;
          $comment->delete();
          session()->flash('alert-danger', 'Comment was successful deleted!');
          return back();
    }
}
