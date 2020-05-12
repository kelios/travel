@extends('layouts.app')
@section('content')
    <div id="app">
        <travel-index :travels='@json($travels)'></travel-index>
    </div>
@endsection
