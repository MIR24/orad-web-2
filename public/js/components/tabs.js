$('.section-tab').on('click', function () {
    var section = $(this).data('section'),
        capitalized = section.charAt(0).toUpperCase() + section.slice(1);
    $('#section-'+section).show();
    Sections[capitalized].init();
});
$('.section-tab').first().click();
