@extends('layouts.app')
@include('messages.success')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <h1>{{$contact->title}}</h1>
              <p class="lead">
                <p>By : {{$contact->name}} {{$contact->last_name}}</p>
                <p>Contact : {{$contact->email}} / Number : {{$contact->number}}</p>
                <p>Created:{{$contact->created_at}}</p>
            </p>
              <hr>
              <p>{{$contact->content}}</p>
        </div>
        <form action='{{ route('admin.index', 3) }}' method="get">
          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
          <button type="submit" class="btn btn-danger"> Back </button>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
