<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');?>
<table width="100%" cellpadding="0" cellspacing="1" class="table_form">

	<tr>
		<th width="200"><?php echo dxc_lang('connect_api_key')?>: </th>
		<td><?php echo $api_key; ?>       <a style="margin-left:15px;" href="?m=dxc_api&c=dxc_api&is_force=1"><?php echo dxc_lang('re_create'); ?></a></td>
	</tr>

    <tr>
		<th width="200"></th>
        <td><?php echo dxc_lang('connect_api_key_desc')?></td>
	</tr>

    <tr>
		<th width="200"><?php echo dxc_lang('contact_us')?>: </th>
		<td><?php echo dxc_lang('dxc_bbs_type')?> </td>
	</tr>

    <tr>
		<th width="200"></th>
		<td><?php echo dxc_lang('dxc_qq_type')?> </td>
	</tr>


</table>
</body>
</html>
