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
		<title>搜索——中国水利博物馆<?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
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
 <style type="text/css">
 	.search input{width: 500px;}
 	.result{padding: 10px 15px;background: #fff;}
 	.l li{height: 40px;background: #F6F5F3;line-height: 40px;padding: 0 15px;list-style: none;border-bottom: 1px solid #efefef;margin-bottom: 5px;}
    .resullist>div{padding: 0 5px;overflow: hidden;}
    .resullist{padding: 25px 0;list-style: none;border-bottom: 1px solid #f0eadc;}
    .resulttype{height: 40px;line-height: 40px;border-left: 3px solid #C09853; padding: 0 15px;margin-top: 10px;
               background: #EFE9DB;
    }
    .l li a{color: #333;}
    
    @media only screen and (min-width: 320px) and (max-width: 640px) {
    	
    }
    	.search input { max-width: 300px !important;}

    	
    }
 </style>
<body>
	
 <!-- //导航 -->
<div id="header">
<div class="top container-fluid">
        <div class="row my-header">
            <div class="container" style="position: relative;">
            <div class="my-header-logo">
               <a href="<?php echo siteurl($siteid);?>/index.php"> 
               	<img class="logo" src="<?php echo IMG_PATH;?>shuililogo.png">
                <img class="title" src="<?php echo IMG_PATH;?>title.png" alt="">
                </a>
            </div>
 
 
 	<div class="search">
						<form name="search" type="get">
                        <div class="sr_frmipt">
						  <input type="hidden" name="m" value="search"/>
						  <input type="hidden" name="c" value="index"/>
						  <input type="hidden" name="a" value="init"/>
						  <input type="hidden" name="typeid" value="<?php echo $typeid;?>" id="typeid"/>
						  <input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid"/>
						<input type="text" name="q" class="ipt" id="q" value="<?php echo $search_q;?>">
<!--						<div class="sp" id="aca">▼</div>
-->						<input type="submit" class="ss_btn" value="  " style="padding: 0;width: 30px;height:30px;border: none;background: transparent;right: 10px;z-index: 999;position: absolute;top: 3px;"> <img src="<?php echo IMG_PATH;?>search.png"></div>
						</form>
						<div id="sr_infos" class="wrap sr_infoul">
						</div>
    </div>

<!-- 搜索框结束 -->


            
            
            <!--<div class="search" id="search">
                <input placeholder="全文检索">
                <img src="<?php echo IMG_PATH;?>search.png">
            </div>-->
         </div>
        </div>
   
   
    
</div>
<!--yangzi nav-->
	 <nav class="shuili-nav-wrap hidden-xs hidden-sm">
	    	  
	 </nav>
</div>
