@extends('layouts.app')
@section('content')
  @include('messages.success')
  <div class="container">
    <div class="row">

      <div class="col-md-3">
        <p class="lead">Dashboard</p>
        <div class="list-group select-menu rotate">
          <a href="{{route("admin.index", ["id" => 0])}}" class="list-group-item ">Users</a>
          <a href="{{route("admin.index", ["id" => 1])}}" class="list-group-item ">Articles</a>
          <a href="{{route("admin.index", ["id" => 2])}}" class="list-group-item ">Comments</a>
          <a href="{{route("admin.index", ["id" => 3])}}" class="list-group-item ">Tickets</a>
        </div>
      </div>


      <div class="col-md-9">

        @yield('table')

      </div>
    </div>
  </div>
@endsection
