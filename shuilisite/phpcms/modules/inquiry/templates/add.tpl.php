<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	$("#test_name").formValidator({onshow:"请输入用户名",onfocus:"请正确输入用户名"}).inputValidator({min:1,onerror:"<?php echo "输入用户名不少于三个字"?>"});
 /*	$("#link_url").formValidator({onshow:"<?php echo L("input").L('url')?>",onfocus:"<?php echo L("input").L('url')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('url')?>"}).regexValidator({regexp:"^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&]*([^<>])*$",onerror:"<?php echo L('link_onerror')?>"})
	*/ 
	})
//-->
</script>

<div class="pad_10">
<form action="?m=time&c=time&a=add" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="100"><?php echo '姓名'?>：</th>
		<td><input type="text" name="form_test_ques[name1]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo '性别'?>：</th>
		<td><input type="text" name="form_test_ques[sex]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo '问题'?>：</th>
		<td><input type="text" name="form_test_ques[question]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?m=time&c=time&a=add"> <input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" 添加"></td>
	</tr>

</table>
</form>
</div>
</body>
</html> 