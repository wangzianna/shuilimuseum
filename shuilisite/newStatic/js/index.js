$(function(){
    $('#owl-demo').owlCarousel({
        items: 1,
        autoPlay: 3000,
        autoHeight: false,
        transitionStyle: 'fade'
    });
    $('#owl-demo2').owlCarousel({
        items: 2,
        autoPlay: 3000,
        autoHeight: false,
        transitionStyle: 'fade',
        navigation: true,
        navigationText: ["上一个","下一个"]
    });
    
    $('.tab-item').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    $('.order-nav-item').click(function () {
        $(this).addClass('current').siblings().removeClass('current');
    });

    $('.carousel').carousel({
        interval: 200000
    })
});