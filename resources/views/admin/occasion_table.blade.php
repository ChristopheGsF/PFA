@extends('admin.index')
@section('table')
  {{-- Article Table --}}
  <div class="panel panel-default articles">
    <div class="panel-heading">Articles</div>
    <div class="panel-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <td> Auteur </td>
          <td> Content </td>
          <td> isGood </td>
        </tr>
      </thead>
      <tbody>
        @foreach ($articles as $article)
          <tr>
            <td> {{$article->user->name}} </td>
            <td> {{$article->content}} </td>
            <td>
              @if ($article->isGood)
                <form action='{{ route('admin.edit_article', ['id' => $article->id]) }}' method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <button type="submit" class="btn btn-warning"> Validate </button>
                </form>
              @else
                <form action='{{ route('admin.edit_article', ['id' => $article->id]) }}' method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <button type="submit" class="btn btn-danger"> Unvalidate </button>
                </form>
              @endif
            </td>
            <td>
              <form action='{{ route('articleuser.show', ['id' => $article->id]) }}' method="get">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-principal"> Show </button>
              </form>
            </td>
            <td>
              <form action='{{ route('articleuser.edit', ['id' => $article->id]) }}' method="get">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-success"> Edit </button>
              </form>
            </td>
            <td>
              <form action='{{ route('articleuser.delete', ['id' => $article->id]) }}' method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-danger"> Delete </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $articles->links() }}
  </div>
  </div>
@endsection
