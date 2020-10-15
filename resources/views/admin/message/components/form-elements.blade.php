<div class="form-group row align-items-center" :class="{'has-danger': errors.has('messages'), 'has-success': fields.messages && fields.messages.valid }">
    <label for="messages" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.message.columns.messages') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.messages" v-validate="'required'" id="messages" name="messages"></textarea>
        </div>
        <div v-if="errors.has('messages')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('messages') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('travel_id'), 'has-success': fields.travel_id && fields.travel_id.valid }">
    <label for="travel_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.message.columns.travel_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.travel_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('travel_id'), 'form-control-success': fields.travel_id && fields.travel_id.valid}" id="travel_id" name="travel_id" placeholder="{{ trans('admin.message.columns.travel_id') }}">
        <div v-if="errors.has('travel_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('travel_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('sender_id'), 'has-success': fields.sender_id && fields.sender_id.valid }">
    <label for="sender_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.message.columns.sender_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.sender_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('sender_id'), 'form-control-success': fields.sender_id && fields.sender_id.valid}" id="sender_id" name="sender_id" placeholder="{{ trans('admin.message.columns.sender_id') }}">
        <div v-if="errors.has('sender_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sender_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('recipient_id'), 'has-success': fields.recipient_id && fields.recipient_id.valid }">
    <label for="recipient_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.message.columns.recipient_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.recipient_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('recipient_id'), 'form-control-success': fields.recipient_id && fields.recipient_id.valid}" id="recipient_id" name="recipient_id" placeholder="{{ trans('admin.message.columns.recipient_id') }}">
        <div v-if="errors.has('recipient_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('recipient_id') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_read'), 'has-success': fields.is_read && fields.is_read.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_read" type="checkbox" v-model="form.is_read" v-validate="''" data-vv-name="is_read"  name="is_read_fake_element">
        <label class="form-check-label" for="is_read">
            {{ trans('admin.message.columns.is_read') }}
        </label>
        <input type="hidden" name="is_read" :value="form.is_read">
        <div v-if="errors.has('is_read')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_read') }}</div>
    </div>
</div>


