@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">

      <div class="col-md-8 col-md-offset-2">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <h1>{{$article->title}}</h1>
              <p class="lead">
                by <a href="{{route("user.profil",$article->user->id)}}">{{$article->user->name}}</a>
              </p>
              <hr>
              <p>Created: {{$article->created_at}}</p>
              <hr>
              <img src="{{$article->img}}" alt="img-article">
              <hr>
              <p>{{$article->content}}</p>
              @if ( Auth::check())
                <hr>

                <div class="well">
                  <h4>Leave a Comment:</h4>
                  <form  action='comment/store' method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}"/>
                    <input name="article_id" type="hidden" value="{{ $article->id }}"/>
                    <div class="form-group">
                      <textarea class="form-control" name="content" row="3"></textarea>
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
                      <small>&nbsp;{{ $comment->created_at }}</small>
                    </h4>
                    {{ $comment->content }}
                    <form action='{{ route('articles.index') }}' method="get">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                      <button type="submit" class="btn btn-danger"> Edit </button>
                    </form>
                    @if (Auth::user()->id == $comment->user_id)
              <form action='{{ route('comments.delete', ['id' => $comment->id]) }}' method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <button type="submit" class="btn btn-warning"> Delete </button>
              </form>
          @endif
                    <!-- Nested Comment -->
                    {{-- <div class="media">
                    <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                  </a>
                </div> --}}
                <!-- End Nested Comment -->
              </div>
            </div>
          @endforeach
          {{ $comments->links() }}


        </div>
        <form action='{{ route('articles.index') }}' method="get">
          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
          <button type="submit" class="btn btn-danger"> Back </button>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
