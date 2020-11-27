<div class="form-group row align-items-center" :class="{'has-danger': errors.has('travel_id'), 'has-success': fields.travel_id && fields.travel_id.valid }">
    <label for="travel_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel-like.columns.travel_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.travel_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('travel_id'), 'form-control-success': fields.travel_id && fields.travel_id.valid}" id="travel_id" name="travel_id" placeholder="{{ trans('admin.travel-like.columns.travel_id') }}">
        <div v-if="errors.has('travel_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('travel_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel-like.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.travel-like.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>


