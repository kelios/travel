@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">
            <section class="text-center">
                <map-me-travel :data="true" :where='@json($where)'></map-me-travel>
            </section>
            <div class="album py-5 ">
                <search-me-travel :where='@json($where)'></search-me-travel>
                <travel-list :readonly="true" :where='@json($where)'></travel-list>
            </div>
        </div>
@endsection
