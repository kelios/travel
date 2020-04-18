@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.month.actions.edit', ['name' => $month->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <month-form
                :action="'{{ $month->resource_url }}'"
                :data="{{ $month->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.month.actions.edit', ['name' => $month->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.month.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </month-form>

        </div>
    
</div>

@endsection