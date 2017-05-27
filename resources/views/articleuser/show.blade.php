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
        <h2 class="text-header">{{$article->title}}</h2>
          <h2 class="text-release">{{$article->created_at}}</h2>
        </div>
      </div>
    </div>
      <div class="row">
      <div class="col-md-12">
              <p class="article-text">{{$article->content}}</p>
      </div>
      </div>
    <div class="row">
      <div class="col-md-4">
        <img src="{{ asset($article->brand_img) }}" class="img-responsive brand_img" alt="img-article" />
      </div>
      <div class="col-md-8">
        <h3>Marque : {{$article->brand}}</h3>
        <h3>Modèle : {{$article->model}}</h3>
        <h3>Coloris : {{$article->color}}</h3>
        <h3>Prix : {{$article->price}}</h3>
      </div>

    </div>
              <hr>

          <a href="{{ route('articles.index') }}" class="btn btn-danger"> Back </a>
  </div>
@endsection
