(function ($) {

    $('#slide-out-toggle').click(function(e) {
        e.preventDefault();
        $('#widget-area-wrap').slideToggle();

        var icon = $(this).children('.fa');

        if ($(icon).hasClass('fa-angle-double-down')) {
            $(icon).removeClass('fa-angle-double-down');
            $(icon).addClass('fa-angle-double-up');
        }
        else {
            $(icon).removeClass('fa-angle-double-up');
            $(icon).addClass('fa-angle-double-down');
        }
    });

    if ($.isFunction($.fn.flexslider)) {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: false
        });
    }

})(jQuery);