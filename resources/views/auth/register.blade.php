@extends('layouts.app')
@section('content')


    <form class="well form-horizontal test" action="{{ route('register') }}" method="POST"  id="contact_form">
        {{ csrf_field() }}


        <fieldset>
            <form id="contact-form">

                <p>
                    <label for="your-name {{ $errors->has('name') ? ' has-error' : '' }}">Name</label>
                        <input type="text" name="name" id="your-name" minlength="3" placeholder="Votre Prénom" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                       <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                </p>


                <p>
                    <label for="email {{ $errors->has('email') ? ' has-error' : '' }}">Email</label>
                        <input type="email" name="email" id="email" placeholder="Votre email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                </p>

                <p>
                    <label for="email {{ $errors->has('password') ? ' has-error' : '' }}">Password</label>
                        <input type="password" name="password" id="password" placeholder="Votre Password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                </p>

                <p>
                    <label for="password-confirm">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="email" placeholder="Votre email" required>
                </p>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6 colg">
                            <button type="submit">
                                <svg version="1.1" class="send-icn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="36px" viewBox="0 0 100 36" enable-background="new 0 0 100 36" xml:space="preserve">
                            <path d="M100,0L100,0 M23.8,7.1L100,0L40.9,36l-4.7-7.5L22,34.8l-4-11L0,30.5L16.4,8.7l5.4,15L23,7L23.8,7.1z M16.8,20.4l-1.5-4.3
                                        l-5.1,6.7L16.8,20.4z M34.4,25.4l-8.1-13.1L25,29.6L34.4,25.4z M35.2,13.2l8.1,13.1L70,9.9L35.2,13.2z" />
                                </svg>
                                <small>Envoyer</small>
                            </button>
                        </div>
                            </form>

                        <div class="col-md-6 cold">
                            <form action='{{route('articles.index')}}' method="get">
                                <button>
                                    <img src="{{URL::asset('/images/back.png')}}"width="100px" height="65px" class="back">
                                    <small>Retour</small>
                                </button>
                            </form>
                        </div>
                     </div>
                 </div>
        </fieldset>
    </form>

@endsection
