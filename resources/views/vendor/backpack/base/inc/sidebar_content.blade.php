<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ route('front') }}"><i class="fa fa-dashboard"></i> <span>{{ __('Пользовательский интерфейс') }}</span></a></li>
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ __('backpack::base.dashboard') }}</span></a></li>
<!-- Users, Roles Permissions -->
<li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>{{ __('Users') }}</span></a></li>
<li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>{{ __('Roles') }}</span></a></li>
<li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>{{ __('Permissions') }}</span></a></li>