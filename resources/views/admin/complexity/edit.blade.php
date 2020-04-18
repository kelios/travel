@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.complexity.actions.edit', ['name' => $complexity->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <complexity-form
                :action="'{{ $complexity->resource_url }}'"
                :data="{{ $complexity->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.complexity.actions.edit', ['name' => $complexity->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.complexity.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </complexity-form>

        </div>
    
</div>

@endsection