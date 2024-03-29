<div class="row">

    <div class="col-md-8 order-md-1">

        <div class="card ">

            <div class="card-body">
                <div class="form-group "
                     :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
                    <label for="name">{{ trans('travels.name') }}</label>

                    <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)"
                           class="form-control"
                           :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}"
                           id="name" name="name" placeholder="{{ trans('travels.name') }}">
                    <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('name')
                        }}
                    </div>

                </div>

                <div class="form-group "
                     :class="{'has-danger': errors.has('countries'), 'has-success': fields.countries && fields.countries.valid }">
                    <label for="countries">{{ trans('travels.countries') }}</label>


                    <multiselect
                        @input="getCitiesSelected"
                        @remove="toggleUnSelectMarketCounty"
                        :options="optionsCountries"
                        :multiple="true"
                        v-model="form.countries"
                        track-by="country_id"
                        label="local_name"
                        tag-placeholder="{{ trans('travels.countries') }}"
                        placeholder="{{ trans('travels.Select countries') }}">
                    </multiselect>

                    <div v-if="errors.has('countries')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('countries') }}
                    </div>
                </div>

                <div v-if="form.countryIds" class="form-group "
                     :class="{'has-danger': errors.has('cities'), 'has-success': fields.cities && fields.cities.valid }">
                    <label for="cities">{{ trans('travels.cities') }}</label>

                    <multiselect
                        @select="setMarkerCity"
                        :options="optionsCities"
                        :multiple="true"
                        v-model='form.cities'
                        track-by="city_id"
                        label="local_name"
                        tag-placeholder="{{ trans('travels.cities') }}"
                        placeholder="{{ trans('travels.Select cities') }}"
                        :loading="form.isLoading"
                        :limit="3"
                        :max-height="600"
                        :show-no-results="false"
                        :hide-selected="true"
                        @remove="removeCity"
                        :searchable="true"
                        @search-change="searchCities"
                        :options-limit="200"
                        :custom-label="customLabel"
                    >
                    </multiselect>

                    <div v-if="errors.has('cities')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('cities') }}
                    </div>
                </div>

                <div class="form-check row">

                    <template>
                        <div style="height: 500px; width: 100%">
                            <l-map
                                :zoom="zoom"
                                :center="center"
                                ref="myMap"
                                @click="onClick"
                                @update:center="centerUpdate"
                                @update:zoom="zoomUpdate"
                                style="z-index: 0"
                            >
                                <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                                <l-marker
                                    v-for="latlng in travelAddress.meCoord"
                                    :lat-lng="latlng"
                                    :icon="iconMe"
                                >

                                </l-marker>

                            </l-map>
                        </div>
                    </template>

                </div>

                <div class="form-group"
                     :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
                    <label for="description">{{ trans('travels.description') }}</label>

                    <div>
                        <wysiwyg v-model="form.description" v-validate="''" id="description" name="description"
                                 :config="mediaWysiwygConfig"></wysiwyg>
                    </div>
                    <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('description') }}
                    </div>
                </div>

                <div class="form-group "
                     :class="{'has-danger': errors.has('minus'), 'has-success': fields.minus && fields.minus.valid }">
                    <label for="minus">{{ trans('travels.minus') }}</label>

                    <div>
                        <wysiwyg v-model="form.minus" v-validate="''" id="minus" name="minus"
                                 :config="mediaWysiwygConfig"></wysiwyg>
                    </div>
                    <div v-if="errors.has('minus')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('minus') }}
                    </div>

                </div>

                <div class="form-group"
                     :class="{'has-danger': errors.has('plus'), 'has-success': fields.plus && fields.plus.valid }">
                    <label for="plus">{{ trans('travels.plus') }}</label>

                    <div>
                        <wysiwyg v-model="form.plus" v-validate="''" id="plus" name="plus"
                                 :config="mediaWysiwygConfig"></wysiwyg>
                    </div>
                    <div v-if="errors.has('plus')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('plus')
                        }}
                    </div>

                </div>

                <div class="form-group"
                     :class="{'has-danger': errors.has('recommendation'), 'has-success': fields.recommendation && fields.recommendation.valid }">
                    <label for="recommendation">{{ trans('travels.recommendation') }}</label>

                    <div>
                        <wysiwyg v-model="form.recommendation" v-validate="''" id="recommendation" name="recommendation"
                                 :config="mediaWysiwygConfig"></wysiwyg>
                    </div>
                    <div v-if="errors.has('recommendation')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('recommendation') }}
                    </div>

                </div>

                <div class="form-group"
                     :class="{'has-danger': errors.has('youtube_link'), 'has-success': fields.youtube_link && fields.youtube_link.valid }">
                    <label for="youtube_link">{{ trans('travels.youtubeLink') }}</label>

                    <div>
                        <textarea
                            v-model="form.youtube_link"
                            v-validate="''"
                            id="youtubelink"
                            name="youtube_link"
                            class="form-control"
                            :class="{'form-control-danger': errors.has('youtube_link'), 'form-control-success': fields.youtube_link && fields.youtube_link.valid}"
                            placeholder="{{ trans('travels.youtubeLink') }}"
                        ></textarea>
                    </div>
                    <div v-if="errors.has('youtube_link')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('youtube_link') }}
                    </div>

                </div>

                @if(isset($travel))
                    @include('include.media-uploader', [
                               'mediaCollection' => app(App\Models\Travel::class)->getMediaCollection('gallery'),
                               'media' => isset($travel) ? $travel->getThumbs200ForCollection('gallery') : null,
                               'label' => trans('main.gallery')
                             ])
                @endif

            </div>
        </div>
    </div>


    <div class="col-md-4 order-md-2 mb-4">

        <div class="card ">
            <div class="card-body">
                <div class="form-check row"
                     :class="{'has-danger': errors.has('publish'), 'has-success': fields.publish && fields.publish.valid }">
                    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
                        <toggle-button
                            id="publish"
                            :labels="{checked: '{{trans('travels.publish')}}', unchecked: '{{trans('main.hide')}}'}"
                            v-model="form.publish"
                            name="publish"
                            color="#ff9f5a"
                            :width='120'
                            :height='40'
                            :font-size='14'
                        />
                    </div>
                </div>
                <hr class="mb-4">
                <div class="form-group img__container text-center">
                    <upload-image-drag
                        :nametitle="'{{trans('travels.uploadCover')}}'"
                        :travelsrc="'{{isset($travel) ? $travel->travelImageThumbUrl : '/media/nomainfoto.png'}}'"
                        :media="'{{ isset($travel) ? $travel->getThumbs200ForCollection('travelMainImage') : null}}'"
                        :collection='@json(app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getName() )'
                        :uploaded-images="{{ isset($travel) ? $travel->getThumbs200ForCollection('travelMainImage')->toJson() : '[]'}}"
                        :max-number-of-files="{{app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getMaxNumberOfFiles()
                            ? app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getMaxNumberOfFiles() : 20}}"
                        :max-file-size-in-mb="{{app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getMaxFileSize() ?
                                                round((app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getMaxFileSize()/1024/1024), 2)
                                                : 20}}"
                        :accepted-file-types="'{{ app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getAcceptedFileTypes() ?implode(',', app(\App\Models\Travel::class)->getMediaCollection('travelMainImage')->getAcceptedFileTypes()) : null}}'"
                        :url="'{{ route('brackets/media::upload-crop') }}'"
                        ref="travelMainImage_uploadercrop"
                    >
                    </upload-image-drag>
                </div>
                <div class="">
                    <label for="selectedAddress"> {{ trans('travels.selectedAddress') }}</label>
                    <ul class="list-group">

                        <li class="list-group-item" v-for="(meCoords,index) in travelAddress.meCoord" :key="index">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="form-group img__container text-center">

                                        <upload-image-drag
                                            :nametitle="'{{trans('travels.uploadImage')}}'"
                                            :travelsrc="travelAddress.travelImageThumbUrl[index]"
                                            :media="travelAddress.thumbs200Collection[index]"
                                            :collection='@json(app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getName() )'
                                            :uploaded-images="travelAddress.thumbs200Collection[index] || []"
                                            :max-number-of-files="{{app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getMaxNumberOfFiles()
                                                                    ? app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getMaxNumberOfFiles() : 20}}"
                                            :max-file-size-in-mb="{{app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getMaxFileSize() ?
                                                round((app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getMaxFileSize()/1024/1024), 2)
                                                : 20}}"
                                            :accepted-file-types="'{{ app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getAcceptedFileTypes() ?
                                            implode(',', app(\App\Models\TravelAddress::class)->getMediaCollection('travelImageAddress')->getAcceptedFileTypes()) : null}}'"
                                            :url="'{{ route('brackets/media::upload-crop') }}'"
                                            ref="travelImageAddress_uploadercropArr"
                                        >
                                        </upload-image-drag>
                                    </div>

                                    <hr class="mb-4">

                                    <div v-if="form.countryIds" class="form-group "
                                         :class="{'has-danger': errors.has('cities'), 'has-success': fields.cities && fields.cities.valid }">
                                        <label for="cities">{{ trans('travels.traveladdresscategory') }}</label>

                                        <multiselect
                                            :options="{{$categoryTravelAddress->toJson()}}"
                                            :multiple="true"
                                            v-model="travelAddress.categoriesIds[index]"
                                            track-by="id"
                                            label="name"
                                            :show-labels="false"
                                            tag-placeholder="{{ trans('travels.traveladdresscategory') }}"
                                            placeholder="{{ trans('travels.traveladdresscategory') }}"
                                        >
                                        </multiselect>

                                        <div v-if="errors.has('cities')" class="form-control-feedback form-text"
                                             v-cloak>@{{
                                            errors.first('cities') }}
                                        </div>
                                    </div>

                                    @{{ travelAddress.address[index] }}-@{{meCoords}}


                                    <input type="hidden" v-model="travelAddress.address">
                                    <a class="btn btn-sm btn-danger"
                                       v-on:click="removeMarker(travelAddress.address[index],index)">
                                        <i class="fa fa-trash-o"></i>
                                    </a>


                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <hr class="mb-4">

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('categories'), 'has-success': fields.categories && fields.categories.valid }">
                    <label for="categories">{{ trans('travels.categories') }}</label>

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


                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('transports'), 'has-success': fields.transports && fields.transports.valid }">
                    <label for="transports">{{ trans('travels.transports') }}</label>

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

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('month'), 'has-success': fields.month && fields.month.valid }">
                    <label for="month">{{ trans('travels.month') }}</label>
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

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('year'), 'has-success': fields.year && fields.year.valid }">
                    <label for="year">{{ trans('travels.year') }}</label>

                    <input type="text" v-model="form.year" v-validate="'integer'" @input="validate($event)"
                           class="form-control"
                           :class="{'form-control-danger': errors.has('year'), 'form-control-success': fields.year && fields.year.valid}"
                           id="year" name="year"
                           placeholder="{{ trans('travels.year') }}">
                    <div v-if="errors.has('year')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('year') }}
                    </div>
                </div>

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('complexity'), 'has-success': fields.complexity && fields.complexity.valid }">
                    <label for="complexity">{{ trans('travels.complexity') }}</label>


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

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('companion'), 'has-success': fields.companion && fields.companion.valid }">
                    <label for="companion">{{ trans('travels.companion') }}</label>


                    <multiselect
                        :options="{{$companion->toJson()}}"
                        :multiple="true"
                        v-model="form.companion"
                        track-by="id"
                        label="name"
                        tag-placeholder="{{ trans('travels.companion') }}"
                        placeholder="{{ trans('travels.Select companion') }}">
                    </multiselect>

                    <div v-if="errors.has('companion')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('companion') }}
                    </div>
                </div>


                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('overNightStay'), 'has-success': fields.overNightStay && fields.overNightStay.valid }">
                    <label for="overNightStay">{{ trans('travels.overNightStay') }}</label>

                    <multiselect
                        :options="{{$overNightStay->toJson()}}"
                        :multiple="true"
                        v-model="form.over_night_stay"
                        track-by="id"
                        label="name"
                        tag-placeholder="{{ trans('travels.overNightStay') }}"
                        placeholder="{{ trans('travels.Select overNightStay') }}">
                    </multiselect>

                    <div v-if="errors.has('overNightStay')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('overNightStay') }}
                    </div>
                </div>


                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('budget'), 'has-success': fields.budget && fields.budget.valid }">
                    <label for="budget">{{ trans('travels.budget') }}</label>

                    <input type="text" v-model="form.budget" v-validate="'integer'" @input="validate($event)"
                           class="form-control"
                           :class="{'form-control-danger': errors.has('budget'), 'form-control-success': fields.budget && fields.budget.valid}"
                           id="budget" name="budget" placeholder="{{ trans('travels.budget') }}">
                    <div v-if="errors.has('budget')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('budget')
                        }}
                    </div>
                </div>


                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('number_peoples'), 'has-success': fields.number_peoples && fields.number_peoples.valid }">
                    <label for="number_peoples">{{ trans('travels.number_peoples') }}</label>

                    <input type="text" v-model="form.number_peoples" v-validate="'integer'"
                           @input="validate($event)"
                           class="form-control"
                           :class="{'form-control-danger': errors.has('number_peoples'), 'form-control-success': fields.number_peoples && fields.number_peoples.valid}"
                           id="number_peoples" name="number_peoples"
                           placeholder="{{ trans('travels.number_peoples') }}">
                    <div v-if="errors.has('number_peoples')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('number_peoples') }}
                    </div>
                </div>


                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('number_days'), 'has-success': fields.number_days && fields.number_days.valid }">
                    <label for="number_days">{{ trans('travels.number_days') }}</label>

                    <input type="text" v-model="form.number_days" v-validate="'integer'" @input="validate($event)"
                           class="form-control"
                           :class="{'form-control-danger': errors.has('number_days'), 'form-control-success': fields.number_days && fields.number_days.valid}"
                           id="number_days" name="number_days" placeholder="{{ trans('travels.number_days') }}">
                    <div v-if="errors.has('number_days')" class="form-control-feedback form-text" v-cloak>@{{
                        errors.first('number_days') }}
                    </div>

                </div>

                <hr class="mb-4">
                <div class="form-group img__container text-center">
                    <label for="travelRoad"> {{ trans('travels.uploadRoad') }}</label>
                    <div class="avatar-upload ">
                        @include('brackets/admin-ui::admin.includes.avatar-uploader', [
                            'mediaCollection' => app(\App\Models\Travel::class)->getMediaCollection('travelRoad'),
                            'media' => isset($travel) ? $travel->getThumbs200ForCollection('travelRoad') : null
                        ])
                    </div>
                </div>

                <div class="form-check row"
                     :class="{'has-danger': errors.has('visa'), 'has-success': fields.visa && fields.visa.valid }">
                    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
                        <input class="form-check-input" id="visa" type="checkbox" v-model="form.visa"
                               v-validate="''"
                               data-vv-name="visa" name="visa_fake_element">
                        <label class="form-check-label" for="visa">
                            {{ trans('travels.visa') }}
                        </label>
                        <input type="hidden" name="visa" :value="form.visa">
                        <div v-if="errors.has('visa')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('visa')
                            }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
