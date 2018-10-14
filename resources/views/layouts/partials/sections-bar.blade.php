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

<script>
    var current = null;
    $('.section-tab').on('click', function () {
        var section = $(this).data('section');
        if (section !== current) {
            current = section;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            $('.content-loader').show();
            $.ajax({
                headers: {
                    'X-CSRF-Token': csrf
                },
                url: "/section/" + section,
                method: 'GET',
                success: function (data) {
                    $('.content-loader').hide();
                    $("#tab-content").html(data);
                },
            });
        }
    });
    $('#tab-0').click(); //йееееееееее
</script>
