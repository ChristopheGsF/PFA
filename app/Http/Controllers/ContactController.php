<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use App\Contact;

class ContactController extends Controller
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
      return view("contact.contact");
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
        'name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'number' => 'required|regex:/(0)[0-9]{9}/',
         'title' => 'required|max:255',
         'email' => 'required|email|max:255',
         'content' => 'required',
     ]);

     if ($validator->fails()) {
       $messages = $validator->messages();
         return redirect('contact/create')
                     ->withErrors($validator)
                     ->withInput();
     }
      $contact = new Contact;
      $contact->name = $request->name;
      $contact->last_name = $request->last_name;
      $contact->number = $request->number;
      $contact->title = $request->title;
      $contact->content = $request->content;
      $contact->email = $request->email;
      if(Auth::check())
        $contact->user_id =  Auth::user()->id;
      $contact->save();
      $request->session()->flash('alert-success', 'Contact was successful created!');
      return redirect('contact/create');
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
        //
    }
}
