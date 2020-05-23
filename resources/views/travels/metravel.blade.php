@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">
            <section class="text-center">
                <map-me-travel :travels='@json($travels)'></map-me-travel>
            </section>
            <div class="album py-5 bg-light">
                <search-me-travel></search-me-travel>
                <travel-list :readonly="false"></travel-list>
            </div>
        </div>
@endsection
