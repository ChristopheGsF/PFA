@extends('layouts.app')
@include('messages.success')
@section('content')
<script>

    var popupSize = {
        width: 780,
        height: 550
    };

    $(document).on('click', '.social-buttons > a', function(e){

        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horisontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }

    });
</script>
    <div class="container">

        <div class="row">
         <div class="col-md-2">
          <div class="list-group select-menu rotate">
              <a href="{{ route('articleuser.create')}}" class="list-group-item"> Create </a>
            </div>
          </div>
             @foreach ($articles as $article)
               @if ($article->isGood)
            <div class="col-md-4">
                <div class="img-article">
                    @if ($article->img)
                    <a href="{{ route('articleuser.show', ['id' => $article->id]) }}"><img src="{{$article->img}}" class="img-responsive" alt="img-article"></a>
                    @endif
                    </div>
                    <div class="social-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse"
                           target="_blank">
                            <i class="fa fa-facebook-official" style="font-size : 30px;"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url="
                           target="_blank">
                            <i class="fa fa-twitter-square" style="font-size : 30px;"></i>
                        </a>
                        <a href="https://plus.google.com/share?url="
                           target="_blank">
                            <i class="fa fa-google-plus-square" style="font-size : 30px;"></i>
                        </a>
                    </div>
                </div>
                    <a href="{{ route('articles.show', ['id' => $article->id]) }}">
                        <h2 class="article-title text-center">
                            {{$article->title}}
                        </h2>
                    </a>
                    <hr>
            </div>
          @endif
                @endforeach
                {{ $articles->links() }}


        </div>
    </div>
@endsection
