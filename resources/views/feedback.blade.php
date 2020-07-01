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
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">

                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2> {{trans('main.aboutTitle')}}</h2>
                    <p class="lead mb-0">
                        @if (config('feedback.enabled'))
                            <feedback-form/>
                        @endif
                    </p>
                </div>
                <div class="col-lg-6 order-lg-2 text-white showcase-img"
                     style="background-image: url('/media/slider/main2.jpg');"></div>
            </div>

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

