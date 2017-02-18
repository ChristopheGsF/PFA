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
    $contacts = \DB::table('inboxe_groups')->where('f_user' , Auth::user()->name)
                         ->orWhere('s_user' , Auth::user()->name)->get() ;
  //                       dd($contacts);
      return view("inbox.inbox", ['contacts' => $contacts]);
}

  public function contacts()
  {
    $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->name)
                         ->orWhere('s_user' , Auth::user()->name)->get() ;
    $users = User::all();
    return view("inbox.contacts", ["users" => $users,'contacts' => $contacts]);
  }

  public function newgroup(Request $request, $id)
  {
    $groups =  \DB::table('inboxe_groups')->where(
                      [['f_user' ,'=', Auth::user()->name],
                      ['s_user' ,'=', $id]])
                       ->orWhere(
                      [['s_user' ,'=', Auth::user()->name],
                      ['f_user' ,'=', $id]])
                      ->first();
    if (!$groups) {
      $group = new inboxeGroup;
      $group->hash = rand();
      $group->f_user = Auth::user()->name;
      $group->s_user = $id;
      $group->save();
      $request->session()->flash('alert-success', 'Chat was successful created!');
      $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->name)
                           ->orWhere('s_user' , Auth::user()->name)->get() ;
      return view("inbox.inbox", ['contacts' => $contacts]);
    }
    else
    {
      $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->name)
                           ->orWhere('s_user' , Auth::user()->name)->get() ;
      $request->session()->flash('alert-danger', 'Chat already created!');
      return view("inbox.inbox", ['contacts' => $contacts]);
    }
  }

  public function show($id)
  {
    $contacts =  \DB::table('inboxe_groups')->where('f_user' , Auth::user()->name)
                         ->orWhere('s_user' , Auth::user()->name)->get();
    $inboxes =  \DB::table('inboxe_groups')->where('hash' , $id)->first();
    $convs =  \DB::table('inboxes')->where('hash_id' , $id)->orderBy('updated_at','ASC')->get();
    return view("inbox.show", ['contacts' => $contacts, 'convs' => $convs, 'inboxes' => $inboxes]);

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
   $inbox->user_name =  Auth::user()->name;
   $inbox->save();
   $request->session()->flash('alert-success', 'Message was send!');
   return back();
  }
}
