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
        <link href="{{ auto_asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="{{ auto_asset('assets/demo/demo8/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="assets/demo/demo8/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

        <!--end::Base Styles -->
        <link rel="shortcut icon" href="{{ auto_asset('assets/demo8/demo/media/img/logo/favicon.ico') }}" />
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body style="background-color: #404658" class="m-page--loading-enabled m-page--loading m-footer--push m-aside--offcanvas-default">

        <!-- begin::Page loader -->
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>Please wait...</span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>

        <!-- end::Page Loader -->

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">

            <!-- begin::Header -->
            <header id="m_header" class="m-grid__item       m-header " m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10">
                <div class="m-header__top">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">

                            <!-- begin::Brand -->
                            <div class="m-stack__item m-brand m-stack__item--left">
                                <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                        <a href="index.html" class="m-brand__logo-wrapper">
                                            <img alt="{{ config('app.name', 'Laravel') }}" src="{{ auto_asset('assets/demo/demo8/media/img/logo/logo.png') }}" class="m-brand__logo-default" />
                                            <img alt="{{ config('app.name', 'Laravel') }}" src="{{ auto_asset('assets/demo/demo8/media/img/logo/logo_inverse.png') }}" class="m-brand__logo-inverse" />
                                        </a>
                                    </div>
                                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                                        <!-- begin::Responsive Header Menu Toggler-->
                                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                            <span></span>
                                        </a>

                                        <!-- end::Responsive Header Menu Toggler-->

                                        <!-- begin::Topbar Toggler-->
                                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                            <i class="flaticon-more"></i>
                                        </a>

                                        <!--end::Topbar Toggler-->
                                    </div>
                                </div>
                            </div>

                            <!-- end::Brand -->

                            <!-- begin::Topbar -->

                            <div class="m-stack__item m-stack__item--right m-header-head" id="m_header_nav">
                                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                    <div class="m-stack__item m-topbar__nav-wrapper">
                                        <ul class="m-topbar__nav m-nav m-nav--inline ">
                                            @include('layouts.partials.user-profile')
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- end::Topbar -->

                        </div>
                    </div>
                </div>
                <div class="m-header__bottom" style="height:56px">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">

                            <!-- begin::Horizontal Menu -->
                            <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                                    <i class="la la-close"></i>
                                </button>
                                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                        @foreach (config('tabs.default') as $tabConfig)
                                            @if (array_key_exists('active', $tabConfig))
                                                @include('layouts.partials.tab-active', ['jsClass' => $tabConfig['jsClass'], 'translation' => __($tabConfig['jsClass'])])
                                            @else
                                                @include('layouts.partials.tab-inactive', ['jsClass' => $tabConfig['jsClass'], 'translation' => __($tabConfig['jsClass'])])
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- end::Horizontal Menu -->
                        </div>
                    </div>
                </div>
            </header>

            <!-- end::Header -->

            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
                <div id="tab-content" class="m-grid__item m-grid__item--fluid m-wrapper"></div>
            </div>

            <!-- end::Body -->

            <!-- begin::Footer -->
            <footer class="m-grid__item m-footer ">
                <div class="m-container m-container--fluid m-container--full-height m-page__container">
                    <div class="m-footer__wrapper">
                        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                                <span class="m-footer__copyright">
                                    2017 &copy; Metronic theme by
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- end::Footer -->
        </div>

        <!-- end:: Page -->

        <!-- begin::Scroll Top -->
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>

        <!-- end::Scroll Top -->

        <!--begin::Base Scripts -->
        <script src="{{ auto_asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ auto_asset('assets/demo/demo8/base/scripts.bundle.js') }}" type="text/javascript"></script>

        <!--end::Base Scripts -->

        <!--begin::Page Vendors Scripts -->
        <!--<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>-->

        <!--end::Page Vendors Scripts -->

        <!--begin::Page Snippets -->
        <script src="{{ auto_asset('assets/app/js/dashboard.js') }}" type="text/javascript"></script>

        <!--end::Page Snippets -->

        <!-- start:Custom Script -->
        <script src="{{ auto_asset('assets/custom/custom.js') }}"></script>
        <!-- end:Custom Script -->
    </body>

    <!-- end::Body -->
</html>