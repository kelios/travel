<div class="row">
    <div class="col-md-4 text-center">
        <div class="avatar-upload">
            @include('brackets/admin-ui::admin.includes.avatar-uploader', [
                'mediaCollection' => app(\App\User::class)->getMediaCollection('userAvatar'),
                'media' => $user->getThumbs200ForCollection('userAvatar')
            ])
        </div>
    </div>

    <div class="col-md-8 text-center">
        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
            <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">
                {{ trans('user.name') }}
            </label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)"
                       class="form-control"
                       :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}"
                       id="name" name="name" placeholder="{{ trans('admin.user.columns.name') }}">
                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name')
                    }}
                </div>
            </div>
        </div>

        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
            <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">
                {{ trans('user.email') }}
            </label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)"
                       class="form-control"
                       :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}"
                       id="email" name="email" placeholder="{{ trans('admin.user.columns.email') }}">
                <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('email') }}
                </div>
            </div>
        </div>

        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('password'), 'has-success': fields.password && fields.password.valid }">
            <label for="password" class="col-form-label text-md-right"
                   :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">
                {{ trans('user.password') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="password" v-model="form.password" v-validate="'min:7'" @input="validate($event)"
                       class="form-control"
                       :class="{'form-control-danger': errors.has('password'), 'form-control-success': fields.password && fields.password.valid}"
                       id="password" name="password" placeholder="{{ trans('admin.user.columns.password') }}"
                       ref="password">
                <div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('password')
                    }}
                </div>
            </div>
        </div>

        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('password_confirmation'), 'has-success': fields.password_confirmation && fields.password_confirmation.valid }">
            <label for="password_confirmation" class="col-form-label text-md-right"
                   :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">
                {{ trans('user.password_repeat') }}
            </label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="password" v-model="form.password_confirmation" v-validate="'confirmed:password|min:7'"
                       @input="validate($event)" class="form-control"
                       :class="{'form-control-danger': errors.has('password_confirmation'), 'form-control-success': fields.password_confirmation && fields.password_confirmation.valid}"
                       id="password_confirmation" name="password_confirmation"
                       placeholder="{{ trans('user.password') }}" data-vv-as="password">
                <div v-if="errors.has('password_confirmation')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('password_confirmation') }}
                </div>
            </div>
        </div>
    </div>
</div>
