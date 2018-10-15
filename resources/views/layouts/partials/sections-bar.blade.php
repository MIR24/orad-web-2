<div class="sections-bar">
    <ul>
        @for ($i=0; $i < count($sections);$i++)
            <li id="tab-{{$i}}" data-section="{{$sections[$i]['component']}}" class="section-tab {{$i !== 0 ?:'current'}}">
                {{$sections[$i]['title']}}
            </li>
        @endfor
    </ul>
    <div class="bottom"></div>
</div>
