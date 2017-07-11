<?php defined('IN_ADMIN') or exit('No permission resources.');?>
<?php include $this->admin_tpl('header', 'admin');?>
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li class="on" id="tab_1"><?php echo L('url_list')?></li>
</ul>
<div class="content pad-10" id="show_div_1" style="height:auto">
11111111
<b><?php echo L('url_list')?></b>：<?php echo $url_list;?><br><br>
<?php echo L('in_all')?>： <?php echo $total?> <?php echo L('all_count_msg')?>：<?php echo $re;?><?php echo L('import_num_msg')?><?php echo $total-$re;?>
<br><br>
<?php if (is_array($url))foreach ($url as $v):?>
<?php echo $v['title'].'<br>'.$v['url'];?>
<hr size="1" />
<?php endforeach;?>
<?php
if ($page<1) {
	echo "<script type='text/javascript'>location.href='?m=collection&c=autoNode&a=caijiList&page=".($page+1)."&nodeid=".$nodeid_[$_SESSION['nodeid']]."&pc_hash=".$_SESSION['pc_hash']."'</script>";
} else {
	if($_SESSION['nodeid']!=count($nodeid_)){
		$_SESSION['nodeid']=$_SESSION['nodeid']+1;
		echo "<script type='text/javascript'>location.href='?m=collection&c=autoNode&a=caijiList&page=0&nodeid=".$nodeid_[$_SESSION['nodeid']]."&pc_hash=".$_SESSION['pc_hash']."'</script>";
	}else{
		$_SESSION['nodeid']=0;
		echo "<script type='text/javascript'>location.href='?m=collection&c=autoNode&a=caijiCon&pc_hash=".$_SESSION['pc_hash']."'</script>";
	}
}
?>
</div>
</div>
</div>
</body>
</html>