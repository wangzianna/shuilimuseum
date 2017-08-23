<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="zixun container content-detail">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="zjshb-nav fl"><?php echo $CAT['catname'];?></div>
        <div class="zjshb-sub-nav"> </div>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=634e4a7fa91f9ab1704eff442baf6ded&action=lists&catid=%24catid&order=id+DESC&page=%24page&moreinfo=1&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 8;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?> 
            <ul class="list2 cb">
            	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list2-item">
                    <img src="<?php echo thumb($r[thumb],250,130);?>">
                    <h2 class="f-thide"><?php echo $r['title'];?> </h2>
                    <p class="f-thide2"><?php echo str_cut(strip_tags($r[description]),500);?></p>
                    <a href="<?php echo $r['url'];?>">更多 >></a>
                </li>
            <?php $n++;}unset($n); ?>
            </ul>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
             <nav class="pagination">
                <ul>
                   <?php echo $pages;?>
                </ul>
            </nav>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="breadcrumb2">
                <span>重要资讯</span>
            </div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8c85a3416de04847f5dae09a54c2cfc1&action=hits&catid=%24catid&num=2&order=views+DESC&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'order'=>'views DESC',)).'8c85a3416de04847f5dae09a54c2cfc1');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'views DESC','limit'=>'2',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <div class="important-info">
                <img src="<?php echo $v['thumb'];?>" >
                <div class="info-time">
                    <p class="month"><?php echo date('m',$v[inputtime]);?> 月</p>
                    <p class="date"><?php echo date('d',$v[inputtime]);?> 日</p>
                </div>
                <div class="info-title f-thide3">
                	<a href="<?php echo $v['url'];?>" style="color: #666666;">
                   <?php echo str_cut(strip_tags($v[description]),300);?>
                   </a>
                </div>
            </div>
            <?php $n++;}unset($n); ?>

<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>

</div>
<?php include template("content","footer"); ?>