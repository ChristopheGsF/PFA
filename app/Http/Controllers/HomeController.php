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

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::Paginate(3);
        $likes = Like::all();
        $articles->withPath('articles');
        return view("ihome", ['articles' => $articles, 'likes' => $likes]);
    }
}
