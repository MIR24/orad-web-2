@guest
    <a href="{{ route('login') }}" class="avatar empty">
        <div><i class="flaticon-avatar"></i></div><span>Войти</span>
    </a>
@else
    <a href="{{ route('logout') }}" class="avatar" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <div style="background-image: url(assets/app/media/img/users/user1.jpg)"></div><span>Выйти</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endguest
