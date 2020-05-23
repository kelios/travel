@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <travel-form
                :action="'{{ url('travels') }}'"
                v-cloak
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit"
                      :action="action" novalidate>
                    <div class="card-header"> {{ trans('travels.addTravels') }}</div>
                            @include('travels.components.form-elements')
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


