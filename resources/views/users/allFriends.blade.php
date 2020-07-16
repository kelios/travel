@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row py-5">
            <h1>{{ trans('home.allFriends') }}</h1>
        </div>
        <div>
            <friend-list :user='@json(Auth::user())'></friend-list>
        </div>
    </div>
@endsection
