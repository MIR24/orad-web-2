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
    <body style="background-image: url({{ auto_asset('assets/app/media/img/bg/bg-7.jpg') }})" class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">

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
                                        <ul class="m-topbar__nav m-nav m-nav--inline">
                                            @include('layouts.partials.user-profile')
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- end::Topbar -->

                        </div>
                    </div>
                </div>
                <div class="m-header__bottom">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">

                            <!-- begin::Horizontal Menu -->
                            <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                                    <i class="la la-close"></i>
                                </button>
                                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                        <li class="m-menu__item  m-menu__item--active  m-menu__item--active-tab  m-menu__item--submenu m-menu__item--tabs" m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a href="index.html" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">Dashboard</span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-support"></i>
                                                            <span class="m-menu__link-text">Dashboard</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item  m-menu__item--active " aria-haspopup="true">
                                                        <a href="index.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-file"></i>
                                                            <span class="m-menu__link-text">Reports</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-coins"></i>
                                                            <span class="m-menu__link-text">Finance</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--submenu-tabs" m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon flaticon-users"></i>
                                                            <span class="m-menu__link-text">Customers</span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <div class="m-menu__subnav">
                                                                <ul class="m-menu__content">
                                                                    <li class="m-menu__item">
                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                            <span class="m-menu__link-text">Finance Reports</span>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </h3>
                                                                        <ul class="m-menu__inner">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-map"></i>
                                                                                    <span class="m-menu__link-text">Annual Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-user"></i>
                                                                                    <span class="m-menu__link-text">HR Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                                                    <span class="m-menu__link-text">IPO Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                                    <span class="m-menu__link-text">Finance Margins</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                                    <span class="m-menu__link-text">Revenue Reports</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="m-menu__item">
                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                            <span class="m-menu__link-text">Project Reports</span>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </h3>
                                                                        <ul class="m-menu__inner">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Coca Cola CRM</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Delta Airlines Booking Site</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Malibu Accounting</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Vineseed Website Rewamp</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Zircon Mobile App</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Mercury CMS</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="m-menu__item">
                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                            <span class="m-menu__link-text">HR Reports</span>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </h3>
                                                                        <ul class="m-menu__inner">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Staff Directory</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Client Directory</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Salary Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Staff Payslips</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Corporate Expenses</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Project Expenses</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="m-menu__item">
                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                            <span class="m-menu__link-text">Reporting Apps</span>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </h3>
                                                                        <ul class="m-menu__inner">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Report Adjusments</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Sources & Mediums</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Reporting Settings</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Conversions</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Report Flows</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Audit & Logs</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs" m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon flaticon-add"></i>
                                                            <span class="m-menu__link-text">Actions</span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">
                                                                <li class="m-menu__item " aria-haspopup="true">
                                                                    <a href="inner2.html" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon flaticon-diagram"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">Generate Reports</span>
                                                                                <span class="m-menu__link-badge">
                                                                                    <span class="m-badge m-badge--success">2</span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                        <i class="m-menu__link-icon flaticon-business"></i>
                                                                        <span class="m-menu__link-text">Manage Orders</span>
                                                                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                    </a>
                                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                        <span class="m-menu__arrow "></span>
                                                                        <ul class="m-menu__subnav">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Latest Orders</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Pending Orders</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Processed Orders</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Delivery Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Payments</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Customers</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                        <i class="m-menu__link-icon flaticon-chat-1"></i>
                                                                        <span class="m-menu__link-text">Customer Feedbacks</span>
                                                                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                    </a>
                                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                        <span class="m-menu__arrow "></span>
                                                                        <ul class="m-menu__subnav">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Customer Feedbacks</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Supplier Feedbacks</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Reviewed Feedbacks</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Resolved Feedbacks</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <span class="m-menu__link-text">Feedback Reports</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="inner2.html" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon flaticon-users"></i>
                                                                        <span class="m-menu__link-text">Register Member</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                                                            <span class="m-menu__link-text">Reports</span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <div class="m-menu__subnav">
                                                                <ul class="m-menu__content">
                                                                    <li class="m-menu__item">
                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                            <span class="m-menu__link-text">Finance Reports</span>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </h3>
                                                                        <ul class="m-menu__inner">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-map"></i>
                                                                                    <span class="m-menu__link-text">Annual Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-user"></i>
                                                                                    <span class="m-menu__link-text">HR Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                                                    <span class="m-menu__link-text">IPO Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                                    <span class="m-menu__link-text">Finance Margins</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                                    <span class="m-menu__link-text">Revenue Reports</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="m-menu__item">
                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                            <span class="m-menu__link-text">Project Reports</span>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </h3>
                                                                        <ul class="m-menu__inner">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Coca Cola CRM</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Delta Airlines Booking Site</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Malibu Accounting</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Vineseed Website Rewamp</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Zircon Mobile App</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                        <span></span>
                                                                                    </i>
                                                                                    <span class="m-menu__link-text">Mercury CMS</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--submenu-tabs m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon flaticon-more-v3"></i>
                                                            <span class="m-menu__link-text"></span>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--pull">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">
                                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="inner2.html" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon flaticon-business"></i>
                                                                        <span class="m-menu__link-text">eCommerce</span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="crud/datatable_v1.html" class="m-menu__link m-menu__toggle">
                                                                        <i class="m-menu__link-icon flaticon-computer"></i>
                                                                        <span class="m-menu__link-text">Audience</span>
                                                                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                    </a>
                                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                        <span class="m-menu__arrow "></span>
                                                                        <ul class="m-menu__subnav">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                                                    <span class="m-menu__link-text">Active Users</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-interface-1"></i>
                                                                                    <span class="m-menu__link-text">User Explorer</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-lifebuoy"></i>
                                                                                    <span class="m-menu__link-text">Users Flows</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                                    <span class="m-menu__link-text">Market Segments</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-graphic"></i>
                                                                                    <span class="m-menu__link-text">User Reports</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="inner2.html" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon flaticon-map"></i>
                                                                        <span class="m-menu__link-text">Marketing</span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="inner2.html" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">Campaigns</span>
                                                                                <span class="m-menu__link-badge">
                                                                                    <span class="m-badge m-badge--success">3</span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                        <i class="m-menu__link-icon flaticon-infinity"></i>
                                                                        <span class="m-menu__link-text">Cloud Manager</span>
                                                                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                    </a>
                                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                                        <span class="m-menu__arrow "></span>
                                                                        <ul class="m-menu__subnav">
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-add"></i>
                                                                                    <span class="m-menu__link-title">
                                                                                        <span class="m-menu__link-wrap">
                                                                                            <span class="m-menu__link-text">File Upload</span>
                                                                                            <span class="m-menu__link-badge">
                                                                                                <span class="m-badge m-badge--danger">3</span>
                                                                                            </span>
                                                                                        </span>
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-signs-1"></i>
                                                                                    <span class="m-menu__link-text">File Attributes</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-folder"></i>
                                                                                    <span class="m-menu__link-text">Folders</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a href="inner2.html" class="m-menu__link ">
                                                                                    <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                                                                                    <span class="m-menu__link-text">System Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs" m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">Accounting</span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                            <span class="m-menu__link-text">Revenue</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-analytics"></i>
                                                            <span class="m-menu__link-text">Bills</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-notes"></i>
                                                            <span class="m-menu__link-text">IPO</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                            <span class="m-menu__link-text">Tax Management</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-alarm-1"></i>
                                                            <span class="m-menu__link-text">Invoices</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs" m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">Reports</span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                            <span class="m-menu__link-text">Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-analytics"></i>
                                                            <span class="m-menu__link-text">Customers</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " aria-haspopup="true">
                                                        <a href="inner.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-notes"></i>
                                                            <span class="m-menu__link-text">Revenue</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                            <span class="m-menu__link-text">Invoices</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-alarm-1"></i>
                                                            <span class="m-menu__link-text">Bills</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs" m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">Orders</span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                            <span class="m-menu__link-text">Pending</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-analytics"></i>
                                                            <span class="m-menu__link-text">Delivered</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-notes"></i>
                                                            <span class="m-menu__link-text">Canceled</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                            <span class="m-menu__link-text">Customer Care</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-alarm-1"></i>
                                                            <span class="m-menu__link-text">Payments</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs" m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">Customers</span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-settings-1"></i>
                                                            <span class="m-menu__link-text">Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-imac"></i>
                                                            <span class="m-menu__link-text">Feedbacks</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-paper-plane"></i>
                                                            <span class="m-menu__link-text">Customer Support</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner2.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-multimedia"></i>
                                                            <span class="m-menu__link-text">Statistics</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs" m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">Tools</span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-settings-1"></i>
                                                            <span class="m-menu__link-text">Build Tools</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " aria-haspopup="true">
                                                        <a href="builder.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-imac"></i>
                                                            <span class="m-menu__link-text">Layout Builder</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-paper-plane"></i>
                                                            <span class="m-menu__link-text">Documentatiion</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a href="inner2.html" class="m-menu__link ">
                                                            <i class="m-menu__link-icon flaticon-multimedia"></i>
                                                            <span class="m-menu__link-text">Reviews</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
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
                <div class="m-grid__item m-grid__item--fluid m-wrapper">

                    @yield('content')

                </div>
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
                                    <a href="https://keenthemes.com" class="m-link">Keenthemes</a>
                                </span>
                            </div>
                            <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                                <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">About</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">Privacy</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">T&C</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">Purchase</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                                            <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- end::Footer -->
        </div>

        <!-- end:: Page -->

        <!-- begin::Quick Sidebar -->
        <div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
            <div class="m-quick-sidebar__content m--hide">
                <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
                    <i class="la la-close"></i>
                </span>
                <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">Messages</a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">Settings</a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">Logs</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
                        <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                            <div class="m-messenger__messages m-scrollable">
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="{{ auto_asset('assets/app/media/img//users/user3.jpg') }}" alt="" />
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Hi Bob. What time will be the meeting ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Hi Megan. It's at 2.30PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="{{ auto_asset('assets/app/media/img//users/user3.jpg') }}" alt="" />
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Will the development team be joining ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Yes sure. I invited them as well
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__datetime">2:30PM</div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="{{ auto_asset('assets/app/media/img//users/user3.jpg') }}" alt="" />
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Noted. For the Coca-Cola Mobile App project as well ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Yes, sure.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Please also prepare the quotation for the Loop CRM project as well.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__datetime">3:15PM</div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-no-pic m--bg-fill-danger">
                                            <span>M</span>
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Noted. I will prepare it.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Thanks Megan. I will see you later.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="{{ auto_asset('assets/app/media/img//users/user3.jpg') }}" alt="" />
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Sure. See you in the meeting soon.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__seperator"></div>
                            <div class="m-messenger__form">
                                <div class="m-messenger__form-controls">
                                    <input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
                                </div>
                                <div class="m-messenger__form-tools">
                                    <a href="" class="m-messenger__form-attachment">
                                        <i class="la la-paperclip"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="m_quick_sidebar_tabs_settings" role="tabpanel">
                        <div class="m-list-settings m-scrollable">
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">General Settings</div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Email Notifications</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Site Tracking</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">SMS Alerts</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Backup Storage</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Audit Logs</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">System Settings</div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">System Logs</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Error Reporting</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Applications Logs</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Backup Servers</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Audit Logs</span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="m_quick_sidebar_tabs_logs" role="tabpanel">
                        <div class="m-list-timeline m-scrollable">
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    System Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">12 new users registered
                                            <span class="m-badge m-badge--warning m-badge--wide">important</span>
                                        </a>
                                        <span class="m-list-timeline__time">Just now</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">System shutdown</a>
                                        <span class="m-list-timeline__time">11 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">New invoice received</a>
                                        <span class="m-list-timeline__time">20 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">Database overloaded 89%
                                            <span class="m-badge m-badge--success m-badge--wide">resolved</span>
                                        </a>
                                        <span class="m-list-timeline__time">1 hr</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">System error</a>
                                        <span class="m-list-timeline__time">2 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">Production server down
                                            <span class="m-badge m-badge--danger m-badge--wide">pending</span>
                                        </a>
                                        <span class="m-list-timeline__time">3 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">Production server up</a>
                                        <span class="m-list-timeline__time">5 hrs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    Applications Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">New order received
                                            <span class="m-badge m-badge--info m-badge--wide">urgent</span>
                                        </a>
                                        <span class="m-list-timeline__time">7 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">12 new users registered</a>
                                        <span class="m-list-timeline__time">Just now</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">System shutdown</a>
                                        <span class="m-list-timeline__time">11 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">New invoices received</a>
                                        <span class="m-list-timeline__time">20 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">Database overloaded 89%</a>
                                        <span class="m-list-timeline__time">1 hr</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">System error
                                            <span class="m-badge m-badge--info m-badge--wide">pending</span>
                                        </a>
                                        <span class="m-list-timeline__time">2 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">Production server down</a>
                                        <span class="m-list-timeline__time">3 hrs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    Server Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">Production server up</a>
                                        <span class="m-list-timeline__time">5 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">New order received</a>
                                        <span class="m-list-timeline__time">7 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">12 new users registered</a>
                                        <span class="m-list-timeline__time">Just now</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">System shutdown</a>
                                        <span class="m-list-timeline__time">11 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">New invoice received</a>
                                        <span class="m-list-timeline__time">20 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">Database overloaded 89%</a>
                                        <span class="m-list-timeline__time">1 hr</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">System error</a>
                                        <span class="m-list-timeline__time">2 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">Production server down</a>
                                        <span class="m-list-timeline__time">3 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">Production server up</a>
                                        <span class="m-list-timeline__time">5 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">New order received</a>
                                        <span class="m-list-timeline__time">1117 hrs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end::Quick Sidebar -->

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