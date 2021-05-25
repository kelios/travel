@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <travel-form
                :action="'{{ url('travels') }}'"
                v-cloak
                inline-template>

                <form id="travelForm" class="form-horizontal form-create" method="post" @submit.prevent="onSubmit"
                      :action="action" novalidate>
                    <div class="card-header">
                        {{ trans('travels.addTravels') }}
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary"  @click="handleSave" :disabled="submitingForm">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                <span v-if="submitingForm">{{trans('travels.autosave')}} </span>
                                <span v-else>{{ trans('main.save') }}   </span>
                            </button>
                        </div>

                    </div>
                    <div class="card-body blue">
                        @include('travels.components.form-elements')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"  @click="handleSave" :disabled="submitingForm">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            <span v-if="submitingForm">{{trans('travels.autosave')}} </span>
                            <span v-else>{{ trans('main.save') }}   </span>
                        </button>

                    </div>

                </form>
            </travel-form>
        </div>

    </div>
@endsection

@section('footer')
    @include('include.footer')
@endsection
