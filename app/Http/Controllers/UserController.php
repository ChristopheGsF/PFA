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

      return view("user.profil",['articles' => $articles]);
  }
}
