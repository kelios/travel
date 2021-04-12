@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.category-travel-address.actions.edit', ['name' => $categoryTravelAddress->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <category-travel-address-form
                :action="'{{ $categoryTravelAddress->resource_url }}'"
                :data="{{ $categoryTravelAddress->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.category-travel-address.actions.edit', ['name' => $categoryTravelAddress->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.category-travel-address.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </category-travel-address-form>

        </div>
    
</div>

@endsection