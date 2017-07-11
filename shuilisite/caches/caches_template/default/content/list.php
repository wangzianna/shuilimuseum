<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<style type="text/css">
	.hentry .post-meta{border: none;}
</style>
<div class="top_banner">

</div>
<!-- Start of Page Container -->
<div class="page-container">
	<div class="container">
		<div class="row">

			<!-- start of page content -->
			<div class="span8 main-listing">
              <ul class="breadcrumb">
					<li>
						<a href="#">首页</a><span class="divider">/</span>   
						<a href="#"><?php echo $CATEGORYS[$CAT['parentid']]['catname'];?></a><span class="divider">/</span>
						<a href="#"><?php echo $CAT['catname'];?></a> <span class="divider"></span>
					</li>
		
				</ul>

   			<!--以上是目标位置-->

   				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7d2b277394f88a88944e67e14b13f62b&action=lists&catid=%24catid&num=20&order=id+DESC&page=%24page&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 20;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<article class="format-standard type-post hentry clearfix" style="border-bottom: 1px solid #efefef;padding: 10px 0 10px;">

					<header class="clearfix">

						<h3 class="post-title">
                              <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                         </h3>
                       
						<div class="post-meta clearfix">
							<span class="date"><?php echo date('Y-m-d H:i:s',$r[inputtime]);?></span>
							<span class="category"><a href="<?php echo $CAT['url'];?>" title="<?php echo $CAT['catname'];?>">  <?php echo $CAT['catname'];?></a></span>
							<span class="like-count">66</span>
						</div>
						<!-- end of post meta -->

					</header>
					<img src="<?php echo $r['thumb'];?>"/ style="max-width: 350px;max-height:400px;padding: 10px 0 15px;">
					<div class="descrition">
 					<p><?php echo str_cut(strip_tags($r[description]),800);?>..
						<a class="readmore-link pull-right btn-mini" href="<?php echo $r['url'];?>"> 查看更多 >> </a>
					</p>
					</div>
				</article>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			

      			  <!--分页-->

				<div id="pagination">
					<?php echo $pages;?>
				</div>

			</div>
			<!-- end of page content -->

				<!-- start of sidebar -->
			<aside class="span4 page-sidebar">

				<section class="widget">
					<div class="support-widget">
						<h3 class="title">Support</h3>
						<p class="intro">Need more support? If you did not found an answer, contact us for further help.</p>
					</div>
				</section>

				<section class="widget">
					<h3 class="title">相关文章</h3>
					<ul class="articles">
						 <ul>

					 <?php if($top_parentid) { ?>
				   <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=59d06cce678bb72ce41ff4957c8abe3c&action=lists&catid=%24top_parentid&num=8&siteid=%24siteid&order=listorder+ASC&moreifo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$top_parentid,'siteid'=>$siteid,'order'=>'listorder ASC','moreifo'=>'1','limit'=>'8',));}?>
				    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="article-entry standard">
							<h4><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></h4>
							<span class="article-meta"><?php echo date('Y-m-d',$r[inputtime]);?> 位于<a href="<?php echo $CAT['url'];?>"> <?php echo $CATEGORYS[$r['catid']]['catname'];?></a></span>
							<!--<span class="like-count">66</span>-->
						</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					  <?php } ?>
					</ul>
				</section>

				<section class="widget">
					<h3 class="title">相关频道</h3>
					<ul>
						<?php if($top_parentid) { ?> 
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=58c700314db24da8ef3f19a6e5e753b5&action=category&catid=%24top_parentid&num=25&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$top_parentid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?> 
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li>
								<a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>
							</li>
							<?php $n++;}unset($n); ?>
						 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
						 <?php } ?>
					
					</ul>
				</section>
                <section class="widget">
					<h3 class="title">最热文章</h3>
					<ul class="articles">
					
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=18115730706a52773942d6c98cdf7cbc&action=hits&catid=%24r%5Bcatid%5D&num=8&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$r[catid],'order'=>'views DESC','limit'=>'8',));}?>
                       <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="article-entry standard">
							<h4><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></h4>
							<span class="article-meta"><?php echo date('Y-m-d',$r[inputtime]);?> 位于<a href="<?php echo $CAT['url'];?>">   <?php echo $CAT['catname'];?></a></span>
							<!--<span class="like-count">66</span>-->
						</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					
					</ul>
				</section>
				

			</aside>
			<!-- end of sidebar -->
		</div>
	</div>
</div>
<!-- End of Page Container -->

<?php include template("content","footer"); ?>