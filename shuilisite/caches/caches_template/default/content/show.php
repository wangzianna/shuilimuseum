<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="zixun-article container content-detail">
    <div class="row" style="padding: 0 15px;">
        <div class="col-md-9 col-sm-8 col-xs-12">
            <div class="breadcrumb2">
                <span><?php echo $CAT['catname'];?></span>
            </div>
            <div class="zjshb-nav-detail cb">
                <h2><?php echo $title;?></h2>
                <h3 class="time"><?php echo $r['inputtime'];?></h3>
                <div class="article-show">
                   <?php echo $content;?>
               </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="breadcrumb2">
                <span>相关文章</span>
            </div>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7d2b277394f88a88944e67e14b13f62b&action=lists&catid=%24catid&num=20&order=id+DESC&page=%24page&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 20;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
            <ul class="list">
            	 	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list-item">
                    <a href="<?php echo $r['url'];?>">
                        >
                        <span class="title f-thide"> <?php echo $r['title'];?></span>
                    </a>
                </li>
                  <?php $n++;}unset($n); ?>  
            </ul>
             <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>

</div>

<?php include template("content","footer"); ?>