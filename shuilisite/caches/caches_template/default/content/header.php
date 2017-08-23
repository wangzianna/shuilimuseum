<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
	<!--<![endif]-->
    <head>
		<!-- META TAGS -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
		<meta content="all" name="robots" />
		<meta name="author" content="" />
		<meta name="Copyright" content="" />
		<meta name="description" content="<?php echo $SEO['description'];?>" />
		<meta name="keywords" content="<?php echo $SEO['keyword'];?>" />

		<!-- Style Sheet-->
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>index.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>md.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>sm.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>xs.css">
    <script src="<?php echo JS_PATH;?>jquery.min.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script src="<?php echo JS_PATH;?>index.js"></script>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
                <script src="<?php echo JS_PATH;?>html5.js"></script></script>
                <![endif]-->

	</head>
 <script type="text/javascript">
    $(function () {
        if(!window.sessionStorage.getItem('app')){
            $('.download').css('display','block');
        }
        window.sessionStorage.setItem('app', '111');
        console.log(window.sessionStorage.getItem('app'));
        document.getElementById('openApp').onclick = function(e){
            if(isWeixinBrowser() || isQQBrowser()){
                console.log('aaaa');
                window.location = 'https://itunes.apple.com/cn/app/id477927812';
            }else{
                if(navigator.userAgent.match(/android/i)){
                    $('body').append("<iframe src='com.baidu.tieba://' style='display:none;' target='' ></iframe>");
                    //setTimeout(function () {
                        window.location = 'https://itunes.apple.com/cn/app/id477927812';
                   // },600)
                }else if(navigator.userAgent.match(/(iPhone|iPod|iPad);?/i)){
                    console.log('iphone');
//                    window.location.href = 'com.baidu.tieba://';
                   // setTimeout(function () {
                        window.location = 'https://itunes.apple.com/cn/app/id477927812';
                    //},2000)
                }

            }
        };
//        window.location.href = 'com.baidu.tieba://';
        var ua = navigator.userAgent.toLowerCase();//获取判断用的对象
        function isWeixinBrowser() {
            return (/micromessenger/.test(ua)) ? true : false;
        }

        function isQQBrowser() {
            return (ua.match(/QQ/i) == "qq") ? true : false;
        }
    })
</script>
<body>
	<div class="download">
    		<img class="fl" src="<?php echo IMG_PATH;?>jiaotong.png">
    		<div style="width:calc(100% - 175px);margin-left: 55px;">
        <p style="padding-top: 10px;font-size: 12px">下载中国水利博物馆APP</p>
        <p>随时随地，逛博物馆</p>
   		 </div>
   		 <a class="download-btn" id="openApp">下载App</a>
   		 <div class="close-download">×</div>
    </div>
 <!-- //导航 -->
<div id="header">
	<!--<script>
   $(function () {
       //导航
       $('.dropdown').mouseenter(function () {
           $(this).addClass('open');
       });
       $('.dropdown').mouseover(function () {
           $(this).addClass('open');
       });
       $('.dropdown').mouseleave(function () {
           $(this).removeClass('open');
       });
       $('.dropdown').mouseout(function () {
           $(this).removeClass('open');
       });
   })
</script>-->
<div class="top container-fluid">

        <div class="row my-header">
            <div class="container" style="position: relative;">
            <div class="my-header-logo">
                <img class="logo" src="<?php echo IMG_PATH;?>footer-logo.png">
                <img class="title" src="<?php echo IMG_PATH;?>title.png" alt="">
            </div>
            <div class="search">
                <input placeholder="全文检索">
                <img src="<?php echo IMG_PATH;?>search.png">
            </div>
         </div>
        </div>
    <div class="row banner">
        <div class="col-md-12 banner-item">
            <img src="<?php echo IMG_PATH;?>banner.png">
        </div>
    </div>
    <div class="row mobile-nav">
        <nav>
        	 	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b43f1459ac702900c8d44c91a5e796dd&action=category&catid=0&num=25&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
            <ul class="menu">
                <li class="menu-item">
                    <a href="<?php echo siteurl($siteid);?>">首页</a>
                </li>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><!--  一级栏目循环开始  -->
                <li class="menu-item">
                    <a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>
                </li>
                <?php $n++;}unset($n); ?>
              
            </ul>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </nav>
    </div>
    
</div>
<!--yangzi nav-->
	 <nav class="shuili-nav-wrap hidden-xs hidden-sm">
	    	  <div class="container">
	    	  	 <ul class="shuili-nav">
	    	  	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b43f1459ac702900c8d44c91a5e796dd&action=category&catid=0&num=25&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
	    	  	 	<li><a <?php if(empty($catid)) { ?>class="h-nav-current"<?php } ?> href="<?php echo siteurl($siteid);?>">首页</a></li>
	    	  	 	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><!--  一级栏目循环开始  -->
	    	  	 	<li><a <?php if($r['catid'] == $catid || $CATEGORYS[$CAT[parentid]][catid]==$r['catid']) { ?>class="h-nav-current" <?php } ?> href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>
	    	  	 	  <?php if($r[arrchildid]) { ?> <!--是否有子栏目-->
       	  	 		<ul class="sub-shuili-nav">
       	  	 			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=562eba0525a72e8a95a03bd7c7d4da01&action=category&catid=%24r%5Bcatid%5D&num=15&siteid=%24siteid&order=listorder+ASC&return=data2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data2 = $content_tag->category(array('catid'=>$r[catid],'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?>
	    	  	 			   <?php $n=1;if(is_array($data2)) foreach($data2 AS $v) { ?><!--子栏目循环开始-->
                        <li><a href="<?php echo $v['url'];?>"><?php echo $v['catname'];?></a></li>
                        <?php $n++;}unset($n); ?><!--子栏目循环结束-->
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	    	  	 		</ul>
	    	  	 	  <?php } ?>
	    	  	 	</li>
	    	  	  <?php $n++;}unset($n); ?><!--  一级栏目循环结束-->
          <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	    	  	 </ul>
	    	  </div>
	 </nav>
</div>