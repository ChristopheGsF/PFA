@extends('layouts.app')
@include('messages.success')
@section('content')
<div class="container">
  <form class="well form-horizontal" action='update' method="post" enctype="multipart/form-data" novalidate="novalidate" accept-charset="UTF-8" id="contact_form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <fieldset>

      <!-- Form Name -->
      <legend>Edit an article:</legend>

      <!-- Text input-->

      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Title</label>
        <div class="col-md-4 inputGroupContainer">
          <input  name="title" placeholder="{{$article->title}}" class="form-control"  type="text" value="{{$article->title}}">
          @if ($errors->has('title'))
              <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
        </div>
      </div>

      <!-- Text area -->

      <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Content</label>
        <div class="col-md-4 inputGroupContainer">
          <textarea class="form-control" name="content" placeholder="Content">{{$article->content}}</textarea>
          @if ($errors->has('content'))
              <span class="help-block">
                  <strong>{{ $errors->first('content') }}</strong>
              </span>
          @endif
        </div>
      </div>

      <!-- Image -->

      <div class="form-group">
        <label class="col-md-4 control-label">Image</label>
        <div class="col-md-4 inputGroupContainer">
          @if ($article->img)
            <img src="{{$article->img}}" alt="img-article" style="width : 200px; height : auto;">
            <hr>
          @endif
          <input name="image" type="file">
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          <button type="submit" class="btn btn-warning" > Send </button>

        </div>
      </div>
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
