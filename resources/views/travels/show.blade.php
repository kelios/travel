@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/showmetravel.css') }}">
@section('content')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top-2" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"
        ><span class="d-block d-lg-none">Clarence Taylor</span>
            <span class="d-none d-lg-block">
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{$travel->travel_image_thumb_url}}"
                     alt="{{$travel->name}}"/>
            </span></a
        >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item info">
                    {{ $travel->year }}
                    {{ $travel->monthName }}
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#description">{{ trans('travels.description') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#minus">{{ trans('travels.minus') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#plus">{{ trans('travels.plus') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="#recommendation">{{ trans('travels.recommendation') }}</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="navbar fixed-right bg-white fixed-top-2">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

            <li class="nav-item">
                <a class="nav-link" id="pills-categories-tab"
                   data-toggle="pill" href="#pills-categories" role="tab" aria-controls="pills-home"
                   aria-selected="false">
                    {{ trans('travels.categories') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="pills-countries-tab"
                   data-toggle="pill" href="#pills-countries" role="tab" aria-controls="pills-countries"
                   aria-selected="false">
                    {{ trans('travels.countries') }}</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link" id="pills-cities-tab"
                   data-toggle="pill" href="#pills-cities" role="tab" aria-controls="pills-cities" aria-selected="false">
                    {{ trans('travels.cities') }}</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link" id="pills-complexity-tab"
                   data-toggle="pill" href="#pills-complexity" role="tab" aria-controls="pills-complexity"
                   aria-selected="false">
                    {{ trans('travels.complexity') }}</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link" id="pills-transport-tab"
                   data-toggle="pill" href="#pills-transport" role="tab" aria-controls="pills-transport"
                   aria-selected="false">
                    {{ trans('travels.transports') }}</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link" id="pills-overNightStay-tab"
                   data-toggle="pill" href="#pills-overNightStay" role="tab" aria-controls="pills-overNightStay"
                   aria-selected="true">
                    {{ trans('travels.overNightStay') }}</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link" id="pills-budget-tab"
                   data-toggle="pill" href="#pills-budget" role="tab" aria-controls="pills-budget" aria-selected="false">
                    {{ trans('travels.budget') }}</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link" id="pills-number_peoples-tab"
                   data-toggle="pill" href="#pills-number_peoples" role="tab" aria-controls="pills-number_peoples"
                   aria-selected="false">
                    {{ trans('travels.number_peoples') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="pills-number_peoples-tab"
                   data-toggle="pill" href="#pills-number_peoples" role="tab" aria-controls="pills-number_peoples"
                   aria-selected="false">
                    {{ trans('travels.number_days') }}</a>
            </li>
        </ul>

        <div class="tab-content showTravel" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-categories" role="tabpanel"
                 aria-labelledby="nav-categories-tab">
                {{ $travel->categoryName }}
            </div>
            <div class="tab-pane fade" id="pills-countries" role="tabpanel"
                 aria-labelledby="nav-countries-tab">
                {{ $travel->countryName }}
            </div>
            <div class="tab-pane fade  " id="pills-city" role="tabpanel" aria-labelledby="pills-city-tab">
                {{ $travel->cityName }}
            </div>
            <div class="tab-pane fade" id="pills-complexity" role="tabpanel" aria-labelledby="pills-complexity-tab">
                {{ $travel->complexityName }}
            </div>
            <div class="tab-pane fade" id="pills-transport" role="tabpanel" aria-labelledby="pills-transport-tab">
                {{ $travel->transportName }}
            </div>
            <div class="tab-pane fade" id="pills-overNightStay" role="tabpanel" aria-labelledby="pills-overNightStay-tab">
                {{ $travel->overNightStayName }}
            </div>
            <div class="tab-pane fade" id="pills-budget" role="tabpanel" aria-labelledby="pills-budget-tab">
                {{ $travel->budget }}
            </div>
            <div class="tab-pane fade" id="pills-number_peoples" role="tabpanel" aria-labelledby="pills-number_peoples-tab">
                {{ $travel->number_peoples }}
            </div>
            <div class="tab-pane fade" id="pills-number_days" role="tabpanel" aria-labelledby="pills-number_days-tab">
                {{ $travel->number_days }}
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <section class="treavel-section" id="description">
            <div class="treavel-section-content">
                <h1 class="mb-0">{{$travel->name}}</h1>
                <p class="lead mb-5">
                    {!!$travel->description!!}
                </p>
            </div>
        </section>
        <hr class="m-0"/>

        <section class="treavel-section" id="minus">
            <travel-show-section :data='@json($travel->minus)'
                                 :title='@json(trans('travels.minus'))'></travel-show-section>
        </section>
        <hr class="m-0"/>

        <section class="treavel-section" id="plus">
            <travel-show-section :data='@json($travel->plus)'
                                 :title='@json(trans('travels.plus'))'></travel-show-section>
        </section>
        <hr class="m-0"/>

        <section class="treavel-section" id="recommendation">
            <travel-show-section :data='@json($travel->recommendation)'
                                 :title='@json(trans('travels.recommendation'))'></travel-show-section>
        </section>
        <hr class="m-0"/>

        <section class="treavel-section" id="countries">
            <travel-show-section :data='@json($travel->CountryName)'
                                 :title='@json(trans('travels.countries'))'></travel-show-section>
        </section>
        <hr class="m-0"/>
        <section class="treavel-section" id="cities">
            <travel-show-section :data='@json($travel->CityName)'
                                 :title='@json(trans('travels.cities'))'></travel-show-section>
        </section>
        <hr class="m-0"/>

        <section class="treavel-section" id="categories">
            <travel-show-section :data='@json($travel->categoryName)'
                                 :title='@json(trans('travels.categories'))'></travel-show-section>
        </section>
        <hr class="m-0"/>


    </div>
@endsection


