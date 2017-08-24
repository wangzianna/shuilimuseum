<?php
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}}); 

	$("#form_test_name").formValidator({onshow:"<?php echo L("input").L('link_name')?>",onfocus:"<?php echo L("input").L('link_name')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('link_name')?>"}).ajaxValidator({type : "get",url : "",data :"m=link&c=link&a=public_name&linkid=<?php echo $linkid;?>",datatype : "html",async:'false',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "<?php echo L('link_name').L('exists')?>",onwait : "<?php echo L('connecting')?>"}).defaultPassed(); 

/*	$("#link_url").formValidator({onshow:"<?php echo L("input").L('url')?>",onfocus:"<?php echo L("input").L('url')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('url')?>"}).regexValidator({regexp:"^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&]*([^<>])*$",onerror:"<?php echo L('link_onerror')?>"})
	*/
	})
//-->
</script>

<div class="pad_10">
<form action="?m=time&c=time&a=edit&dataid=<?php echo $dataid; ?>" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
	
	<tr>
		<th width="100">姓名：</th>
		<td><input type="text" name="form_test_ques[name1]" id="test_name"
			size="30" class="input-text" value="<?php echo $name1;?>"></td>
	</tr>
	
	<tr>
		<th width="100">邮件：</th>
		<td><input type="text" name="form_test_ques[sex]" id="test_name"
			size="30" class="input-text" value="<?php echo $sex;?>"></td>
	</tr>
	<tr>
		<th width="100">电话：</th>
		<td><input type="text" name="form_test_ques[phone]" id="test_name"
			size="30" class="input-text" value="<?php echo $phone;?>"></td>
	</tr>
        <tr>
		<th width="100">公司：</th>
		<td><input type="text" name="form_test_ques[company]" id="test_name"
			size="30" class="input-text" value="<?php echo $company;?>"></td>
	</tr>
	<tr>
		<th width="100">问题：</th>
		<td><input type="text" name="form_test_ques[question]" id="test_name"
			size="30" class="input-text" value="<?php echo $question;?>"></td>
	</tr>
	<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?m=time&c=time&a=edit"> <input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value="确定修改"></td>
	</tr>

</table>
</form>
</div>
</body>
</html>

