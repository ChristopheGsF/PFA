<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Auth;

class UserController extends Controller
{
  public function index()
  {
      $articles = User::find(Auth::user()->id)->articles()->simplePaginate(1);
      $user = User::find(Auth::user()->id);

      return view("user.profil",['articles' => $articles, 'user' => $user]);
  }

  public function show($id)
  {
    $user = User::find($id);
    $articles = User::find($user->id)->articles()->simplePaginate(5);
      return view("user.profil",['articles' => $articles, 'user' => $user]);
  }

  public function edit_img(Request $request)
  {
    $id = Auth::user()->id;
    return DB::table('users')
            ->where('id', $id)
            ->update(array('img' => $request->img));
//      return view("user.profil",['articles' => $articles, 'user' => $user]);
  }

}
