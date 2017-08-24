<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="zixun container content-detail"  style="padding-bottom: 100px !important;">
	<div class="row">
		<div class="col-md-9 col-sm-8 col-xs-12">
			<div class="breadcrumb2">
				<span><?php echo $CAT['catname'];?></span>
			</div>
			<div class="zjshb-nav-detail cb col-md-8 col-md-offset-2">

				<div class="article-show">
					<form action="<?php echo APP_PATH;?>index.php?m=inquiry&c=index&a=send&siteid=<?php echo SITEID;?>" method="post" class="form-horizontal" role="form">
						<input type="hidden" name="dosubmit" value="1">
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input name="title" type="text" class="form-control" id="title" placeholder="Inquiry regarding to...">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">名字</label>
							<div class="col-sm-10">
								<input name="name" type="text" class="form-control" id="name" placeholder="请输入名字">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input name="email" type="text" class="form-control" id="email" placeholder="email@example.com">
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-10">
								<input name="phone" type="text" class="form-control" id="phone">
							</div>
						</div>
						<div class="form-group">
							<label for="content" class="text-left col-sm-2 control-label">您的建议</label>
							<div class="col-sm-10">
								<textarea name="content" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-10  col-md-offset-2">
								<button type="submit" class="btn btn-default btn-primary" style="padding: 8px 25px;">Send</button>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>
		<!--侧面兄弟栏目-->
		<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top: 5px;">

			<ul class="zjshb-tab">
				<?php if($top_parentid) { ?> <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=894824ec88c3701696ad9d879ede6b1d&action=category&catid=%24top_parentid&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$top_parentid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a href="<?php echo $r['url'];?>">
						<?php echo $r['catname'];?>
					</a>
				</li>
				<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> <?php } ?>
			</ul>
		</div>
	</div>

</div>




<!------------------>

<?php include template("content","footer"); ?>