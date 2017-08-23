$(function(){

    $('.close-download').click(function () {
        $('.download').css('display','none');

    });

    //左边tab切换
    $('.tab-item').click(function (e) {
        var id = e.currentTarget.id;
        console.log(e.currentTarget.id);
        $(this).addClass('active').siblings().removeClass('active');
        $('.' + id).addClass('active').siblings().removeClass('active');

    });
    //sub-tab切换
    $('.sub-tab-item').click(function (e) {
        var id = e.currentTarget.id;
        $(this).addClass('active').siblings().removeClass('active');
        $('.' + id).addClass('current').siblings().removeClass('current');
    });
    //底部tab切换
    $('.order-nav-item').click(function (e) {
        var id = e.currentTarget.id;
        $(this).addClass('current').siblings().removeClass('current');
        $('.' + id).addClass('active').siblings().removeClass('active');

    });

    $('.carousel').carousel({
        interval: 4000
    });

    // $('.navbar-nav > li').mouseover(function (e) {
    //     console.log(111);
    // });

});