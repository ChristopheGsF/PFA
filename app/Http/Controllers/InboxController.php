<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Inbox;
use App\inboxeGroup;

class InboxController extends Controller
{
  public function index()
  {
    $contacts = \DB::table('inboxe_groups')->where('f_user' , Auth::user()->id)
                         ->orWhere('s_user' , Auth::user()->id)->get() ;
                         $users = User::all();
                         return view("inbox.contacts", ["users" => $users,'contacts' => $contacts]);
}

  public function contacts()
  {
    $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->id)
                         ->orWhere('s_user' , Auth::user()->id)->get() ;
    $users = User::all();
    return view("inbox.contacts", ["users" => $users,'contacts' => $contacts]);
  }

  public function newgroup(Request $request, $id)
  {
    $users = User::all();
    $groups =  \DB::table('inboxe_groups')->where(
                      [['f_user' ,'=', Auth::user()->id],
                      ['s_user' ,'=', $id]])
                       ->orWhere(
                      [['s_user' ,'=', Auth::user()->id],
                      ['f_user' ,'=', $id]])
                      ->first();
    if (!$groups) {
      $group = new inboxeGroup;
      $group->hash = rand();
      $group->f_user = Auth::user()->id;
      $group->s_user = $id;
      $group->save();
      $request->session()->flash('alert-success', 'Chat was successful created!');
      $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->id)
                           ->orWhere('s_user' , Auth::user()->id)->get() ;
                           return view("inbox.inbox", ["users" => $users,'contacts' => $contacts]);
    }
    else
    {
      $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->id)
                           ->orWhere('s_user' , Auth::user()->id)->get() ;
      $request->session()->flash('alert-danger', 'Chat already created!');
      return view("inbox.inbox", ["users" => $users,'contacts' => $contacts]);
    }
  }

  public function show($id)
  {
    $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->id)
                         ->orWhere('s_user' , Auth::user()->id)->get();
    $inboxes =  \DB::table('inboxe_groups')->where('hash' , $id)->first();
    $convs =    \DB::table('inboxes')->where('hash_id' , $id)->orderBy('updated_at','ASC')->get();
    $users = User::all();
    return view("inbox.show", ['contacts' => $contacts, 'convs' => $convs, 'inboxes' => $inboxes, 'users' => $users]);

  }

  public function send(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
       'content' => 'required'
   ]);

   if ($validator->fails()) {
     $messages = $validator->messages();
       return back()
                   ->withErrors($validator)
                   ->withInput();
   }
   $inbox = new Inbox;
   $inbox->hash_id = $request->hash;
   $inbox->content = $request->content;
   $inbox->user_id =  Auth::user()->id;
   $inbox->save();
   $request->session()->flash('alert-success', 'Message was send!');
   return back();
  }
}
