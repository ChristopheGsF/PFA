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
        <div class="col-image">
          @if($article->img)
            <img src="{{ asset($article->img) }}" class="img-responsive" alt="img-article" />
          @endif
        <h2 class="caption-title"><strong>{{$article->title}}</strong>  <br> {{$article->release}}</h2>
        </div>
      </div>
    </div>
      <div class="row">
      <div class="col-md-12">
              <p class="article-text">{{$article->content}}</p>
      </div>
      </div>
    <div class="row row_desc">
      <div class="col-md-4">
        <img src="{{ asset($article->brand_img) }}" class="img-responsive brand_img" alt="img-article" />
      </div>
      <div class="col-md-7 col-md-offset-1">
        <h3 class="details">Marque : {{$article->brand}}</h3>
        <hr class="redhr">
        <h3 class="details">Modèle : {{$article->model}}</h3>
        <hr class="redhr">
        <h3 class="details">Coloris : {{$article->color}}</h3>
        <hr class="redhr">
        <h3 class="details">Prix : {{$article->price}}</h3>
      </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
              @if ( Auth::check())
                  <h4>Laissez un commentaire !</h4>
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
              @endif
              <hr>
        </div>
              <div class="col-md-6">
                @foreach ($comments as $comment)
                <div class="row">

                  <div class="col-md-2">
                    <a href={{route("user.profil",$comment->user->id)}}>
                      <img class="media-object center-block" style="width: 70px; height:70px;" src="{{$comment->user->img}}" alt="">
                    </a>
                  </div>
                  <div class="col-md-8">
                    <a href={{route("user.profil",$comment->user->id)}}>
                    <h4 class="media-heading">{{$comment->user->name}} <small>&nbsp;{{ $comment->created_at }}</small>
                    </h4>

                    </a>
                    <p class="comment_content">{{ $comment->content }}</p>
                    <form class="comment_update" action='{{ route('comments.update', ['id' => $comment->id]) }}' method="post">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                      <textarea name="content">{{ $comment->content }}</textarea>
                      <button type="submit" class="btn btn_delete btn-success pull-right"> Save </button>
                      <a class="btn btn-default comment_back pull-right"> Back </a>
                    </form>
                  </div>
                  <div class="col-md-2">
                    @if (Auth::check())
                      @if (Auth::user()->id == $comment->user_id)
                        <button type="submit" class="btn btn_edit comment_edit"><img src="{{URL::asset('/images/icon_edit.svg')}}" class="img-responsive" alt="img-article"style="width:10px; height:10px;" /></button>
                        <form class="comment_delete" action='{{ route('comments.delete', ['id' => $comment->id]) }}' method="post">
                          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                          <button type="submit" class="btn btn_delete"><img src="{{URL::asset('/images/icon_delete.png')}}" class="img-responsive" alt="img-article"              style="width:10px; height:10px;" /></button>
                        </form>
                      @endif
                    @endif
                  </div>
                </div>
                  <hr>
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
