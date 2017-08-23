<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="zjshb container content-detail">
    <a class="zhici" href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=10">
       <div class="zhichi-thumb hidden-xs"></div>
      <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=fff19ef6c42c309c64acbc1ddb449585&action=lists&catid=10&num=1&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'10','order'=>'id DESC','moreinfo'=>'1','limit'=>'1',));}?>
        <div class="zhici-detail" style="position: relative;">
        	<!--<div class="gengduo">
        		
        	</div>-->
        	   
            <h2  style="font-family: 'STFangsong';font-size: 24px;">
            	<span style="font-size: 40px;">馆</span>长致辞</h2>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <p class="f-thide4">
            	<!--馆长致辞-->  
           <?php echo str_cut(strip_tags($r['content']),550,'…');?>
            </p>
            <span class="pull-right"> 更多>> </span>
            <?php $n++;}unset($n); ?>
        </div>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </a>
    <div class="row sbgk-wrap">
    	   <div class="col-md-8 col-sm-5 col-xs-12 sbgk-l" >  	 	
    	   	 	<div class="sbgk">
    	   	 		<a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=11">
    	   				<figure class="smask">
    	   					<h2 class="zjsb-title">水博概况</h2>
    	   					<figcaption>中国水利博物馆综合了收藏、展陈、科普、宣传、教育、研究和交流等功能，核心展区分为水利千秋、水与人类铜浮雕展示和龙施雨沛三大部分。</figcaption>
    	   				</figure>
      				 <img src="<?php echo IMG_PATH;?>sbgk.png"/>
      			 </a>
      		  </div>     		
       </div>
       <div class="col-md-4 col-sm-4 col-xs-12 sbgk-r" >
       		 
       		 	<div class="sbgk">
       		 		<a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=12">
       		 		<figure class="smask" style="background: rgba(34,108,153,0.62);">
    	   				   <h2 class="zjsb-title">主要职能</h2>
    	   				   <figcaption>中国水利博物馆综合了收藏、展陈、科普、宣传、教育、研究和交流等功能。</figcaption>
    	   			    </figure>
             		<img src="<?php echo IMG_PATH;?>zyzz.png">
             		 </a>
             </div>
       </div>
    </div>
  <div class="row zzjg-warp" >
  	<div class="col-md-4 col-sm-4 col-xs-12 zzjg-l" >
       		 
       		 	<div class="sbgk">
       		 		<a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=13">
       		 		<figure class="smask" style="background: rgba(117,77,5,0.66);">
    	   				   <h2 class="zjsb-title">组织机构</h2>
    	   				   <figcaption>中国水利博物馆的核心展区分为水利千秋、水中万象和龙施雨沛三大部分。</figcaption>
    	   			    </figure>
             		<img src="<?php echo IMG_PATH;?>zyzz.png">
             		 </a>
             </div>
       </div>
    	   <div class="col-md-8 col-sm-5 col-xs-12 zzjg-r">  	 	
    	   	 	<div class="sbgk">
    	   	 		<a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=14">
    	   				<figure class="smask" style="background: rgba(117,77,5,0.66);">
    	   					<h2 class="zjsb-title">大事记</h2>
    	   					<figcaption>中国水利博物馆综合了收藏、展陈、科普、宣传、教育、研究和交流等功能，核心展区分为水利千秋、水与人类铜浮雕展示和龙施雨沛三大部分。</figcaption>
    	   				</figure>
      				 <img src="<?php echo IMG_PATH;?>dsj.png"/>
      			 </a>
      		  </div>     		
       </div>
       
 </div>

</div>

<?php include template("content","footer"); ?>