@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.over-night-stay.actions.create'))

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <over-night-stay-form
            :action="'{{ url('admin/over-night-stays') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.over-night-stay.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.over-night-stay.components.form-elements')
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>
                
            </form>

        </over-night-stay-form>

        </div>

        </div>

    
@endsection