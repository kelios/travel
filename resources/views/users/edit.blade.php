@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="card">
            <user-form
                :action="'{{ $user->public_url }}'"
                :data="{{ $user->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('user.editUser', ['name' => $user->name]) }}
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary" :disabled="submiting">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                {{ trans('main.save') }}
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('users.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('main.save') }}
                        </button>
                    </div>

                </form>

            </user-form>
        </div>
    </div>
@endsection
