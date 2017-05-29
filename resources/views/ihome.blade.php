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
<div class="container-carousel">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">

            <div class="item active">
                <img class="img-responsive" src="{{URL::asset('/images/carousel1.jpg')}}" alt="First Slide">
                <a class="logo-carousel-link" href="{{ url('/') }}"><img class="logo-carousel center-block" src="{{URL::asset('/images/logo.svg')}}"></a>
            </div>

            @foreach ($articles as $article)
            <div class="item">
                <a href="{{ route('articles.show', ['id' => $article->id]) }}"><img src="{{$article->img}}" class="img-responsive" alt="img-article"></a>
                <h2 class="caption-title"><strong>{{$article->title}}</strong>  <br> {{$article->release}}</h2>
            </div>
            @endforeach
        </div>
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center release_text">Dernières sorties</h3>
            </div>
        </div>

        <div class="row">
         <!--- <div class="col-md-2">
          <div class="list-group select-menu rotate">
              <a href="{{ route('articles.create')}}" class="list-group-item"> Create </a>
            </div>
          </div> ---->
             @foreach ($articles as $article)
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
                                        <button type="submit" class="btn btn-dislike"><i class="fa fa-thumbs-down icon-like"></i></button>
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

                   <!--- @foreach ($likes as $like)
                        @if ($like->user_id == $like->user->id && $like->article_id == $article->id)
                            <p><a href="{{route("user.profil",$like->user->id)}}">{{$like->user->name}}</a> a aimé cet article.</p>
                        @endif
                        @if(Auth::check())
                            @if ($like->user_id == Auth::user()->id && $like->article_id == $article->id)
                                <p>Vous ({{Auth::user()->name}}) avez aimé cet article.</p>
                                <form action='{{ route('articles.delete_like', ['id' => $like->id]) }}' method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger"> Dislike </button>
                                </form>
                            @endif
                        @endif
                    @endforeach --->

                    <hr>

            </div>
                @endforeach



        </div>
        <a class="plus_link" href="{{ route('articles.index')}}"><button  class="btn-plus center-block"><span class="plus glyphicon glyphicon-plus"></span>
        </a>
    </div>
@endsection
