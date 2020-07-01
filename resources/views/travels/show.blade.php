@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('css/showmetravel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/slider.css') }}">

@section('content')
    <div class="showtravel">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" id="sideNav">
                <div class="collapse navbar-collapse p-t-3" id="navbarSupportedContent">
                    <travel-show-menu :travel='@json($travel)'
                                      :auth_user='@json(Auth::user())'
                    ></travel-show-menu>
                </div>
                <a class="navbar-brand js-scroll-trigger" href="#page-top"
                >            <span class="d-none d-lg-block">
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{$travel->travel_image_thumb_url}}"
                     alt="{{$travel->name}}"/>
                </span></a>
                <like-component :travel='@json($travel)'></like-component>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav textmenu ">
                        @auth
                            <li>
                                @if (in_array(auth()->user()->id,$travel->userIds))
                                    <a target="_blank" href="{{url($travel->url.'/edit')}}">{{trans('main.edit')}}</a>
                                @endif
                            </li>
                        @endauth
                        <li class="nav-item small">
                            {{ $travel->year }}
                            {{ $travel->monthName }}
                        </li>
                        <li class="nav-item small">
                            {{ $travel->countryName }}
                        </li>
                        <li class="nav-item small">
                            {{ $travel->cityName }}
                        </li>
                        <li class="nav-item small">
                            {{ trans('travels.number_days') }} - {{ $travel->number_days }}
                        </li>
                            <li class="nav-item small">
                                {{ trans('main.author') }} - {{ $travel->userName }}
                            </li>
                    </ul>
                </div>
            </nav>

                <travel-show-list :where='@json($where)' :travel='@json($travel)'
                                  :auth_user='@json(Auth::user())'></travel-show-list>
            </div>
        </div>


@endsection


