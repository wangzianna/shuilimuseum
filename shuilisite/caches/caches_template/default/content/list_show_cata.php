<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="zixun container content-detail">
    <div class="row">
         <div class="col-md-9 col-sm-8 col-xs-12">	
            <div class="breadcrumb2">
                <span><?php echo $CAT['catname'];?></span>
            </div>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1710f3d16417ed0b29e44f90d4ace7d3&action=lists&catid=%24catid&num=1&order=id+DESC&page=%24page&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 1;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <div class="zjshb-nav-detail cb">
                <h2><?php echo $r['title'];?></h2>
                <h3 class="time"><?php echo date('Y-m-d',$r[inputtime]);?></h3>
                <div class="article-show">
                   <?php echo $r['content'];?>
               </div>
            </div>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
         <!--侧面兄弟栏目-->
        <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top: 25px;">
        	
            <ul class="zjshb-tab">
               <?php if($top_parentid) { ?>
		   <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=894824ec88c3701696ad9d879ede6b1d&action=category&catid=%24top_parentid&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$top_parentid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?>
		    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a  href="<?php echo $r['url'];?>">
		      		<?php echo $r['catname'];?>
					</a>
				</li>
			 <?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	    <?php } ?>
            </ul>
        </div>
    </div>

</div>
<?php include template("content","footer"); ?>