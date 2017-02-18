@extends('layouts.app')
@include('messages.success')
@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div class="list-group select-menu rotate">
              <a href="{{ route('articles.create')}}" class="list-group-item"> Create </a>
            </div>
          </div>

            <div class="col-md-8 col-md-offset-2">
                {{ $articles->links() }}
                @foreach ($articles as $article)
                    <h2>
                        {{$article->title}}
                    </h2>
                    <p class="lead">
                      by <a href="{{route("user.profil",$article->user->id)}}">{{$article->user->name}}</a>
                    </p>
                    <p>Created: {{$article->created_at}}</p>
                    <hr>
                    @if ($article->img)
                    <img src="{{$article->img}}" alt="img-article" style="width : 500px; height : auto;">
                    <hr>
                    @endif
                    <p>{{$article->content}}</p>
                    @foreach ($likes as $like)
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
                    @endforeach
                    <a href="{{ route('articles.show', ['id' => $article->id]) }}" class="btn btn-warning"> Show </a>

                    @if(Auth::check())
                        <form action='{{ route('articles.like', ['id' => $article->id]) }}' method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary"> Like </button>
                        </form>
                    @endif
                    <br/>
                    <br/>

                    <!-- Facebook Partage -->
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-share-button" data-layout="box_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Partager</a></div>
                    <!-- Twitter Partage -->
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                        <a href="https://twitter.com/share" class="twitter-share-button" data-text="{{$article->title}}  <?php echo "\n"; ?>par {{$article->user->name}} <?php echo "\n"; ?>Créée : {{$article->created_at}} <?php echo "\n"; ?>{{$article->content}}<?php echo "\n"; ?>Lien de l'article :" data-lang="fr" data-size="large">Tweeter</a>
                   <!-- Google+ Partage -->
                       <div class="a2a_kit" style="width : 70px; float:left;">
                            <a class="a2a_button_google_plus_share" data-text="{{$article->title}}  <?php echo "\n"; ?>par {{$article->user->name}} <?php echo "\n"; ?>Créée : {{$article->created_at}} <?php echo "\n"; ?>{{$article->content}}<?php echo "\n"; ?>Lien de l'article :" data-annotation="vertical-bubble" data-href="http://127.0.0.1:8000/articles"></a>
                        </div>
                        <script async src="//static.addtoany.com/menu/page.js"></script>
                    <hr>
                @endforeach
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
