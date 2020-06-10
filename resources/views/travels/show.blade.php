@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/showmetravel.css') }}">
@section('content')
    <div class="showtravel">
        <nav class="navbar navbar-expand-lg navbar-dark" id="sideNav">
            <ul class="list-group list-group-flush textmenu">
                <li>
                    {{$travel->name }}
                </li>
                <li class="small">
                    {{ $travel->year }}
                    {{ $travel->monthName }}
                </li>
                <li class="small">
                    {{ $travel->countryName }}
                </li>
                <li class="small">
                    {{ $travel->cityName }}
                </li>
                <li class="small">
                    {{ trans('travels.number_days') }} - {{ $travel->number_days }}
                </li>
            </ul>
            <a class="navbar-brand js-scroll-trigger" href="#page-top"
            >            <span class="d-none d-lg-block">
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{$travel->travel_image_thumb_url}}"
                     alt="{{$travel->name}}"/>
            </span></a
            >
            @auth
                @if (in_array(auth()->user()->id,$travel->userIds))
                    <a target="_blank" href="{{url($travel->url.'/edit')}}">{{trans('main.edit')}}</a>
                @endif
            @endauth
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <travel-show-menu :travel='@json($travel)'
                ></travel-show-menu>
            </div>
        </nav>
        <travel-show-filter :travel='@json($travel)'></travel-show-filter>
        <travel-show-list :where='@json($where)' :travel='@json($travel)'></travel-show-list>

    </div>
@endsection


