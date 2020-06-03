@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">

            <div class="album py-5">
                <search-me-travel :where='@json($where)'></search-me-travel>
                <travel-list :readonly="false" :where='@json($where)'></travel-list>
            </div>
            <section class="text-center">
                <map-me-travel :data="false" :where='@json($where)'></map-me-travel>
            </section>
        </div>
@endsection
