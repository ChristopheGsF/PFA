@extends('layouts.app')
@include('messages.success')
@section('content')
  <div class="container">
    <form class="well form-horizontal" action='store' method="post" enctype="multipart/form-data" novalidate="novalidate" accept-charset="UTF-8" id="contact_form">
      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
      <fieldset>

        <!-- Form Name -->
        <legend>Create an article:</legend>

        <!-- Text input-->

        <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Brand</label>
          <div class="col-md-4 inputGroupContainer">
            <select name="brand">
              <option>Selectionnez une marque</option>
              <option value="nike">Nike</option>
              <option value="adidas">Adidas</option>
              <option value="jordan">Jordan</option>
              <option value="puma">Puma</option>
              <option value="reebok">Reebok</option>
              <option value="asics">Asics</option>
              <option value="vans">Vans</option>
              <option value="lacoste">Lacoste</option>
            </select>
            @if ($errors->has('brand'))
              <span class="help-block">
                    <strong>{{ $errors->first('brand') }}</strong>
                </span>
            @endif
          </div>
        </div>


        <!-- Text input-->

        <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Model</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="model" placeholder="Model" class="form-control" value="{{ old('model') }}"  type="text">
            @if ($errors->has('model'))
              <span class="help-block">
                    <strong>{{ $errors->first('model') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <!-- Text input-->

        <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Size</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="size" placeholder="Size" class="form-control" value="{{ old('size') }}"  type="text">
            @if ($errors->has('size'))
              <span class="help-block">
                    <strong>{{ $errors->first('size') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <!-- Text input-->

        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Price</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="price" placeholder="Price" class="form-control" value="{{ old('price') }}"  type="text">
            @if ($errors->has('price'))
              <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <!-- Text input-->

        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Color</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="color" placeholder="Color" class="form-control" value="{{ old('color') }}"  type="text">
            @if ($errors->has('color'))
              <span class="help-block">
                    <strong>{{ $errors->first('color') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <!-- Text input-->

        <div class="form-group{{ $errors->has('release') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Release</label>
          <div class="col-md-4 inputGroupContainer">
            <input  name="release" placeholder="Release" class="form-control" value="{{ old('release') }}"  type="text">
            @if ($errors->has('release'))
              <span class="help-block">
                    <strong>{{ $errors->first('release') }}</strong>
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

        <!-- Image -->

        <div class="form-group">
          <label class="col-md-4 control-label">Image</label>
          <div class="col-md-4 inputGroupContainer">
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

    {{-- @if (isAdmin::isadmin() == 1)   --}}
      <a href="{{ route('articleuser.index')}}" class="btn btn-danger"> Back </a>
    {{-- @endif --}}


  </div>
@endsection
