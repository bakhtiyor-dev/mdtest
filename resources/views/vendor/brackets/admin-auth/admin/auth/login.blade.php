@extends('brackets/admin-ui::admin.layout.master')

@section('title', trans('brackets/admin-auth::admin.login.title'))

@section('content')
	<div class="container" id="app">
	    <div class="row align-items-center justify-content-between auth">
			<div class="col-md-6 d-none d-lg-block">
				<img src="/images/usability.svg" alt="image" class="img-fluid">
			</div>
	        <div class="col-lg-5">
				<div class="card">
					<div class="card-block">
						<auth-form
								:action="'{{ url('/admin/login') }}'"
								:data="{}"
								inline-template>
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}" novalidate>
								{{ csrf_field() }}
								<div class="auth-header pb-2">
									<div class="text-center">
										<img src="{{asset('images/plane.png')}}" style="height: 40px"  class="img-fluid mb-4" >
										<span style="font-size: 30px; font-weight: 700;">MDTEST</span>
									</div>
									<h1 class="auth-title">Вход в панель управления</h1>
									<p class="auth-subtitle">Система тестирования персонала</p>
								</div>
								<div class="auth-body">
									@include('brackets/admin-auth::admin.auth.includes.messages')
									<div class="form-group" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
										<label for="email">{{ trans('brackets/admin-auth::admin.auth_global.email') }}</label>
										<div class="input-group input-group--custom">
											<div class="input-group-addon"><i class="input-icon input-icon--mail"></i></div>
											<input type="text" v-model="form.email" v-validate="'required|email'"  data-vv-as="электронная почта" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('brackets/admin-auth::admin.auth_global.email') }}">
										</div>
										<div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
									</div>

									<div class="form-group" :class="{'has-danger': errors.has('password'), 'has-success': fields.password && fields.password.valid }">
										<label for="password">{{ trans('brackets/admin-auth::admin.auth_global.password') }}</label>
										<div class="input-group input-group--custom">
											<div class="input-group-addon"><i class="input-icon input-icon--lock"></i></div>
											<input type="password" v-model="form.password"  class="form-control" :class="{'form-control-danger': errors.has('password'), 'form-control-success': fields.password && fields.password.valid}" id="password" name="password" placeholder="{{ trans('brackets/admin-auth::admin.auth_global.password') }}">
										</div>
										<div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password') }}</div>
									</div>

									<div class="form-group">
										<div class="mb-2">
											<input class="form-check-input" id="checkbox" type="checkbox" name="remember">
											<label class="form-check-label font-weight-normal" for="checkbox">
												<span style="text-transform: none"> Запомнить меня</span>
											</label>
										</div>

										<button type="submit" class="btn btn-primary btn-block btn-spinner"><i class="fa"></i> Вход</button>
									</div>
									<div class="form-group text-center">
										<a href="{{ url('/admin/password-reset') }}" class="auth-ghost-link">{{ trans('brackets/admin-auth::admin.login.forgot_password') }}</a>
									</div>
								</div>
							</form>
						</auth-form>
					</div>
				</div>
	        </div>
	    </div>
	</div>
   
@endsection


@section('bottom-scripts')
<script type="text/javascript">
    // fix chrome password autofill
    // https://github.com/vuejs/vue/issues/1331
    document.getElementById('password').dispatchEvent(new Event('input'));
</script>
@endsection