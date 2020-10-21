@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ trans('home.allMessages') }}
            </div>

            <div class="card-body blue">

                   <message-list></message-list>

            </div>
        </div>
    </div>
@endsection
