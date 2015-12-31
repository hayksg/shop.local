$(function(){
    var len = $('.my-image').length;

    for (var i = 0; i < len; i++) {
        if ($('.my-image').eq(i).height() < 200){
            $('.my-image').eq(i).attr('src', '/template/images/home/no-image.jpg');
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////

    if ($(document).height() <= $(window).height()) {
        $('footer').addClass('navbar-fixed-bottom');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////

    $('.cart').hover(
        function(){
            $(this).css({
                'background': '#f5f5ed',
                'color': '#696763',
            });
        },
        function(){
            $(this).css({
                'background': '#fe980f',
                'color': '#fff',
            });
        }
    );

    ///////////////////////////////////////////////////////////////////////////////////////////////
});