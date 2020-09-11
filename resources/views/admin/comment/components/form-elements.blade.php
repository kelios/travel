<div class="form-group row align-items-center" :class="{'has-danger': errors.has('comment'), 'has-success': fields.comment && fields.comment.valid }">
    <label for="comment" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.comment.columns.comment') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.comment" v-validate="'required'" id="comment" name="comment"></textarea>
        </div>
        <div v-if="errors.has('comment')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('comment') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('travel_id'), 'has-success': fields.travel_id && fields.travel_id.valid }">
    <label for="travel_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.comment.columns.travel_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.travel_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('travel_id'), 'form-control-success': fields.travel_id && fields.travel_id.valid}" id="travel_id" name="travel_id" placeholder="{{ trans('admin.comment.columns.travel_id') }}">
        <div v-if="errors.has('travel_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('travel_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('users_id'), 'has-success': fields.users_id && fields.users_id.valid }">
    <label for="users_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.comment.columns.users_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.users_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('users_id'), 'form-control-success': fields.users_id && fields.users_id.valid}" id="users_id" name="users_id" placeholder="{{ trans('admin.comment.columns.users_id') }}">
        <div v-if="errors.has('users_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('users_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reply_id'), 'has-success': fields.reply_id && fields.reply_id.valid }">
    <label for="reply_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.comment.columns.reply_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.reply_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('reply_id'), 'form-control-success': fields.reply_id && fields.reply_id.valid}" id="reply_id" name="reply_id" placeholder="{{ trans('admin.comment.columns.reply_id') }}">
        <div v-if="errors.has('reply_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reply_id') }}</div>
    </div>
</div>


