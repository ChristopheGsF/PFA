@extends('inbox.inbox')
@section('message')
  <div class="panel panel-default contacts">
    @if (auth::user()->name != $inboxes->f_user)
      <div class="panel-heading">Messages with {{$inboxes->f_user}}</div>
      @else
        <div class="panel-heading">Messages with {{$inboxes->s_user}}</div>
    @endif
    <div class="panel-body">
      @foreach ($convs as $conv)
        <p>{{$conv->user_name}}</p>
        <p>{{$conv->content}}</p>
        <hr>
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
