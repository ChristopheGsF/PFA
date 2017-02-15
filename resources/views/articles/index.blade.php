@extends('layouts.app')
@include('messages.success')
@section('content')
    <div class="container">
        <div class="row">

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

                    <hr>
                @endforeach
                <p><a href="{{ route('articles.create')}}" class="btn btn-success"> Create </a></p>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
