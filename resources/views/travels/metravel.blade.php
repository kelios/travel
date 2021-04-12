@extends('layouts.app')
@section('content')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card-header titleindex">
                        <h1>{{trans('main.listmytravel')}}</h1>
                    </div>
                    <div class="album py-5 ">
                        <search-extended-travel :filter_hide='@json($filter_hide)'
                                                :where='@json($where)'></search-extended-travel>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="album py-5 ">
                        <search-me-travel :where='@json($where)'></search-me-travel>
                        <travel-list :readonly="false" :filter='@json($where)'></travel-list>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('include.footer')
@endsection
