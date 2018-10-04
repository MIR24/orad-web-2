<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700", "Asap+Condensed:500"]
                },
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!--end::Web font -->

        <!--begin::Page Vendors Styles -->
        <!--<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />-->

        <!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

        <!--end::Page Vendors Styles -->

        <!--begin::Base Styles -->
        <link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="{{ asset('assets/demo/demo8/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="assets/demo/demo8/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

        <!--end::Base Styles -->
        <link rel="shortcut icon" href="{{ asset('assets/demo8/demo/media/img/logo/favicon.ico') }}" />
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body style="background-image: url({{ asset('assets/app/media/img/bg/bg-7.jpg') }})" class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">

        @include('layouts.partials.loader')

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            @include('layouts.partials.header')
            @include('layouts.partials.sections')
            <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    @yield('content')
                </div>
            </div>
            @include('layouts.partials.footer')

            <!-- end::Footer -->
        </div>
        <!-- end:: Page -->

        <!-- begin::Scroll Top -->
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>

        <!-- end::Scroll Top -->

        <!--begin::Base Scripts -->
        <script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/demo/demo8/base/scripts.bundle.js') }}" type="text/javascript"></script>

        <!--end::Base Scripts -->

        <!--begin::Page Vendors Scripts -->
        <!--<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>-->

        <!--end::Page Vendors Scripts -->

        <!--begin::Page Snippets -->
        <script src="{{ asset('assets/app/js/dashboard.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/app/js/app.js') }}" type="text/javascript"></script>

        <!--end::Page Snippets -->

        <!-- begin::Page Loader -->
        <script>
            $(window).on('load', function() {
                $('body').removeClass('m-page--loading');
            });
        </script>

        <!-- end::Page Loader -->
    </body>

    <!-- end::Body -->
</html>