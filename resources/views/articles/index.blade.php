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
                    <img src="{{$article->img}}" alt="img-article">
                    <hr class="img_empty">
                    <p>{{$article->content}}</p>
                    <form action='{{ route('articles.show', ['id' => $article->id]) }}' method="get">
                        <button type="submit" class="btn btn-warning"> Show </button>
                    </form>

                    <hr>
                @endforeach
                <form action='create' method="get">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <button type="submit" class="btn btn-success"> Create </button>
                </form>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
