<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;
use Input;
use DB;

class UserController extends Controller
{
  public function index()
  {
      $articles = User::find(Auth::user()->id)->articles()->simplePaginate(5);
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
    if (Input::hasFile('image')) {
      $id = Auth::user()->id;
      $imageName = 'Profil_image_utilisateur_numero_' . $id . '.' .
      $request->file('image')->getClientOriginalExtension();
      $requete_nom_image = $request->file('image')->move(
        base_path() . '/public/images/catalog/', $imageName
      );
      $db_users_img = DB::table('users')
      ->where('id', $id)
      ->update(['img'=>'images/catalog/'. $imageName]);
      $request->session()->flash('alert-success', 'Profil image updated !');
      return redirect('user');
    }
    $request->session()->flash('alert-danger', 'Profil image is missing !');
    return redirect('user');
  }

}
