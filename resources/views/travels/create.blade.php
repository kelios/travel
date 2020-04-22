@extends('layouts.app')
@section('content')
    <div class="container-xl">

        <div class="card">
            <travel-form
                :action="'{{ url('travels') }}'"
                v-cloak
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit"
                      :action="action" novalidate>
                    <div class="card-header"><i class="fa fa-plus"></i> {{ trans('travels.addTravels') }}</div>

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


