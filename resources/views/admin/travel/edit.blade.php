@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.travel.actions.edit', ['name' => $travel->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <travel-form
                :action="'{{ $travel->resource_url }}'"
                :data="{{ $travel->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.travel.actions.edit', ['name' => $travel->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.travel.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </travel-form>

        </div>
    
</div>

@endsection