@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ trans('home.allFriends') }}
            </div>

            <div class="card-body blue">
                <friend-list :user='@json(Auth::user())'></friend-list>
            </div>
        </div>
    </div>
@endsection
