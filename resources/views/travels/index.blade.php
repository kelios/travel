@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">

            <div class="album py-5 ">
                <search-me-travel :where='@json($where)'></search-me-travel>
                <search-extended-travel :where='@json($where)'></search-extended-travel>
                <travel-list :readonly="true" :filter='@json($where)'
                             :isFavorite='@json($isFavorite ?? '')'></travel-list>
            </div>
            <section class="text-center">
                <map-me-travel :data="false" :where='@json($where)'></map-me-travel>
            </section>
        </div>
@endsection
@section('footer')
    @include('include.footer')
@endsection
