@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center occasion_text">Messages</h3>
        </div>
    </div>
    <div class="row">
        <a href="/messages/create" class="btn btn-default center-block link_add"><span class="glyphicon glyphicon-plus"></span> Nouveau message</a>
    </div>
    @include('messenger.partials.flash')

    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
    </div>
@stop
