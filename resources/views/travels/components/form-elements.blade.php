<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}"
               id="name" name="name" placeholder="{{ trans('travels.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('categories'), 'has-success': fields.categories && fields.categories.valid }">
    <label for="categories" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.categories') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            :options="{{$categories->toJson()}}"
            :multiple="true"
            v-model="form.categories"
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('travels.Select categories') }}"
            placeholder="{{ trans('travels.Select categories') }}">
        </multiselect>

        <div v-if="errors.has('categories')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('categories') }}
        </div>
    </div>
</div>


<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('transports'), 'has-success': fields.transports && fields.transports.valid }">
    <label for="transports" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.transports') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            :options="{{$transports->toJson()}}"
            :multiple="true"
            v-model="form.transports"
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('travels.Select transports') }}"
            placeholder="{{ trans('travels.Select transports') }}">
        </multiselect>

        <div v-if="errors.has('transports')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('transports') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('month'), 'has-success': fields.month && fields.month.valid }">
    <label for="month" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.month') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            :options="{{$month->toJson()}}"
            :multiple="true"
            v-model="form.month"
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('travels.Select month') }}"
            placeholder="{{ trans('travels.Select month') }}">
        </multiselect>

        <div v-if="errors.has('month')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('month') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('complexity'), 'has-success': fields.complexity && fields.complexity.valid }">
    <label for="complexity" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.complexity') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            :options="{{$complexity->toJson()}}"
            :multiple="true"
            v-model="form.complexity"
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('travels.complexity') }}"
            placeholder="{{ trans('travels.Select complexity') }}">
        </multiselect>

        <div v-if="errors.has('complexity')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('complexity') }}
        </div>
    </div>
</div>


<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('overNightStay'), 'has-success': fields.overNightStay && fields.overNightStay.valid }">
    <label for="overNightStay" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.overNightStay') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            :options="{{$overNightStay->toJson()}}"
            :multiple="true"
            v-model="form.overNightStay"
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('travels.overNightStay') }}"
            placeholder="{{ trans('travels.Select overNightStay') }}">
        </multiselect>

        <div v-if="errors.has('overNightStay')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('overNightStay') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('countries'), 'has-success': fields.countries && fields.countries.valid }">
    <label for="countries" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.countries') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            @input="getCitiesSelected"
            @remove="toggleUnSelectMarketCounty"
            :options="form.optionsCountries"
            :multiple="true"
            v-model="form.countries"
            track-by="id"
            label="local_name"
            tag-placeholder="{{ trans('travels.countries') }}"
            placeholder="{{ trans('travels.Select countries') }}">
        </multiselect>

        <div v-if="errors.has('countries')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('countries') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('cities'), 'has-success': fields.cities && fields.cities.valid }">
    <label for="cities" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.cities') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
            @input="setMarker"
            :options="form.optionsCities"
            :multiple="true"
            v-model='form.cities'
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('travels.cities') }}"
            placeholder="{{ trans('travels.Select cities') }}">
        </multiselect>

        <div v-if="errors.has('cities')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('cities') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('address'), 'has-success': fields.address && fields.address.valid }">
    <label for="cities" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.selectedAddress') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <ul id="example-1">
            <li v-for="place in form.selectedAddress">
                <ul>
                    <li>@{{ place }}</li>
                </ul>
            </li>
        </ul>
    </div>
</div>


<div class="form-check row">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <template>
            <yandex-map
                :coords="form.mapCoords"
                :zoom="10"
                @click="onClick"
                style="width: 600px; height: 600px;"
                :settings="mapSettings"
                ref="map"

            >
                <ymap-marker
                    v-for="(coord,index) in form.coords"
                    :key="index"
                    :coords="coord.map(i => Number(i))"
                    marker-id="123"
                    hint-content="some hint"
                />
            </yandex-map>
        </template>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('budget'), 'has-success': fields.budget && fields.budget.valid }">
    <label for="budget" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.budget') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.budget" v-validate="'integer'" @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('budget'), 'form-control-success': fields.budget && fields.budget.valid}"
               id="budget" name="budget" placeholder="{{ trans('travels.budget') }}">
        <div v-if="errors.has('budget')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('budget') }}
        </div>
    </div>
</div>

<div class="form-check row"
     :class="{'has-danger': errors.has('visa'), 'has-success': fields.visa && fields.visa.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="visa" type="checkbox" v-model="form.visa" v-validate="''"
               data-vv-name="visa" name="visa_fake_element">
        <label class="form-check-label" for="visa">
            {{ trans('travels.visa') }}
        </label>
        <input type="hidden" name="visa" :value="form.visa">
        <div v-if="errors.has('visa')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('visa') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('number_peoples'), 'has-success': fields.number_peoples && fields.number_peoples.valid }">
    <label for="number_peoples" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.number_peoples') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number_peoples" v-validate="'integer'" @input="validate($event)"
               class="form-control"
               :class="{'form-control-danger': errors.has('number_peoples'), 'form-control-success': fields.number_peoples && fields.number_peoples.valid}"
               id="number_peoples" name="number_peoples"
               placeholder="{{ trans('travels.number_peoples') }}">
        <div v-if="errors.has('number_peoples')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('number_peoples') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('year'), 'has-success': fields.year && fields.year.valid }">
    <label for="year" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.year') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.year" v-validate="'integer'" @input="validate($event)"
               class="form-control"
               :class="{'form-control-danger': errors.has('year'), 'form-control-success': fields.year && fields.year.valid}"
               id="year" name="year"
               placeholder="{{ trans('travels.year') }}">
        <div v-if="errors.has('year')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('year') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('number_days'), 'has-success': fields.number_days && fields.number_days.valid }">
    <label for="number_days" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.number_days') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number_days" v-validate="'integer'" @input="validate($event)"
               class="form-control"
               :class="{'form-control-danger': errors.has('number_days'), 'form-control-success': fields.number_days && fields.number_days.valid}"
               id="number_days" name="number_days" placeholder="{{ trans('travels.number_days') }}">
        <div v-if="errors.has('number_days')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('number_days') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.description') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="''" id="description" name="description"
                     :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('description') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('minus'), 'has-success': fields.minus && fields.minus.valid }">
    <label for="minus" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.minus') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.minus" v-validate="''" id="minus" name="minus"
                     :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('minus')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('minus') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('plus'), 'has-success': fields.plus && fields.plus.valid }">
    <label for="plus" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.plus') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.plus" v-validate="''" id="plus" name="plus"
                     :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('plus')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('plus') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('recommendation'), 'has-success': fields.recommendation && fields.recommendation.valid }">
    <label for="recommendation" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('travels.recommendation') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.recommendation" v-validate="''" id="recommendation" name="recommendation"
                     :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('recommendation')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('recommendation') }}
        </div>
    </div>
</div>

<div class="form-check row"
     :class="{'has-danger': errors.has('publish'), 'has-success': fields.publish && fields.publish.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="publish" type="checkbox" v-model="form.publish" v-validate="''"
               data-vv-name="publish" name="publish_fake_element">
        <label class="form-check-label" for="publish">
            {{ trans('travels.publish') }}
        </label>
        <input type="hidden" name="publish" :value="form.publish">
        <div v-if="errors.has('publish')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('publish')
            }}
        </div>
    </div>
</div>


