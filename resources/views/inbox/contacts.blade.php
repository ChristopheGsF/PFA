@extends('inbox.inbox')
@section('message')
  <div class="panel panel-default contacts">
    <div class="panel-heading">Contacts</div>
    <div class="panel-body">
      @foreach ($users as $user)
        @if ((auth::user()->name != $user->name))
          <a href="{{route('inboxe.newgroup', ["id" => $user->id] )}}" class="list-group-item ">{{$user->name}}</a>
        @endif
      @endforeach
  </div>
  </div>
@endsection
