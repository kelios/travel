@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="card">
            <travel-form
                :action="'{{ $travel->url }}'"
                :data='@json($travel)'
                v-cloak
                inline-template>

                <form id="travelForm" class="form-horizontal form-create" method="post" @submit.prevent="onSubmit"
                      :action="action" novalidate>
                    <div class="card-header">
                        {{ trans('travels.editTravels') }}
                        @if($travel->publish)
                                @if($travel->moderation)
                                    <span class="badge badge-success">({{trans('main.moderation')}})</span>
                                @else
                                    <span class="badge badge-dark">({{trans('main.moderationhide')}})</span>
                                @endif
                        @endif
                        <div class="float-right">
                            <a href="{{ $travel->url }}" target="_blank">
                                {{trans('main.preShow')}}
                            </a>

                            <button type="submit" class="btn btn-primary"  @click="handleSave" :disabled="submiting">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                {{ trans('main.save') }}
                            </button>

                        </div>

                    </div>

                    <div class="card-body blue">
                        <div class="form-group">
                            @include('travels.components.form-elements')
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"  @click="handleSave" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('main.save') }}
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
