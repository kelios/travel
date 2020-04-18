<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.travel.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('budget'), 'has-success': fields.budget && fields.budget.valid }">
    <label for="budget" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.budget') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.budget" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('budget'), 'form-control-success': fields.budget && fields.budget.valid}" id="budget" name="budget" placeholder="{{ trans('admin.travel.columns.budget') }}">
        <div v-if="errors.has('budget')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('budget') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('number_peoples'), 'has-success': fields.number_peoples && fields.number_peoples.valid }">
    <label for="number_peoples" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.number_peoples') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number_peoples" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('number_peoples'), 'form-control-success': fields.number_peoples && fields.number_peoples.valid}" id="number_peoples" name="number_peoples" placeholder="{{ trans('admin.travel.columns.number_peoples') }}">
        <div v-if="errors.has('number_peoples')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('number_peoples') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('number_days'), 'has-success': fields.number_days && fields.number_days.valid }">
    <label for="number_days" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.number_days') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number_days" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('number_days'), 'form-control-success': fields.number_days && fields.number_days.valid}" id="number_days" name="number_days" placeholder="{{ trans('admin.travel.columns.number_days') }}">
        <div v-if="errors.has('number_days')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('number_days') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('minus'), 'has-success': fields.minus && fields.minus.valid }">
    <label for="minus" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.minus') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.minus" v-validate="'required'" id="minus" name="minus" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('minus')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('minus') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('plus'), 'has-success': fields.plus && fields.plus.valid }">
    <label for="plus" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.plus') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.plus" v-validate="'required'" id="plus" name="plus" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('plus')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('plus') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('recommendation'), 'has-success': fields.recommendation && fields.recommendation.valid }">
    <label for="recommendation" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.recommendation') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.recommendation" v-validate="'required'" id="recommendation" name="recommendation" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('recommendation')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('recommendation') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.travel.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="'required'" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('publish'), 'has-success': fields.publish && fields.publish.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="publish" type="checkbox" v-model="form.publish" v-validate="''" data-vv-name="publish"  name="publish_fake_element">
        <label class="form-check-label" for="publish">
            {{ trans('admin.travel.columns.publish') }}
        </label>
        <input type="hidden" name="publish" :value="form.publish">
        <div v-if="errors.has('publish')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('publish') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('visa'), 'has-success': fields.visa && fields.visa.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="visa" type="checkbox" v-model="form.visa" v-validate="''" data-vv-name="visa"  name="visa_fake_element">
        <label class="form-check-label" for="visa">
            {{ trans('admin.travel.columns.visa') }}
        </label>
        <input type="hidden" name="visa" :value="form.visa">
        <div v-if="errors.has('visa')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('visa') }}</div>
    </div>
</div>


