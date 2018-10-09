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
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group m-form__group">
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ $email ?? old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="m-login__form-action">
                                    <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">{{ __('Send Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.introduction')
    </div>
</div>
<!-- end:: Page -->
@endsection
