@extends('layouts.app')
@include('messages.success')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <img src="{{$user->img}}" style="width : 200px; height : auto;" alt="img-article">
                    @if (Auth::check())
                      @if (Auth::user()->id)
                        {!! Form::open(
                            array(
                                'route' => 'user.edit_img',
                                'class' => 'form',
                                'novalidate' => 'novalidate',
                                'files' => true)) !!}
                          <div class="form-group">
                              {!! Form::label('Image') !!}
                              {!! Form::file('image', null) !!}
                          </div>
                          <div class="form-group">
                              {!! Form::submit('Upload Image!') !!}
                          </div>
                        {!! Form::close() !!}
                      @endif
                      <p>You are logged as {{$user->name}} !</p>
                      <p>Your email is  {{$user->email}}.</p>
                      <p>Session created {{$user->created_at}} .</p>
                    @endif
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
                @if (Auth::check())
                    @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                  <form action='{{ route('articles.edit', ['id' => $article->id]) }}' method="get">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                          <button type="submit" class="btn btn-success"> Edit </button>
                  </form>
                  @endif
              @endif
                  </td>
                  <td>
                  @if (Auth::check())
                      @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                <form action='{{ route('articles.delete', ['id' => $article->id]) }}' method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                      <button type="submit" class="btn btn-warning"> Delete </button>
                </form>
                @endif
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
