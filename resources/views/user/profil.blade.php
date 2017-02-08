@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>You are logged as {{Auth::user()->name}} !</p>
                    <p>Your email is  {{Auth::user()->email}}.</p>
                    <p>Session created {{Auth::user()->created_at}} .</p>
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
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
