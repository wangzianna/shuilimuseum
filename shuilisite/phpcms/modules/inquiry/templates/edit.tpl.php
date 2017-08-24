<?php
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}}); 

	/*$("#test_name").formValidator({onshow:"",onfocus:""}).inputValidator({min:1,onerror:""}).ajaxValidator({type : "get",url : "",data :"m=link&c=link&a=public_name&linkid=<?php echo $linkid;?>",datatype : "html",async:'false',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "<?php echo L('link_name').L('exists')?>",onwait : "<?php echo L('connecting')?>"}).defaultPassed(); 

	$("#link_url").formValidator({onshow:"<?php echo L("input").L('url')?>",onfocus:"<?php echo L("input").L('url')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('url')?>"}).regexValidator({regexp:"^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&]*([^<>])*$",onerror:"<?php echo L('link_onerror')?>"})
	*/
	})
//-->
</script>

<div class="pad_10">
<form action="?m=mytest&c=mytest&a=edit" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="100"><?php echo '用户编号'?>：</th>
		<td><input type="text" name="test[id]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo '用户名'?>：</th>
		<td><input type="text" name="test[name]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo '用户年龄'?>：</th>
		<td><input type="text" name="test[age]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo '用户性别'?>：</th>
		<td><input type="text" name="test[sex]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo '用户EMAIL'?>：</th>
		<td><input type="text" name="test[email]" id="test_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr id="logolink">
		<th width="100">上传头像：</th>
		<td><?php echo form::images('test[logo]', 'logo', '', 'mytest')?></td>
	</tr>

<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?m=mytest&c=mytest&a=edit"> <input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value="修改"></td>
	</tr>

</table>
</form>
</div>
</body>
</html>

