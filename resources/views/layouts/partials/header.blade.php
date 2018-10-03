<header id="m_header" class="m-grid__item m-header " m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10">
    <div class="m-header__top">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- begin::Brand -->
                <div class="m-stack__item m-brand m-stack__item--left">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="index.html" class="m-brand__logo-wrapper">
                                <img alt="{{ config('app.name', 'Laravel') }}" src="{{ asset('assets/demo/demo8/media/img/logo/logo.png') }}" class="m-brand__logo-default" />
                                <img alt="{{ config('app.name', 'Laravel') }}" src="{{ asset('assets/demo/demo8/media/img/logo/logo_inverse.png') }}" class="m-brand__logo-inverse" />
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