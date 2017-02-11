@extends('admin.index')
@section('table')
  {{-- comment Table --}}
  <div class="panel panel-default comments">
    <div class="panel-heading">Comments</div>
    <div class="panel-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <td> In article </td>
          <td> Content </td>
          <td> By </td>
        </tr>
      </thead>
      <tbody>
        @foreach ($comments as $comment)
          <tr>
            <td> {{$comment->article->title}} </td>
            <td> {{$comment->content}} </td>
            <td> {{$comment->user->name}} </td>
            <td>
              <form action='{{ route('comments.delete', ['id' => $comment->id]) }}' method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-danger"> Delete </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $comments->links() }}
  </div>
  </div>

@endsection
