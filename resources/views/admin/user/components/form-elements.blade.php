<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('fullname'), 'has-success': fields.fullname && fields.fullname.valid }">
    <label for="fullname" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.fullname') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.fullname" v-validate="'required'" data-vv-as="учетное имя"
               @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('fullname'), 'form-control-success': fields.fullname && fields.fullname.valid}"
               id="fullname" name="fullname" placeholder="{{ trans('admin.user.columns.fullname') }}">
        <div v-if="errors.has('fullname')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fullname')
            }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('position'), 'has-success': fields.position && fields.position.valid }">
    <label for="position" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.position') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.position" class="form-control" id="position" name="position"
               placeholder="{{ trans('admin.user.columns.position') }}">
        <div v-if="errors.has('position')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('position')
            }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('department'), 'has-success': fields.department && fields.department.valid }">
    <label for="department" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.department') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.department" id="department" name="department" class="form-control"
               placeholder="{{ trans('admin.user.columns.department') }}">
        <div v-if="errors.has('department')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('department') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.email') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'required|email'" data-vv-as="электронная почта"
               @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}"
               id="email" name="email" placeholder="{{ trans('admin.user.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('organisation'), 'has-success': fields.organisation && fields.organisation.valid }">
    <label for="organisation" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.organisation') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.organisation" class="form-control"
               id="organisation" name="organisation" placeholder="{{ trans('admin.user.columns.organisation') }}">
        <div v-if="errors.has('organisation')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('organisation') }}
        </div>
    </div>
</div>

{{--<div class="form-group row align-items-center"--}}
{{--     :class="{'has-danger': errors.has('username'), 'has-success': fields.username && fields.username.valid }">--}}
{{--    <label for="username" class="col-form-label text-md-right"--}}
{{--           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.login') }}</label>--}}
{{--    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
{{--        <input type="text" v-model="form.username" v-validate="'required'" data-vv-as="логин" @input="validate($event)"--}}
{{--               class="form-control"--}}
{{--               :class="{'form-control-danger': errors.has('username'), 'form-control-success': fields.username && fields.username.valid}"--}}
{{--               id="username" name="username" placeholder="{{ trans('admin.user.columns.login') }}">--}}
{{--        <div v-if="errors.has('username')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('username')--}}
{{--            }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('password'), 'has-success': fields.password && fields.password.valid }">
    <label for="password" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.password') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="password" v-model="form.password" v-validate="'min:7'" data-vv-as="пароль"
               @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('password'), 'form-control-success': fields.password && fields.password.valid}"
               id="password" name="password" placeholder="{{ trans('admin.user.columns.password') }}" ref="password">
        <div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password')
            }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('password_confirmation'), 'has-success': fields.password_confirmation && fields.password_confirmation.valid }">
    <label for="password_confirmation" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.password_repeat') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="password" v-model="form.password_confirmation" v-validate="'confirmed:password|min:7'"
               data-vv-as="пароль" @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('password_confirmation'), 'form-control-success': fields.password_confirmation && fields.password_confirmation.valid}"
               id="password_confirmation" name="password_confirmation"
               placeholder="{{ trans('admin.user.columns.password') }}" data-vv-as="password">
        <div v-if="errors.has('password_confirmation')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('password_confirmation') }}
        </div>
    </div>
</div>









