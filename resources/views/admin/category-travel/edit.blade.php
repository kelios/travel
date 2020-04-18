@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.category-travel.actions.edit', ['name' => $categoryTravel->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <category-travel-form
                :action="'{{ $categoryTravel->resource_url }}'"
                :data="{{ $categoryTravel->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.category-travel.actions.edit', ['name' => $categoryTravel->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.category-travel.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </category-travel-form>

        </div>
    
</div>

@endsection