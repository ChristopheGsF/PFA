@extends('layouts.app')

@section('content')
<div class="container">
  <form class="well form-horizontal" action='update' method="post"  id="contact_form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <fieldset>

      <!-- Form Name -->
      <legend>Edit an article:</legend>

      <!-- Text input-->

      <div class="form-group">
        <label class="col-md-4 control-label">Title</label>
        <div class="col-md-4 inputGroupContainer">
          <input  name="title" placeholder="{{$article->title}}" class="form-control"  type="text" value="{{$article->title}}">

        </div>
      </div>
      <!-- Text area -->

      <div class="form-group">
        <label class="col-md-4 control-label">Content</label>
        <div class="col-md-4 inputGroupContainer">
          <textarea class="form-control" name="content" placeholder="Content">{{$article->content}}</textarea>
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          <button type="submit" class="btn btn-warning" > Send </button>

        </div>
      </div>
      @foreach ($errors->all() as $message)
          {{$message}}
          <br>
      @endforeach
    </fieldset>
  </form>
  <form action='show' method="get">
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    {{-- @if (isAdmin::isadmin() == 1)   --}}
      <button type="submit" class="btn btn-danger"> Back </button>
    {{-- @endif --}}
  </form>
</div>
@endsection
