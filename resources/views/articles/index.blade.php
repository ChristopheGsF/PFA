@extends('layouts.app')
@include('messages.success')
@section('content')
  <script>

  var popupSize = {
    width: 780,
    height: 550
  };

  $(document).on('click', '.social-buttons > a', function(e){

    var
    verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
    horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

    var popup = window.open($(this).prop('href'), 'social',
    'width='+popupSize.width+',height='+popupSize.height+
    ',left='+verticalPos+',top='+horisontalPos+
    ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

    if (popup) {
      popup.focus();
      e.preventDefault();
    }

  });
  </script>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center release_text">Dernières sorties</h3>
      </div>
    </div>
    <?php $i = 3; ?>
  @foreach ($articles as $article)
@if ($i == 3)
  <div class="row">
    <?php $i = 0; ?>
@endif
      <div class="col-md-4">
        <div class="img-article">
          @if ($article->img)
            <a href="{{ route('articles.show', ['id' => $article->id]) }}"><img src="{{$article->img}}" class="img-responsive" alt="img-article"></a>
          @endif

          @if(Auth::check())

            <div class="like">
              <form action='{{ route('articles.like', ['id' => $article->id]) }}' method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn-like" type="submit">
                  <i class="fa fa-thumbs-up icon-like" style="font-size : 30px;"></i>
                </button>
              </form>
              @foreach ($likes as $like)
                @if ($like->user_id == Auth::user()->id && $like->article_id == $article->id)
                  <form action='{{ route('articles.delete_like', ['id' => $like->id]) }}' method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger"> Dislike </button>
                  </form>
                @endif
            @endforeach


          </div>
        @endif
        <div class="social-buttons">
          <a href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse"
          target="_blank">
          <i class="fa fa-facebook-official" style="font-size : 30px;"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url="
        target="_blank">
        <i class="fa fa-twitter-square" style="font-size : 30px;"></i>
      </a>
      <a href="https://plus.google.com/share?url="
      target="_blank">
      <i class="fa fa-google-plus-square" style="font-size : 30px;"></i>
    </a>
  </div>
</div>
<a class="article-title-link" href="{{ route('articles.show', ['id' => $article->id]) }}">
  <h2 class="article-title text-center">
    {{$article->title}}
  </h2>
</a>

<p class="text-center"> <span class="glyphicon glyphicon-time"></span> {{$article->release}}</p>

<a href="{{ route('articles.show', ['id' => $article->id]) }}" style="text-decoration: none;"><button  class="btn-details center-block">Détails</button></a>

<hr>
<?php $i ++; ?>
</div>
@if ($i == 3)
</div>
@endif
@endforeach

<div class="text-center">{{ $articles->links() }}</div>
</div>
@endsection
