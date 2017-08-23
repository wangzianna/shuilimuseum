<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="wenhua container content-detail">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<?php $j=1;?>
		<?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $v) { ?>
		<?php if($v['type']!=0) continue;?>
            <div class="breadcrumb2">
                <span><?php echo $v['catname'];?></span>
                <a href="<?php echo $v['url'];?>" class="fr more"> More >></a>
            </div>
            <ul class="list">
            	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=afe7854fdcafbc9fb42dd478c3d9aeef&action=lists&catid=%24v%5Bcatid%5D&num=8&order=id+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$v[catid],'order'=>'id DESC','limit'=>'8',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li class="list-item">
                    <a href="<?php echo $v['url'];?>">
                        <span class="title f-thide"> <?php echo $v['title'];?></span>
                        <span class="time f-thide">[<?php echo date('Y-m-d',$v[inputtime]);?>]</span>
                    </a>
                </li>
                   <?php $n++;}unset($n); ?>
            </ul>
             <?php if($j%2==0) { ?><div class="bk10"></div><?php } ?>
	       <?php $j++; ?>
	     <?php $n++;}unset($n); ?>
        </div>
        
        
       <!--侧面兄弟栏目-->
        <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top: 25px;">
        	
            <ul class="zjshb-tab">
               <?php if($top_parentid) { ?> 
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=894824ec88c3701696ad9d879ede6b1d&action=category&catid=%24top_parentid&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$top_parentid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?> 
		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a href="<?php echo $r['url'];?>">
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