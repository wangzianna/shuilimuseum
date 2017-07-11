<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<style type="text/css">
	.index_side{margin-bottom: 20px;}
	.index-post-meta{padding:10px 0 10px;}
	.category{padding-left: 20px;}
	.zt-img{position: relative;overflow: hidden;}
	.zt-img img{transition: ease-in-out .8s;}
	.zt-img:hover img{transform: scale(1.2);transition: ease-in-out 1.5s;opacity: 0.8;}
	.zt-img figure{position: absolute;width: 100%;height: 25%;left: 0;right: 0;bottom: 0;background: rgba(0,0,0,.4);z-index: 9;margin: 0;line-height:60px;padding: 15px;}
	.zt-img figure a{font-size: 25px;color: #fff;z-index: 10;margin: 25px 0 0;font-weight: 600;}
	hr{   
   margin: 11px 0;
    border: 0;
    border-top: 3px solid #b94a48;
   
    }
    .index-side-news{margin-bottom: 20px;}
</style>




<!-- Start of Page Container -->
<div class="page-container">
	<div class="container">
		<div class="row">
			<!-- start of page content -->
			<div class="span8 page-content">
             
     
             
				<!-- Basic Home Page Template -->
				<div class="row separator">

					<section class="span4 articles-list">
						<h3>热门企业文章排行</h3>
						<ul class="articles">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8a348902c93efbc1af1b74954ab71f89&action=lists&catid=40&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'40','order'=>'listorder DESC','limit'=>'5',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                          <li class="article-entry standard">
                          	<?php echo $CATEGORYS[$catid]['catname'];?> 
								<h4><a href="<?php echo $r['url'];?>"><?php echo str_cut(strip_tags($r[title]),80);?></a></h4>
								<span class="article-meta"><?php echo date('Y-m-d H:i:s',$r[inputtime]);?><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=59" target="_blank" >  <?php echo $CATEGORYS[$catid]['catname'];?> 企业频道</a></span>
							<!--	<span class="like-count" id="hits"><?php echo $views;?></span>-->
							</li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</section>

					<section class="span4 articles-list">
						<h3>江苏热门文章排行</h3>
						<ul class="articles">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dfc2f956907a80873bfda6a5a141adf8&action=lists&catid=45&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'45','order'=>'listorder DESC','limit'=>'5',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						 <li class="article-entry standard">
								<h4><a href="<?php echo $r['url'];?>"><?php echo str_cut(strip_tags($r[title]),80);?></a></h4>
								<span class="article-meta"><?php echo date('Y-m-d H:i:s',$r[inputtime]);?> <a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=46" target="_blank">江苏频道</a></span>
								<!--<span class="like-count" id="hits"><?php echo $views;?></span>-->
							</li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</section>
				</div>
               		<!-- start of page content列表新闻 -->
			<div class="main-listing">
		<!--测试只取有图的文章-->
				
   		 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d0d638dd979f91f3521966ab7b325b07&action=lists&catid=61&order=listorder+DESC&num=10&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'61','order'=>'listorder DESC','mroeinfo'=>'1','limit'=>'10',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($r[thumb]!="") { ?>//判断缩略图字段不为空则显示
				<article class="format-standard type-post hentry clearfix">
                     <div class="thumb_pic pull-left hidden-xs"   style="width: 220px;height: 180px;overflow: hidden;padding: 10px 0 0;">
                         	<img src="<?php echo $r['thumb'];?>" width="220px" height="180px">
                     </div>
					<header class="pull-left thumb-list" style="width: calc(100% - 260px);margin-left: 10px;">
						<h3 class="post-title">
                              <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?>[图]</a>
                        </h3>                       
                        <p><?php echo str_cut(strip_tags($r[description]),800);?>..						
					    </p>		    
						<div class="index-post-meta">
							<span class="date"><?php echo date('Y-m-d H:i:s',$r[inputtime]);?></span>
							<span class="category"><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=62" target="_blank">创业频道 </a></span>
							<a class="pull-right" href="<?php echo $r['url'];?>"> 查看更多 >> </a>
						</div>
					</header> 					
				</article>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               </div>
             <!--  专题图-->
               <div class="zhuanti">
               	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=937b741d14cdb9efc466a770be4d21ac&action=position&posid=18&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'18','thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <div class="zt-img">
                	   <figure>
                	   	<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a>
                	   </figure>
                	  <a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" style="display: block;max-width: 100%;"></a> 
                </div>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               </div>
           <!--over of newslists-->
				<div class="row home-category-list-area" style="padding-top:30px">
					<div class="span8">
						<h2>江苏热线频道</h2>
					</div>
				</div>
  
				<div class="row-fluid top-cats">

					<section class="span4">
						<h4 class="category"><a href="#">财经新闻</a></h4>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2dbc17a4736344cab8651a6b79a50c06&action=lists&catid=41&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'41','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
						 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="category-description">
							<h5><?php echo $r['title'];?></h5>
							<p><?php echo str_cut(strip_tags($r[description]),500);?></p>
						</div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</section>

					<section class="span4">
						<h4 class="category"><a href="#">科技新闻</a></h4>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2dbc17a4736344cab8651a6b79a50c06&action=lists&catid=41&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'41','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
						 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="category-description">
							<h5><?php echo $r['title'];?></h5>
							<p><?php echo str_cut(strip_tags($r[description]),500);?></p>
						</div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</section>

					<section class="span4">
						<h4 class="category"><a href="#">游戏频道</a></h4>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e2f4558365aebd6ca253c9d4581a5643&action=lists&catid=44&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'44','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
						 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="category-description">
							<h5><?php echo $r['title'];?></h5>
							<p><?php echo str_cut(strip_tags($r[description]),500);?></p>
						</div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</section>
				</div>
				<div class="row-fluid top-cats">

					<section class="span4">
						<h4 class="category"><a href="#">生活频道</a></h4>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d4337fcfd69ff16be9b029ad2daa90f6&action=lists&catid=42&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'42','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
						 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="category-description">
							<h5><?php echo $r['title'];?></h5>
							<p><?php echo str_cut(strip_tags($r[description]),500);?></p>
						</div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</section>

					<section class="span4">
						<h4 class="category"><a href="#">创业频道</a></h4>
                        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=806740f84a6e35fbe0a1d6d4bb81e5bc&action=lists&catid=62&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'62','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
						 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="category-description">
							<h5><?php echo $r['title'];?></h5>
							<p><?php echo str_cut(strip_tags($r[description]),500);?></p>
						</div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</section>

					<section class="span4">
						<h4 class="category"><a href="#">新能源频道</a></h4>
                        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7a4653ae443d9f33f55c62f3b8024231&action=lists&catid=75&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'75','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
						 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="category-description">
							<h5><?php echo $r['title'];?></h5>
							<p><?php echo str_cut(strip_tags($r[description]),500);?></p>
						</div>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</section>
				</div>
     		<!-- start of page content列表新闻 -->
     newslists------------->>>>>>>>
			<div class="main-listing">            
   				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f00877576ad98c4e787090e9e861040b&action=lists&catid=61&num=20&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'61','order'=>'id DESC','moreinfo'=>'1','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <?php if($r[thumb]!="") { ?>//判断缩略图字段不为空则显示
				<article class="format-standard type-post hentry clearfix">
                     <div class="thumb_pic pull-left hidden-xs"   style="width: 220px;height: 180px;overflow: hidden;padding: 10px 0 0;">
                         	<img src="<?php echo $r['thumb'];?>" width="220px" height="180px">
                     </div>
					<header class="pull-left thumb-list" style="width: calc(100% - 260px);margin-left: 10px;">
						<h3 class="post-title">
                              <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                        </h3>                       
                        <p><?php echo str_cut(strip_tags($r[description]),800);?>..						
					    </p>		    
						<div class="index-post-meta">
							<span class="date"><?php echo date('Y-m-d H:i:s',$r[inputtime]);?></span>
							<span class="category"><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=62" target="_blank">创业频道 </a></span>
							<a class="pull-right" href="<?php echo $r['url'];?>"> 查看更多 >> </a>
						</div>
					</header> 					
				</article>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               </div>
			</div>
			<!-- end of page content -->
          <!--start首页右侧图片新闻-->
		
			<aside class="span4 page-sidebar">
   				<section class="widget" style="overflow: hidden;">
   			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=658a9fdf4a8363bbbc439288cbf6b7f6&action=position&posid=1&thumb=1&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','thumb'=>'1','order'=>'listorder DESC','limit'=>'3',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <div class="index-side-news">
			    <div class="zt-img">
                	   <figure>
                	   	<a href="<?php echo $r['url'];?>" target="_blank" style="font-size: 14px;"><?php echo $r['title'];?></a>
                	   </figure>
                	  <a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" style="display: block;max-width: 100%;"></a> 
                </div>
               </div>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</section>
				<section class="widget">
					<div class="support-widget">
						<h3 class="title">Support</h3>
						<p class="intro">Need more support? If you did not found an answer, contact us for further help.</p>
					</div>
				</section>
	         <!--最新新闻-->
                 <section class="widget">
                 	<hr>
					<h3 class="title" style="text-align: center;">7x24要闻</h3>
					<ul class="articles">
					
         		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=495e38007e3accc6bcbf8159e80684ea&sql=SELECT+%2A+FROM+%60ds_news%60+Order+by+id+DESC+&num=16\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM `ds_news` Order by id DESC  LIMIT 16");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="article-entry standard">
							<h4><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></h4>
							<span class="article-meta"><?php echo date('Y-m-d',$r[inputtime]);?> 位于<a href="<?php echo $CAT['url'];?>">   <?php echo $CAT['catname'];?></a></span>
							<span class="like-count">66</span>
						</li>
						<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</section>
				<section class="widget" style="margin-top: 20px;">
				
					<div class="quick-links-widget">
						<h3 class="title pull-left">友情链接</h3>
						<a class="btn pull-right" href="<?php echo APP_PATH;?>index.php?m=link&c=index&a=register&siteid=<?php echo $siteid;?>">申请链接</a>
						<div class="clearfix"></div>
						<ul id="menu-quick-links" class="menu clearfix">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=99c32cd273c57223c20074bf5196e97a&action=type_list&siteid=%24siteid&order=listorder+DESC&num=10&return=dat\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$dat = $link_tag->type_list(array('siteid'=>$siteid,'order'=>'listorder DESC','limit'=>'10',));}?>
				<?php $n=1;if(is_array($dat)) foreach($dat AS $v) { ?>
				<?php if($type==0) { ?>
							<li>
								<a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['name'];?></a> 
							</li>
							<?php } else { ?>
							<li>
								<a href="<?php echo $v['url'];?>" target="_blank"><img src="<?php echo $v['logo'];?>" width="88" height="31" ></a>
							</li>
							<?php } ?>
						<?php $n++;}unset($n); ?>
                       <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</section>
				<section class="widget"   style="display: none;">
					<h3 class="title">Tags</h3>
					<div class="tagcloud">
						<a href="#" class="btn btn-mini">basic</a>
						<a href="#" class="btn btn-mini">beginner</a>
						<a href="#" class="btn btn-mini">blogging</a>
						<a href="#" class="btn btn-mini">colour</a>
						<a href="#" class="btn btn-mini">css</a>
						<a href="#" class="btn btn-mini">date</a>
						<a href="#" class="btn btn-mini">design</a>
						<a href="#" class="btn btn-mini">files</a>
						<a href="#" class="btn btn-mini">format</a>
						<a href="#" class="btn btn-mini">header</a>
						<a href="#" class="btn btn-mini">images</a>
						<a href="#" class="btn btn-mini">plugins</a>
						<a href="#" class="btn btn-mini">setting</a>
						<a href="#" class="btn btn-mini">templates</a>
						<a href="#" class="btn btn-mini">theme</a>
						<a href="#" class="btn btn-mini">time</a>
						<a href="#" class="btn btn-mini">videos</a>
						<a href="#" class="btn btn-mini">website</a>
						<a href="#" class="btn btn-mini">wordpress</a>
					</div>
				</section>

			</aside>
			<!-- end of sidebar -->
		</div>
	</div>
</div>
<!-- End of Page Container -->

</html>

<?php include template("content","footer"); ?>