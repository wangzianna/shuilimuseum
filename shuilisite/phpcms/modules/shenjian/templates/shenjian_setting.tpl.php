<?php
defined('IN_ADMIN') or exit('No permission resources.'); 
include $this->admin_tpl('header', 'admin');
?>

<div class="pad-10">
<form action="?m=shenjian&c=shenjian_admin&a=settings" method="post" id="myform">
<fieldset>
	<legend><?php echo L('shenjian_configuration')?></legend>
	<table width="100%"  class="table_form">
	<tr>
		<th width="120"><?php echo L('shenjian_version')?>:</th>
		<td class="y-bg">v1.0.0</td>
	</tr>
	<tr>
		<th width="120"><?php echo L('shenjian_web_url')?>:</th>
		<td class="y-bg"><input style="width:300px" type="input" disabled value="<?php echo APP_PATH ?>" /></td>
	</tr>
	<tr>
		<th width="120"><?php echo L('shenjian_web_password')?>:</th>
		<td class="y-bg"><input style="width:300px" type="input" name="web_password" value="<?php echo  isset($data['web_password']) ? $data['web_password'] : 'shenjianshou.cn'?>" /></td>
	</tr>
  <!--
    <tr>
    <th width="120"><?php echo L('shenjian_image_refer')?>:</th>
    <td class="y-bg"><input type="checkbox" name="image_refer" value="1" <?php if ($data['image_refer']){echo 'checked';}?> /></td>
  </tr>
  -->
</table>

<div class="bk15"></div>
<input type="submit" id="dosubmit" name="dosubmit" class="button" value="<?php echo L('submit')?>" />
</fieldset>
</form>
<div class="explain-col" style="margin-top:15px;">
<?php echo L('shenjian_notice')?>
</div>

</div>
</body>
</html>