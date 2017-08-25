<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>

<div class="daguan container content-detail">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="breadcrumb2"><span><?php echo $CAT['catname'];?></span></div>       
        </div>
    </div>
   <div class="row hidden-xs">
   	<div class="col-md-3 col-sm-3" style="padding-right: 0;">
   		<div class="intro-l">
   		<h3>INTRO<br /><span>展览介绍</span></h3>
   		</div>
   	</div>
   	<div class="col-md-9 col-sm-9" style="padding-left: 0;">
   		<div class="intro-r"></div>
   	</div>
   </div>
     <div class="row slzl-wrap hidden-xs">
     	<div c class="col-md-6 col-sm-6">
     		<div class="sl-l">
     			<a href="">
     			<figure class="smask"  style="background: rgba(87,31,112,0.39);">
     				<h3 class="slqq-title">"水与人类文明”展区简介</h2>
     				<h3 class="f1"><img src="<?php echo IMG_PATH;?>F1.png" ></h3>
     			</figure>
     			<img src="<?php echo IMG_PATH;?>sl1.png"/>
     			</a>
     		</div>
     	</div>
     	<div c class="col-md-6 col-sm-6 slqq-r" >
     		<div class="sl-r">
     			<a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=15" >
     			<figure class="smask" style="background: rgba(161,125,19,0.53);">
     				<h3 class="slqq-title">“水利千秋”展区简介</h2>
     				<h3 class="f1"><img src="<?php echo IMG_PATH;?>F1.png" ></h3>
     			</figure>
     			<img src="<?php echo IMG_PATH;?>sl2.png"/>
     			</a>
     		</div>
     	</div>
     </div>
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <!--<h2>博物馆介绍</h2>-->
          <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9e794ce15ebef199a73121670160f8c6&action=lists&catid=15&num=4&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'15','order'=>'id DESC','moreinfo'=>'1','limit'=>'4',));}?>

            <ul class="list">
            	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list-item">
                    <a>
                        <span class="title f-thide"> <?php echo $r['title'];?></span>
                        <span class="time f-thide">[<?php echo date('Y-m-d',$r[inputtime]);?>]</span>
                    </a>
                </li>
               
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                <li class="list-item">
                    <a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=15">
                        <span class="time more dg-more">更多 >></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="open-time">
                <div class="point">展览指引</div>
                <p>开放日期：每周二至周日</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    （周一闭馆）</p>
                <p>开放时间：9:00 --- 16:30</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    （16点后停止入馆）</p>
            </div>
        </div>
    </div>
    <div class="row">
    	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=92b075780b3c432c4291a4398a5efe0f&action=lists&catid=16&num=3&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'16','order'=>'id DESC','moreinfo'=>'1','limit'=>'3',));}?>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="breadcrumb2">
                <span>藏品鉴赏</span>
                <a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=16" class="fr more">更多 >></a>
            </div>
           	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> 
            <a class="a-block" href="<?php echo $r['url'];?>">
	            	<div class="cp-box">
	               <img src="<?php echo $r['thumb'];?>">
	                <p><?php echo $r['title'];?></p>
	             </div>
            </a>
            <?php $n++;}unset($n); ?>  
        </div>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="breadcrumb2">
                <span>精彩视频</span>
               <a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=18" class="fr more">更多 >></a>
            </div>
            	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=bc14a5916bd7403535424579dad333fb&action=lists&catid=18&num=1&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'id DESC','moreinfo'=>'1','limit'=>'1',));}?>
            	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> 
            <a class="video-block" href="<?php echo $r['url'];?>">
                <img src="<?php echo $r['thumb'];?>">
                <div class="video-shade">
                    <div class="icon">
                        <div class="triangle-right"></div>
                    </div>
                </div>
            </a>
            <?php $n++;}unset($n); ?>
           <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="breadcrumb2">
                <span>图片集锦</span>
                <a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=17" class="fr more">更多 >></a>
            </div>
        </div>
        	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=556054685c5a68d1237c1ddc6e40c948&action=lists&catid=17&num=4&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'17','order'=>'id DESC','moreinfo'=>'1','limit'=>'4',));}?>
            	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> 
        <div class="col-md-3 col-sm-3 col-xs-6 a-block a-block2 pic-ollection" href="<?php echo $r['url'];?>">
           <img src="<?php echo $r['thumb'];?>">
            <p><?php echo $r['title'];?></p>
        </div>
          <?php $n++;}unset($n); ?>
          <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
</div>
<?php include template("content","footer"); ?>