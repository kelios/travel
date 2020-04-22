@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><i class="fa fa-plus"></i> {{ trans('travels.addTravels') }}</div>

                    <div class="card-body">

                        <travel-form
                            :action="'{{ url('travels') }}'"
                            v-cloak
                            inline-template>

                            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit"
                                  :action="action" novalidate>

                                <div class="form-group">
                                    @include('travels.components.form-elements')
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
            </div>
        </div>
    </div>
@endsection


