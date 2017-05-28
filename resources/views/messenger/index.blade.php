@extends('layouts.app')

@section('content')
    <div class="container">
    <li><a href="/messages/create">Create New Message</a></li>
    @include('messenger.partials.flash')

    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
    </div>
@stop
