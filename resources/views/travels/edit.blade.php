@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="card">
            <travel-form
                :action="'{{ $travel->url }}'"
                :data='@json($travel)'
                v-cloak
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit"
                      :action="action" novalidate>
                    <div class="card-header">
                        {{ trans('travels.editTravels') }}
                        <a href="{{ $travel->url }}" target="_blank"><i class="fa  fa-eye"></i></a>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            @include('travels.components.form-elements')
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('main.save') }}
                        </button>
                    </div>

                </form>
            </travel-form>
        </div>
    </div>
@endsection


