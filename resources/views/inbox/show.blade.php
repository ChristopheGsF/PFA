@extends('inbox.inbox')
@section('message')
  <div class="panel panel-default contacts">
    @foreach ($users as $user)
    @if (auth::user()->id != $inboxes->f_user)
        @if ($user->id == $inboxes->f_user)
          <div class="panel-heading">Messages with {{$user->name}}</div>
        @endif
      @else
        @if ($user->id == $inboxes->s_user)
          <div class="panel-heading">Messages with {{$user->name}}</div>
        @endif
      @endif
    @endforeach
  <div class="panel-body">
    @foreach ($convs as $conv)
      @foreach ($users as $user)
        @if ($user->id == $conv->user_id)
          <div class="row">
            <div class="col-md-1">
              <img style="width:2vw; height:2hw;" src="{{$user->img}}" alt="">
            </div>
              <div class="col-md-1">
                {{$user->name}}
              </div>
              <div class="col-md-7">
                {{$conv->content}}
              </div>
              <div class="col-md-3">
                {{$conv->created_at}}
              </div>
            </div>
            <hr>
          @endif
        @endforeach
      @endforeach
      <form action="send" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input name="hash" type="hidden" value="{{$inboxes->hash}}"/>
        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
          <textarea class="form-control" name="content" placeholder=""></textarea>
          @if ($errors->has('content'))
            <span class="help-block">
              <strong>{{ $errors->first('content') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-warning" > Send </button>

        </div>
      </form>
    </div>
  </div>
@endsection
