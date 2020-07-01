@extends('layouts.app')

@section('content')
    <section class="call-to-action text-white text-center">
        <div class="overlay"></div>
        <div class="home-quote">
            <blockquote class="text-center">{{trans('main.blockquote')}}
                <cite>{{trans('main.cite')}}</cite>
            </blockquote>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials text-center ">
        <div class="container">
            <h2 class="mb-5">{{trans('main.titleMainHistory')}}</h2>
            <travel-last></travel-last>
        </div>
    </section>

    <section class="text-center">
        <map-me-travel :where='@json($where ?? '')' :data="true"></map-me-travel>
    </section>
@endsection

@section('footer')
    @include('include.footer')
@endsection


