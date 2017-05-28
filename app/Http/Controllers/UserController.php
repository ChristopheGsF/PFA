<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Like;
use App\User;
use Illuminate\Support\Facades\Auth;
use Input;
use Validator;
use DB;

class UserController extends Controller
{
  public function index()
  {
      $articles = User::find(Auth::user()->id)->articles()->simplePaginate(5);
      $user = User::find(Auth::user()->id);
      $likes = User::find(Auth::user()->id)->likes()->simplePaginate();
      $posts = Article::all();

      return view("user.profil",['articles' => $articles, 'user' => $user, 'likes' => $likes, 'posts' => $posts]);
  }

  public function show($id)
  {
    $user = User::find($id);
    $articles = User::find($user->id)->articles()->simplePaginate(5);
      return view("user.profil",['articles' => $articles, 'user' => $user]);
  }

  public function edit_img(Request $request)
  {
    if (Input::hasFile('image')) {
      if (strpos("jpgpng", $request->file('image')->getClientOriginalExtension()) === false) {
        $request->session()->flash('alert-danger', 'Profil image bad extension ! (only jpg or png)');
        return back();
      }
      $id = Auth::user()->id;
      $imageName = 'Profil_image_utilisateur_numero_' . $id . '.' .
      $request->file('image')->getClientOriginalExtension();
      $requete_nom_image = $request->file('image')->move(
        base_path() . '/public/images/catalog/', $imageName
      );
      $db_users_img = DB::table('users')
      ->where('id', $id)
      ->update(['img'=>'/images/catalog/'. $imageName]);
      $request->session()->flash('alert-success', 'Profil image updated !');
      return redirect('user');
    }
    $request->session()->flash('alert-danger', 'Profil image is missing !');
    return redirect('user');
  }

}
