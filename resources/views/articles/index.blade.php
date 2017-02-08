@extends('layouts.app')
@include('messages.success')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <table class="table table-hover">
            <thead>
              <tr>
                <td> Titre </td>
                <td> Content </td>
                <td> Auteur </td>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
              <tr>
                <td> {{$article->title}} </td>
                <td> {{$article->content}} </td>
                <td> {{$article->user->name}} </td>
                <td>
                  <form action='{{ route('articles.show', ['id' => $article->id]) }}' method="get">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    {{-- @if (isAdmin::isadmin() == 1)   --}}
                      <button type="submit" class="btn btn-warning"> Show </button>
                    {{-- @endif --}}
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $articles->links() }}
        </div>
        <form action='create' method="get">
          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
          {{-- @if (isAdmin::isadmin() == 1)   --}}
            <button type="submit" class="btn btn-success"> Create </button>
          {{-- @endif --}}
        </form>
    </div>
</div>
@endsection
