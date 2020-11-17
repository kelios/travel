@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">
            <div class="album py-5">
                <div class="card-header">
                    <h1>{{trans('main.newandaction')}}</h1>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $articles->links() }}
                    </div>
                    <div class="row">
                        @foreach ($articles as $article)
                            <div class="col-md-6 col-sm-6">
                                <div class="card col-11 shadow-sm">
                                    <img
                                        src="{{$article->article_image_thumb_url}}"
                                        class="img-fluid" alt="{{$article->name}}">
                                    <div class="card-body">
                                        <h2>
                                            {{$article->name}}
                                        </h2>
                                        <div>
                                                {!! str_limit($article->description, $limit = 255, $end = '...')!!}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="text-orange">
                                                <span>{{$article->articleType->name}}</span>
                                            </p>
                                            <p>
                                                <a href="/articles/{{$article->id}}" target="_blank">
                                                    {{trans('main.readMore')}}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center">
                        {{ $articles->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('include.footer')
@endsection
