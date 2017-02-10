@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <img src="{{$user->img}}" alt="img-article">
                    @if (Auth::user()->id)
                    <form action='{{ route('user.edit_img')}}' method="get">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        Select image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" class="btn btn-success" value="Upload Image" name="submit">
                    </form>
                    @endif
                    <p>You are logged as {{$user->name}} !</p>
                    <p>Your email is  {{$user->email}}.</p>
                    <p>Session created {{$user->created_at}} .</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <table class="table table-hover">
            <thead>
              <tr>
                <td> Titre </td>
                <td> Content </td>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
              <tr>
                <td> {{$article->title}} </td>
                <td> {{$article->content}} </td>
                <td>
                    @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                  <form action='{{ route('articles.edit', ['id' => $article->id]) }}' method="get">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                          <button type="submit" class="btn btn-success"> Edit </button>
                  </form>
              @endif
                  </td>
                  <td>
                      @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                <form action='{{ route('articles.delete', ['id' => $article->id]) }}' method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                      <button type="submit" class="btn btn-warning"> Delete </button>
                </form>
            @endif
              </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
