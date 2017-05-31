@extends('layouts.app')
@include('messages.success')

@section('content')
<script>
$(document).ready(function(){
  $("a").on('click', function(event)
              {
                if (this.hash !== "")
                {
                  event.preventDefault();
                  var hash = this.hash;
                  $('html, body').animate(
                  {
                    scrollTop: $(hash).offset().top
                  }, 800, function()
                  {
                    window.location.hash = hash;
                  });
                }
              });
});
</script>
<script>
    $(document).ready(function(){
        $("#btn-edit-profil").click(function(){
            $("#profil_edition").slideToggle(300);
        });
    });

    $(document).ready(function(){
        $("#btn-profil-like").click(function(){
            $("#profil_likes").slideToggle(300);

        });
    });

    $(document).ready(function(){
        $("#btn-profil-annonces").click(function(){
            $("#profil_annonces").slideToggle(300);
        });
    });




</script>

<section class="section-profil">
<div class="container profil">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center occasion_text">Profil</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            @if ($user->img)
                <img src="{{$user->img}}" alt="img-article" class="imgpro">
            @else
                <div class="col-md-6">
                    <p>Cet(te) utilisateur n'a pas d'image de profil pour l'instant</p>
                </div>
            @endif

        </div>
    </div>


    <div class="row">
        <div class="col-md-12 informations">
            <h2>{{$user->name}}</h2>
            <p> {{$user->email}}</p>
            <p><strong>Membre depuis le</strong> <br> {{$user->created_at}}</p>
        </div>


    </div>
    <div class="row row_button_edit">
        <a id="btn-edit-profil" class="btn btn-default center-block link_add"><span class="glyphicon glyphicon-pencil"></span> Edition profil</a>
    </div>
    <div id="profil_edition">

      <form class="well form-horizontal" action="{{ route('user.update') }}" method="post" enctype="multipart/form-data" novalidate="novalidate" accept-charset="UTF-8" id="contact_form">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <fieldset>

          <!-- Form Name -->
          <legend>Edit profil:</legend>

          <!-- Text input-->

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Name</label>
            <div class="col-md-4 inputGroupContainer">
              <input  name="name" placeholder="Name" class="form-control" value="{{$user->name}}"  type="text">
              @if ($errors->has('name'))
                <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
            </div>
          </div>

          <!-- Text input-->

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4 inputGroupContainer">
              <input  name="email" placeholder="Email" class="form-control" value="{{ $user->email }}"  type="text">
              @if ($errors->has('email'))
                <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <!-- Image -->

          <div class="form-group">
            <label class="col-md-4 control-label">Image</label>
            <div class="col-md-4 inputGroupContainer">
              <input name="image" type="file">
            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning" > Send </button>
            </div>
          </div>
        </fieldset>
      </form>

    </div>
</div>
</section>

  <section class="section-liked">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center occasion_text white">LIKES</h3>
      </div>
      <a class="plus_link" id="btn-profil-like"><button id="plus" class="btn-plus center-block"><span class="plus glyphicon glyphicon-plus"></span></button>
      </a>
    </div>
    <div id="profil_likes">
      <div class="container">
        <div class="row">
          @foreach ($likes as $like)
            @foreach ($posts as $post)
              @if( $like->article_id == $post->id)
                <div class="col-md-4">
                  <a href="{{ route('articles.show', ['id' => $post->id]) }}"><img src="{{$post->img}}" class="img-responsive" alt="img-article"></a>
                  <h2 class="article-liked text-center">{{$post->title}}</h2>
                  <p class="text-center" style="color: #fff;"> <span class="glyphicon glyphicon-time"></span> {{$post->release}}</p>

                </div>
              @endif
            @endforeach
          @endforeach
        </div>
      </div>
    </div>
  </section>

<section class="section-annonces">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center occasion_text white">Mes Annonces</h3>
        </div>
          <a class="plus_link" id="btn-profil-annonces"><button  class="btn-plus center-block"><span class="plus glyphicon glyphicon-plus"></span></button>
          </a>
    </div>
    <div id="profil_annonces">
        <div class="container">
            <div class="row hidden-xs hidden-sm">
                <div class="col-md-3">
                    <h3>Image</h3>
                </div>
                <div class="col-md-2">
                    <h3>Détails</h3>
                </div>
                <div class="col-md-5">
                    <h3>Description</h3>
                </div>
                <div class="col-md-2">
                    <h3>Actions</h3>
                </div>
            </div>
            <hr class="hr-dark">
            @foreach ($articles as $article)
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('articleuser.index') }}/{{$article->id}}/show"><img src="{{$article->img}}" class="img-responsive img-thumbnail center-block" alt="img-article"></a>
            </div>
            <div class="col-md-2">

                <a href="{{ route('articleuser.index') }}/{{$article->id}}/show"><h3>{{$article->brand}}</h3></a>
              <a class="link_annonce" href="{{ route('articles.index') }}/{{$article->id}}/show"><h3>{{$article->brand}}</h3></a>

                <h5><strong>Modèle :</strong> {{$article->model}}</h5>
                <h5><strong>Prix :</strong> {{$article->price}}</h5>
                <h5><strong>Taille :</strong> {{$article->size}}</h5>
            </div>
            <div class="col-md-6">
                <p>{{$article->content}}</p>
            </div>
            <div class="col-md-1">
                @if (Auth::check())
                    @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                        <form action='{{ route('articleuser.edit', ['id' => $article->id]) }}' method="get">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <button type="submit" class="btn btn_edit"><span class="plus glyphicon glyphicon-pencil"></span></button>
                        </form>
                    @endif
                @endif

                    @if (Auth::check())
                        @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                            <form action='{{ route('articleuser.delete', ['id' => $article->id]) }}' method="post">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <button type="submit" class="btn btn_delete"><span class="plus glyphicon glyphicon-trash"></span></button>
                            </form>
                        @endif
                    @endif

            </div>


        </div>
                <hr class="hr-dark">
            @endforeach
        </div>
    </div>
</section>
@endsection
