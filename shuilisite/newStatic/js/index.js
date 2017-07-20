$(function(){
    //导入header footer
    $('#header').load('header.html');
    $('#footer').load('footer.html');

    //tab切换
    $('.tab-item').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    //底部tab切换
    $('.order-nav-item').click(function () {
        $(this).addClass('current').siblings().removeClass('current');
    });

    $('.carousel').carousel({
        interval: 200000
    });

    // $('.navbar-nav > li').mouseover(function (e) {
    //     console.log(111);
    // });

});