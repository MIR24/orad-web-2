@guest
    <li class="m-nav__item m-topbar__quick-actions">
        <a href="{{ route('login') }}" class="m-nav__link">
            <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide">{{ __('Login') }}</span>
            <span class="m-nav__link-icon">
                <span class="m-nav__link-icon-wrapper">
                    <i class="flaticon-avatar"></i>
                </span>
            </span>
        </a>
    </li>
@else
    <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
        <a href="#" class="m-nav__link m-dropdown__toggle">
            <span class="m-topbar__userpic">
                <img src="{{ asset('assets/app/media/img/users/user1.jpg') }}" class="m--img-rounded m--marginless m--img-centered" alt="" />
            </span>
            <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                <span class="m-nav__link-icon-wrapper">
                    <i class="flaticon-user-ok"></i>
                </span>
            </span>
            <span class="m-topbar__username m--hide">{{ Auth::user()->name }}</span>
        </a>
        <div class="m-dropdown__wrapper">
            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__header m--align-center">
                    <div class="m-card-user m-card-user--skin-light">
                        <div class="m-card-user__pic">
                            <img src="{{ asset('assets/app/media/img/users/user1.jpg') }}" class="m--img-rounded m--marginless" alt="" />
                        </div>
                        <div class="m-card-user__details">
                            <span class="m-card-user__name m--font-weight-500">{{ Auth::user()->name }}</span>
                            <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</a>
                        </div>
                    </div>
                </div>
                <div class="m-dropdown__body">
                    <div class="m-dropdown__content">
                        <ul class="m-nav m-nav--skin-light">
                            <li class="m-nav__section m--hide">
                                <span class="m-nav__section-text">Section</span>
                            </li>
                            <li class="m-nav__item">
                                <a class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endguest
