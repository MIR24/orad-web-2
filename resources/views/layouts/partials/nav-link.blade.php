<li class="m-nav__item m-topbar__quick-actions">
    <a id="{{ empty($idJs) ? null : $idJs }}" class="m-nav__link" href="{{ empty($link) ? '#' : $link }}">
        <span class="m-nav__link-icon">
            <span class="btn {{ $cssClass }} m-btn m-btn--icon m-btn--pill">
                {!! $text !!}
            </span>
        </span>
    </a>
</li>