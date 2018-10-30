@extends('layouts.metronic-login')

@section('content')
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
        <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
            <div class="m-stack m-stack--hor m-stack--desktop">
                <div class="m-stack__item m-stack__item--fluid">
                    <div class="m-login__wrapper">
                        <div class="m-login__logo">
                            <a href="#">
                                <img src="{{ auto_asset('assets/app/media/img//logos/logo-2.png') }}">
                            </a>
                        </div>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">{{ __('Reset Password') }}</h3>
                            </div>
                            <form class="m-login__form m-form" method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group m-form__group">
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ $email ?? old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group m-form__group">
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control m-input{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group m-form__group">
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control m-input" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content m-grid-item--center" style="background-image: url({{ auto_asset('assets/app/media/img//bg/bg-4.jpg') }})">
            <div class="m-grid__item">
                <h3 class="m-login__welcome">{{ config('app.name', 'Laravel') }}</h3>
                <p class="m-login__msg">
                    Веб-приложение для редактирования:
                    <br>эфирных топов
                    <br>бегущих строк
                    <br>фото, используемых в эфире
                    <br>курса валют
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
@endsection
