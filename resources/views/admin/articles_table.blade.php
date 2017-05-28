@extends('admin.index')
@section('table')
  {{-- Article Table --}}
  <div class="panel panel-default articles">
    <div class="panel-heading">Articles</div>
    <div class="panel-body">
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
              <form action='{{ route('articles.edit', ['id' => $article->id]) }}' method="get">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-success"> Edit </button>
              </form>
            </td>
            <td>
              <form action='{{ route('articles.delete', ['id' => $article->id]) }}' method="post">
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
