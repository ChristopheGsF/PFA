@extends('layouts.app')
@include('messages.success')

@section('content')

  <script>
  $(document).ready(function(){
    $('.comment_update').hide();
    $('.comment_edit').click(function(){
      $('.comment_content').hide();
      $('.comment_edit').hide();
      $('.comment_update').show(200);
      $('.comment_delete').hide();
    });
    $('.comment_back').click(function(){
      $('.comment_content').show(200);
      $('.comment_edit').show(200);
      $('.comment_update').hide();
      $('.comment_delete').show(200);
    });
  });
  </script>
  <div class="container">
    <div class="row">
    <div class="col-md-12">
      <h1>{{$article->title}}</h1>
        <p>Created: {{$article->created_at}}</p>
    </div>
    </div>
      <div class="row">
      <div class="col-md-8">
        @if($article->img)
          <img src="{{$article->img}}" class="img-responsive" alt="img-article">
        @endif
      </div>
      <div class="col-md-4">
              <p>{{$article->content}}</p>
              @if ( Auth::check())
                <hr>

                <div class="well">
                  <h4>Leave a Comment:</h4>
                  <form  action='comment/store' method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}"/>
                    <input name="article_id" type="hidden" value="{{ $article->id }}"/>
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                      <textarea class="form-control" name="content" row="3"></textarea>
                      @if ($errors->has('content'))
                          <span class="help-block">
                              <strong>{{ $errors->first('content') }}</strong>
                          </span>
                      @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              @endif
              <hr>

              <!-- Comment -->
              @foreach ($comments as $comment)
                <div class="media">
                  <a class="pull-left" href={{route("user.profil",$comment->user->id)}}>
                    <img class="media-object" style="width: 50px; height:50px;" src="{{$comment->user->img}}" alt="">
                    <div class="media-body">
                      <h4 class="media-heading">{{$comment->user->name}}
                      </a>
                    </h4>
                    <small>&nbsp;{{ $comment->created_at }}</small>

                    <p class="comment_content">{{ $comment->content }}</p>
                    @if (Auth::check())
                      @if (Auth::user()->id == $comment->user_id)
                        <button type="submit" class="btn btn-danger comment_edit"> Edit </button>
                        <form class="comment_update" action='{{ route('comments.update', ['id' => $comment->id]) }}' method="post">
                          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                          <textarea name="content">{{ $comment->content }}</textarea>
                          <button type="submit" class="btn btn-success"> Save </button>
                          <a class="btn btn-default comment_back"> Back </a>
                        </form>

                        <form class="comment_delete" action='{{ route('comments.delete', ['id' => $comment->id]) }}' method="post">
                          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                          <button type="submit" class="btn btn-warning"> Delete </button>
                        </form>
                      @endif
                    @endif
              </div>
            </div>
      </div>
          @endforeach
          {{ $comments->links() }}
        </div>
          <a href="{{ route('articles.index') }}" class="btn btn-danger"> Back </a>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
