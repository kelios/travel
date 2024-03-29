@extends('layouts.app')
<link rel="stylesheet" defer type="text/css" href="{{ mix('css/showmetravel.min.css') }}">

@section('content')
    <div class="container pd-t60">
        <nav class="navbar navbar-expand-lg navbar-light" id="sideNav">
            <div class="collapse navbar-collapse p-t-1" id="navbarSupportedContent">
                <travel-show-menu :travel_menu='@json($travelMenu)'></travel-show-menu>
            </div>
            <a class="navbar-brand js-scroll-trigger" href="#page-top"
            >            <span class="d-none d-lg-block">
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                     src="{{$travel->travel_image_thumb_small_url}}"
                     alt="{{$travel->name}}"
                     lazy="loading"
                     width="200"
                     height="200"
                />
                </span></a>
            @if (auth()->user())
                <div clas="panel panel-default">
                    <div class="panel-body">

                        <like-component :travel_id='@json($travel->id)'
                                        :total_likes='@json($travel->totalLikes)'>

                        </like-component>
                        <div class="row">
                            <favorite-component :travel_id='@json($travel->id)'></favorite-component>
                            @if (auth()->user()->id!=$travel->userIds[0])
                                <message-component
                                    :travel_id='@json($travel->id)'
                                    :recipient_id='@json(implode(',',$travel->userIds))'
                                    :travel_user_name='@json($travel->userName)'
                                >
                                </message-component>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav textmenu ">
                    <li><i title="{{trans('main.read')}}" class="fa fa-book"></i>({{$travel->countUnicIpView}})
                    </li>
                    @auth
                        <li>
                            @if (in_array(auth()->user()->id,$travel->userIds))
                                <a target="_blank"
                                   href="{{url($travel->url.'/edit')}}">{{trans('main.edit')}}</a>
                            @endif
                        </li>
                    @endauth
                   <!-- <li>
                        <share-network
                            network="vk"
                            :url='@json($travel->url)'
                            :title='@json($travel->name)'
                            :media='@json($travel->travel_image_thumb_url)'
                        >
                            <i class="fa fa-vk"></i>
                        </share-network>

                        <share-network
                            network="facebook"
                            :url='@json($travel->url)'
                            :title='@json($travel->name)'
                            :media='@json($travel->travel_image_thumb_url)'
                        >
                            <i class="fa fa-share fa-facebook fa-x fa-fw"></i>
                        </share-network>
                    </li>
                    -->
                    <li class="nav-item small">
                        <a href="/travels?user_id={{implode(',',$travel->userIds)}}" target="_blank">
                            {{ trans('user.alltravel')}} {{ $travel->userName }} >
                        </a>
                        @if (!$travel->isFriend && !in_array(auth()->user()->id,$travel->userIds))
                            <add-friend :travel='@json($travel)'></add-friend>
                        @endauth
                    </li>
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

                </ul>
            </div>
        </nav>

        <travel-show-list :where='@json($where)' :travel_id='@json($travel->id)'></travel-show-list>

    </div>

@endsection


