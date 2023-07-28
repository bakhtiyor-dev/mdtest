@extends('client.layouts/fullLayoutMaster')

@section('title', 'Авторизация')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">
@endsection

@section('content')
    <section class="row flexbox-container">
        <div class="col-xl-6 col-11 d-flex justify-content-center mx-auto p-0">
            <div class="card bg-authentication rounded-0 mb-0" style="margin-top: 100px;">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                        <div class="border-right p-2">
                            <img src="{{ asset('images/exam.svg') }}" class="img-fluid" alt="branding logo">
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 px-2 pb-4 pt-2">
                            <div class="card-header">
                                <div>
                                    <img src="{{asset('images/plane.png')}}" style="height: 50px;" class="img-fluid mb-2">
                                    <span style="font-size: 30px; font-weight: 900!important; color: #0b0b0b">MDTEST</span>
                                </div>

                                <div class="card-title">
                                    <h4 class="mb-0">Вход в систему тестирования</h4>
                                </div>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                            <input id="username" type="text"
                                                   class="form-control @error('username') is-invalid @enderror"
                                                   name="username" placeholder="Email" value="{{ old('username') }}"
                                                   required autocomplete="username"
                                                   autofocus>

                                            <div class="form-control-position">
                                                <i class="fas fa-user-circle"></i>
                                            </div>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </fieldset>

                                        <fieldset class="form-label-group position-relative has-icon-left">

                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" placeholder="Пароль" required>

                                            <div class="form-control-position">
                                                <i class="fas fa-key"></i>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </fieldset>

                                        <button type="submit" class="btn btn-outline-primary float-right btn-inline"><i
                                                    class="fas fa-sign-in-alt"></i> Вход
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
