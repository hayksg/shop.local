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



});