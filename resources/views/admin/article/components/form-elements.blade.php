<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.article.columns.name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="''" @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}"
               id="name" name="name" placeholder="{{ trans('admin.article.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.article.columns.description') }}</label>
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
     :class="{'has-danger': errors.has('articleType'), 'has-success': fields.articleType && fields.articleType.valid }">
    <label for="articleType" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.article.columns.article_type_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect
            :options="{{$articleType}}"
            v-model="form.article_type"
            :multiple="false"
            track-by="id"
            label="name"
            tag-placeholder="{{ trans('admin.article-type.select') }}"
            placeholder="{{ trans('admin.article-type.select') }}"
        >

        </multiselect>
        <div v-if="errors.has('articleType')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('articleType') }}
        </div>
    </div>
</div>

<div class="form-check row"
     :class="{'has-danger': errors.has('publish'), 'has-success': fields.publish && fields.publish.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="publish" type="checkbox" v-model="form.publish" v-validate="''"
               data-vv-name="publish" name="publish_fake_element">
        <label class="form-check-label" for="publish">
            {{ trans('admin.article.columns.publish') }}
        </label>
        <input type="hidden" name="publish" :value="form.publish">
        <div v-if="errors.has('publish')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('publish')
            }}
        </div>
    </div>
</div>


