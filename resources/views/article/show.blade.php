@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                <div class="album py-5">
                    <div class="card-header">
                        <h1>{{$article->name}}</h1>
                    </div>
                    <div class="card-body">
                        <div>
                            {!! $article->description!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('include.footer')
@endsection
