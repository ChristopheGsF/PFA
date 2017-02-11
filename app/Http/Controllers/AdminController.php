<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Article;
use App\Comment;
use App\Contact;

class AdminController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index($id)
  {
    if ($id == 1) {
      $articles = Article::orderBy('articles.updated_at','DESC')->Paginate(10);
      $articles->withPath('');
      return view("admin.articles_table", ['articles' => $articles]);
    }
    if ($id == 2) {
      $comments = Comment::orderBy('comments.updated_at','DESC')->Paginate(10);
      $comments->withPath('');
      return view("admin.comments_table", ['comments' => $comments]);
    }
    if ($id == 3) {
      $contacts = Contact::orderBy('contacts.updated_at','DESC')->Paginate(10);
      $contacts->withPath('');
      return view("admin.contacts_table", ['contacts' => $contacts]);
    }
    else{
      $users = User::orderBy('users.updated_at','DESC')->Paginate(10);
      $users->withPath('');
      return view("admin.users_table", ['users' => $users]);
    }
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
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $contact = Contact::find($id);
    return view("admin.show", ['contact' => $contact]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $user = User::find($id);
    if ($user->isAdmin) {
        $user->isAdmin = 0;
        $user->save();
    }
    else {
      $user->isAdmin = 1;
      $user->save();
    }
    session()->flash('alert-danger', 'User was successful updated!');
    return back();
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
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();
    session()->flash('alert-danger', 'User was successful deleted!');
    return back();
  }

  public function destroy_contact($id)
  {
    $contact = Contact::find($id);
    $contact->delete();
    session()->flash('alert-danger', 'Contact was successful deleted!');
    return back();
  }
}
