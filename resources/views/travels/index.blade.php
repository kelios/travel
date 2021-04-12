@extends('layouts.app')
@section('content')
    <div id="app">

        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card-header">
                        @if ($isBy)
                            <h1>{{trans('main.listbytravel')}}</h1>
                        @else
                            <h1>{{trans('main.listalltravel')}}</h1>
                        @endif
                    </div>
                    <div class="album py-5 ">
                        <search-extended-travel :filter_hide='@json($filter_hide)'
                                                :where='@json($where)'></search-extended-travel>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="album py-5 ">
                        <search-me-travel :where='@json($where)'></search-me-travel>

                        <travel-list :readonly="true" :filter='@json($where)'
                                     :isFavorite='@json($isFavorite ?? '')'></travel-list>
                    </div>

                </div>
            </div>

            <section class="text-center">
                <map-me-travel :data="false" :where='@json($where)'></map-me-travel>
            </section>

        </div>
@endsection
@section('footer')
    @include('include.footer')
@endsection
