@extends('layouts.app')
@section('content')
  @include('messages.success')


<!-- test -->

        <form class="well form-horizontal test" action='store' method="post"  id="contact_form">

            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            @if (Auth::check())
                <input name="user_id" type="hidden" value={{ Auth::user()->id }}/>
            @endif

            <fieldset>

                <form id="contact-form {{ $errors->has('title') ? ' has-error' : '' }}">
                    <p>
                        <label for="your-name">Objet</label>
                        <input type="text" name="title" id="your-name" minlength="3" placeholder="Objet de votre demande" required value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        @endif
                    </p>



                    <p>
                        <label for="your-name {{ $errors->has('name') ? ' has-error' : '' }}">Prénom</label>
                        <input type="text" name="name" id="your-name" minlength="3" placeholder="Votre Prénom" required value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </p>

                    <p>
                        <label for="your-name {{ $errors->has('last_name') ? ' has-error' : '' }}">Nom</label>
                        <input type="text" name="last_name" id="your-name" minlength="3" placeholder="Votre nom" required value="{{ old('last_name') }}">
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </p>

                    <p>
                        <label for="your-number {{ $errors->has('number') ? ' has-error' : '' }}">Numéro de téléphone</label>
                        <input type="text" name="number" id="your-name" minlength="3" placeholder="Votre téléphone" required value="{{ old('number') }}">
                        @if ($errors->has('number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                        @endif
                    </p>

                    <p>
                        <label for="email {{ $errors->has('email') ? ' has-error' : '' }}">Email</label>
                        <input type="email" name="email" id="email" placeholder="Votre email" required value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </p>

                    <p>
                        <label for="your-message {{ $errors->has('content') ? ' has-error' : '' }}">Contenu</label>
                    </p>


                    <p>
                        <textarea name="content" id="your-message" placeholder="Votre demande" class="expanding" required {{ old('content') }}></textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </p>


        <div class="container">
            <div class="row">
                <div class="col-md-6 colg">
                    <button type="submit">
                        <svg version="1.1" class="send-icn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="36px" viewBox="0 0 100 36" enable-background="new 0 0 100 36" xml:space="preserve">
                            <path d="M100,0L100,0 M23.8,7.1L100,0L40.9,36l-4.7-7.5L22,34.8l-4-11L0,30.5L16.4,8.7l5.4,15L23,7L23.8,7.1z M16.8,20.4l-1.5-4.3
                                        l-5.1,6.7L16.8,20.4z M34.4,25.4l-8.1-13.1L25,29.6L34.4,25.4z M35.2,13.2l8.1,13.1L70,9.9L35.2,13.2z" />
                        </svg>
                            <small>Envoyez</small>
                    </button>
                </div>
                </form>

                <div class="col-md-6 cold">
                    <form action='{{route('articles.index')}}' method="get">
                        <button>
                            <img src="{{URL::asset('/images/back.svg')}}"width="100px" height="65px" class="back">
                            <small>Retour</small>
                        </button>
                    </form>
                </div>
            </div>
        </div>
            </fieldset>

@endsection




