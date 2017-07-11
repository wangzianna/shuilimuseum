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
		<meta name="author" content="江苏热线版权所有" />
		<meta name="Copyright" content="江苏热线版权所有" />
		<meta name="description" content="<?php echo $SEO['description'];?>" />
		<meta name="keywords" content="<?php echo $SEO['keyword'];?>" />

		<!-- Style Sheet-->
		<link rel="stylesheet" href="<?php echo CSS_PATH;?>style.css" />
		<link rel='stylesheet' id='bootstrap-css-css' href='<?php echo CSS_PATH;?>bootstrap5152.css' type='text/css' media='all' />
		<link rel='stylesheet' id='responsive-css-css' href='<?php echo CSS_PATH;?>responsive5152.css' type='text/css' media='all' />
		<link rel='stylesheet' id='pretty-photo-css-css' href='<?php echo JS_PATH;?>prettyphoto/prettyPhotoaeb9.css' type='text/css' media='all' />
		<link rel='stylesheet' id='main-css-css' href='<?php echo CSS_PATH;?>main5152.css' type='text/css' media='all' />
		<link rel='stylesheet' id='custom-css-css' href='<?php echo CSS_PATH;?>custom5152.html' type='text/css' media='all' />

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
                <script src="<?php echo JS_PATH;?>html5.js"></script></script>
                <![endif]-->

	</head>
   <style type="text/css">
   	.sub_header{ border-top: 2px #f34540 solid;border-bottom: 1px #eee solid;}
   	.sub_header ul{margin: 0;padding:10px 0 10px;}
   	.sub_header ul li{display: inline-block; vertical-align: middle;}
   	.sub_header ul li a{font-size: 16px;padding: 0 20px 0;text-align: left;}
   	.sub_header ul li span{font-size: inherit; color: #ccc;}
   	.sub_header ul li:hover a{color: #f34540;}
   	.main-listing article.hentry:hover{background: #fffcf5;}
   	 #pagination{margin:30px 0 10px;clear: both;}
    #pagination a{padding: 5px 12px 5px; border: 1px solid #e4e4e4; border-radius: 3px;}
     #pagination span {padding: 6px 15px 6px;  background: #f34540 ; color: #fff; border-radius: 3px;}
   </style>
	<body>

		<!-- Start of Header -->
		<div class="header-wrapper" style=" background-color: #a90b08 !important;">
			<header>
				<div class="container">

					<div class="logo-container">
						<!-- Website Logo -->
					   <a href="<?php echo siteurl($siteid);?>/index.php"> 
							<h3 class="pull-left" style="color: #fff;margin: 0;font-weight: 300;">江苏热线 | <span class="tag-line">  江苏 · 中国 · 世界</span></h3>
						</a>
						
					</div>

					<!-- Start of Main Navigation -->
					<nav class="main-nav">
						<div class="menu-top-menu-container">
							<ul id="menu-top-menu" class="clearfix">
							
							<li> 
								<a href="<?php echo siteurl($siteid);?>/index.php"> 
								首页
							</a>
							</li>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4a9cf831215d6bd6f4e616a77311ca1a&action=category&catid=0&num=25&siteid=%24siteid&order=listorder+ASC&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
                    <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
					    <li>
					    <!--注释1:一级栏目直接跳转到第一个子栏目-->
					       <?php if(count(subcat($v[catid])) > 0 && $r[modelid ] == 0) { ?>
					        <!--获取第一个子类的 url 字段值-->
					        <?php $zi_arr = explode(',',$v[arrchildid])?>
					         <?php $url = $CATEGORYS[$zi_arr[1]][url]?>
					         <!--否则直接得到当前的url-->
					         <?php } else { ?>
					         <?php $url  = $v[url]?>
					        <?php } ?>
					     <!--注释1结束-->
					     <!--一级栏目-->
					        <a href="<?php echo $url;?>"><?php echo $v['catname'];?></a>
					     <!--注释2:一级栏目没有子栏目时，不出现下拉菜单-->
								<?php $f=false?>
					            <?php $n=1;if(is_array(subcat($v[catid]))) foreach(subcat($v[catid]) AS $vv) { ?>
					             <?php if($vv[catname]!="") { ?>
					             <?php $f=true?>
					             <?php } ?>        
					             <?php if(true) { ?>
					       <!--二级栏目--> 
						         <ul class="sub-menu">
								    <?php $n=1;if(is_array(subcat($v[catid]))) foreach(subcat($v[catid]) AS $vv) { ?>
						             <li><a href="<?php echo $vv['url'];?>"><?php echo $vv['catname'];?></a></li>
						            <?php $n++;}unset($n); ?>									
								  </ul>	
								  <?php } ?>
						   <!--注释2结束-->
						      <?php $n++;}unset($n); ?>  
						   </li>
							<?php $n++;}unset($n); ?>
		 				 
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
					</nav>
					<!-- End of Main Navigation -->

				</div>
			</header>
		</div>
		<!-- End of Header -->
			
	
		<!-- Start of Search Wrapper -->
		<div class="container">
			<img src="<?php echo IMG_PATH;?>ad.png"/ style="width: 100%;">
		</div>
 	<!-- 地区导航start-->
     <div class="jrrxlogo container">
        <a href="<?php echo siteurl($siteid);?>/index.php"> 
     	<img src="<?php echo IMG_PATH;?>jslogo.png"/ width="350px" style="margin:10px auto 10px">
     	</a>
     </div>
	 <div class="sub_header">
	 	<div class="container">
	 		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=889ee486fc195d7943ef7c8c6a2091d9&action=category&catid=45&num=25&siteid=%24siteid&order=listorder+ASC&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'45','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
                   
	 		<ul>
	 			 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
	 			<li><a href="<?php echo $v['url'];?>"><?php echo $v['catname'];?></a> <span>/</span></li>
	 			<?php $n++;}unset($n); ?>
	 		</ul>
	 		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	 	</div>
 </div>



<!-- End of Search Wrapper -->