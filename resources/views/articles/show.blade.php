@extends('layouts.app')

@section('content')
<div class="container">
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
                <tr>
                  <td> {{$article->title}} </td>
                  <td> {{$article->content}} </td>
                  <td>
                    <td>
                      <form action='edit' method="get">
                        @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                          <button type="submit" class="btn btn-success"> Edit </button>
                       @endif
                      </form>
                      </td>
                      <td>
                    <form action='delete' method="post">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                      @if (Auth::user()->isAdmin == 1 || Auth::user()->id == $article->user_id)
                          <button type="submit" class="btn btn-warning"> Delete </button>
                      @endif
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
            <form action='{{ route('articles.index') }}' method="get">
              <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
              {{-- @if (isAdmin::isadmin() == 1)   --}}
                <button type="submit" class="btn btn-danger"> Back </button>
              {{-- @endif --}}
            </form>
      </div>

    </div>
</div>
@endsection
