<?php
defined('IN_ADMIN') or exit('No permission resources. - guestbook_list.tpl.php');
$show_dialog = 1;
include $this->admin_tpl('header', 'admin');
?>

<form action="?m=inquiry&c=inquiry&a=delete" method="post" name="myform" id="myform">
<table border="0" width="100%">
	<tr>
		<th><input type="checkbox" /></th>
		<th>标题</th>
		<th>内容</th>
		<th>姓名</th>
		<th>发表时间</th>
		<th>Status</th>
		<th>管理操作</th>
	</tr>
	<?php
	if(is_array($infos)){
	foreach($infos as $info){
	?>
	<tr>
		<td align="center" width="35"><input type="checkbox" name="ids[]" value="<?php echo $info['id']?>"></td><!-- 多选按钮 -->
		<td align="center"><?php echo $info['title']?></td>
		<td align="center" width="30%"><?php echo $info['content']?></td>
		<td align="center" width="100"><?php echo $info['name'];?></td>
		<td align="center" width="120"><?php echo date('Y-m-d H:i:s',$info['created_at']);?></td>
		<td align="center" width="10%">
			<?php if($info['status'] == 'unread'){echo '<font color=red>Unread</font>';} else {echo 'Read';}?>
		</td>
		<td align="center" width="12%"><!-- 管理操作 -->
		<?php if($info['status'] === 'unread') { ?>
		<a href="?m=inquiry&c=inquiry&a=read&inquiry_id=<?php echo $info['id']; ?>" title="Read">Read</a> |
		<?php } ?>
		<a href='?m=inquiry&c=inquiry&a=delete&inquiry_id=<?php echo $info['id']?>'
		 onClick="return confirm('<?php echo L('confirm', array('message' => new_addslashes($info['title'])))?>')">
		 <?php echo L('删除')?>
		</a>
		</td>
	</tr>
	<?php } } ?>
</table>
<br />&nbsp;&nbsp;
<input type="submit" name="dosubmit" id="dosubmit" value="<?php echo L('删除留言')?>" />
</form>