@extends('admin.index')
@section('table')
  {{-- Users Table --}}
  <div class="panel panel-default users">
    <div class="panel-heading">Users</div>
    <div class="panel-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <td> Name </td>
          <td> Email </td>
          <td> Grade </td>
          <td> Created </td>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td> {{$user->name}} </td>
            <td> {{$user->email}} </td>
            <td>
              @if (!$user->isAdmin)
                <form action='{{ route('admin.edit', ['id' => $user->id]) }}' method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <button type="submit" class="btn btn-warning"> Up to Admin </button>
                </form>
              @else
                <form action='{{ route('admin.edit', ['id' => $user->id]) }}' method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                  <button type="submit" class="btn btn-danger"> Downgrade </button>
                </form>
              @endif
            </td>
            <td> {{$user->created_at}} </td>
            <td>
              <form action='{{ route('admin.delete', ['id' => $user->id]) }}' method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-danger"> Delete </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
  </div>

@endsection
