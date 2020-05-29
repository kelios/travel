@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">
            <section class="text-center">
                <map-me-travel :where='@json($where)'></map-me-travel>
            </section>
            <div class="album py-5 bg-light">
                <search-me-travel :where='@json($where)'></search-me-travel>
                <travel-list :readonly="false" :where='@json($where)'></travel-list>
            </div>
        </div>
@endsection
