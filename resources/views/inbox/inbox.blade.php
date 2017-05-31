@extends('layouts.app')
@section('content')
  @include('messages.success')
  <div class="container">
    <div class="row">

      <div class="col-md-3">
        <p class="lead">Contact</p>
        <div class="list-group select-menu rotate">
          <a href="{{route("inboxe.contacts")}}" class="list-group-item ">New message</a>
          @foreach ($contacts as $contact)
            @if ($contact->f_user == auth::user()->id)
              @foreach ($users as $user)
                @if ($user->id == $contact->s_user)
              <a href="{{route("inboxe.show", ['id' => $contact->hash])}}" class="list-group-item ">{{$user->name}}</a>
            @endif
            @endforeach
            @else
              @foreach ($users as $user)
                @if ($user->id ==  $contact->f_user)
              <a href="{{route("inboxe.show", ['id' => $contact->hash])}}" class="list-group-item ">{{$user->name}}</a>
            @endif
            @endforeach
            @endif
          @endforeach
      </div>
    </div>

  </form>


  <div class="col-md-9">

    @yield('message')

  </div>
</div>
</div>
@endsection
