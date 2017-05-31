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
        <h3 class="text-center occasion_text">Occasions</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="col-image">
          @if($article->img)
            <img src="{{ asset($article->img) }}" class="img-responsive" alt="img-article" />
          @endif
        <h2 class="text-header">{{$article->brand}} {{$article->model}}</h2>
          <h2 class="text-release">{{$article->price}} €</h2>
        </div>
      </div>
      <div class="col-md-4 details_occasion">
        <img src="{{ asset($article->brand_img) }}" class="img-responsive brand_img" alt="img-article" />
        <h4>Marque : {{$article->brand}}</h4>
        <h4>Modèle : {{$article->model}}</h4>
        <h4>Coloris : {{$article->color}}</h4>
        <h4>Taille : {{$article->size}}</h4>
        <h4>Contacts : <a href="{{route('inboxe.newgroup', ["id" => $article->user->id] )}}" class="list-group-item ">{{$article->user->name}}</a></h4>
        <h3>Description</h3>
        <p class="desc_occasion">{{$article->content}}</p>
      </div>
    </div>
    <hr>
  </div>
@endsection
