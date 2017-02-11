@extends('layouts.app')
@section('content')
  @include('messages.success')

  <div class="container">
    <form class="well form-horizontal" action='store' method="post"  id="contact_form">
      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
      @if (Auth::check())
        <input name="user_id" type="hidden" value={{ Auth::user()->id }}/>
      @endif
      <fieldset>

        <!-- Form Name -->
        <legend>Contact:</legend>

        <!-- Text input-->
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Title</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="title" placeholder="Title" class="form-control" value="{{ old('title') }}"  type="text">
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
            <textarea class="form-control" name="content" placeholder="Content">{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Email</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="email" placeholder="Email" class="form-control"  type="text" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
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
    <form action='{{route('articles.index')}}' method="get">
        <button type="submit" class="btn btn-danger"> Back </button>
    </form>
  </div>
@endsection
