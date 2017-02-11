@extends('admin.index')
@section('table')
  {{-- contact Table --}}
  <div class="panel panel-default contacts">
    <div class="panel-heading">Contacts</div>
    <div class="panel-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <td> Titre </td>
          <td> Content </td>
          <td> By </td>
        </tr>
      </thead>
      <tbody>
        @foreach ($contacts as $contact)
          <tr>
            <td> {{$contact->title}} </td>
            <td> {{$contact->content}} </td>
            <td> {{$contact->email}} </td>
            <td>
              <form action='{{ route('admin.show', ['id' => $contact->id]) }}' method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-warning"> Show </button>
              </form>
            </td>
              <td>
              <form action='{{ route('admin.delete_contact', ['id' => $contact->id]) }}' method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button type="submit" class="btn btn-danger"> Delete </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $contacts->links() }}
  </div>
  </div>
@endsection
