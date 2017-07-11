<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>批量采集</title>
<style type="text/css">
body {
	font-size: 12px;
}
a {
	text-decoration: none
}
a:hover {
	color: #F00
}
table {
	border-collapse: collapse
}
</style>
<script src="./phpcms/modules/csdn123/templates/jquery.min.js" language="javascript"></script>
</head>
<body>
<form action="?catchtext=yes" method="post" id="form1">
  <table border="1" align="center" cellpadding="8">
    <tr>
      <td colspan="6" style="font-size:14px"> 采集关键词“<?php echo $_POST["csdn123_keyword"]; ?>”，一共采集了<?php echo $csdn123_i; ?>条<br />
        <div><?php echo $csdn123_info; ?></div></td>
    </tr>
    <tr style="background:#ccc;">
      <th align="center"><input type="checkbox" id="chkall" name="chkall" onclick="csdn123_sel_all()" /></th>
      <th>标题</th>
      <th>内容图片</th>
      <th>采集时间</th>
      <th>导入版块</th>
      <th>操作</th>
    </tr>
    <?php
foreach($csdn123_news_list as $csdn123_list_rs)
{
?>
    <tr id="mytr<?php echo $csdn123_list_rs["id"]; ?>" onmouseover="this.style.background='#CCC'" onmouseout="this.style.background='#FFF'">
      <td align="center"><input type="checkbox" value="<?php echo $csdn123_list_rs["id"]; ?>" id="myid<?php echo $csdn123_list_rs["id"]; ?>" name="csdn123_uid" /></td>
      <td><a href="<?php echo $csdn123_list_rs["fromurl"]; ?>" target="_blank"><?php echo $csdn123_list_rs["title"]; ?></a></td>
      <td><?php echo $csdn123_list_rs["savelocalimg"]==1?"本地存储":"远程存储" ?></td>
      <td align="center"><?php echo date("Y-m-d H:i:s",$csdn123_list_rs["getdatetime"]); ?></td>
      <td align="center"><?php echo $this->csdn123_typename($csdn123_list_rs["typeid"]); ?></td>
      <td align="center"><a href="javascript:csdn123_import(<?php echo $csdn123_list_rs["id"];?>)">导入</a>&nbsp;&nbsp;<a href="javascript:csdn123_del(<?php echo $csdn123_list_rs["id"];?>)">删除</a></td>
    </tr>
    <?php } ?>
    <tr>
      <td align="center"><div style="padding:8px"><input type="button" value="全选" onclick="csdn123_sel_all(1)" /></div></td>
      <td colspan="5"><div style="padding:8px">
          <input type="button" value="全部导入" onclick="csdn123_import_all()" />
          &nbsp;&nbsp;
          <input type="button" value="全部删除" onclick="csdn123_delete_all()" />
          &nbsp;&nbsp;
          <span id="myresult" style="font-size:14px;color:#F00"></span>
          </div>
          </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
function csdn123_sel_all(num)
{
	if(num==1)
	{
		var csdn123_checked=$("#chkall").attr('checked');
		csdn123_checked=!csdn123_checked;
		$("#chkall").attr('checked',csdn123_checked);
		
	} else {
		var csdn123_checked=$("#chkall").attr('checked');
	}
	if(csdn123_checked==true)
	{
		$('input[name=csdn123_uid]').attr('checked',true);
	} else {
		$('input[name=csdn123_uid]').attr('checked',false);
	}
}
function csdn123_import(uid)
{
	if(confirm("确定要导入吗？"))
	{
		var csdn123_url="?m=csdn123&c=csdn123&a=csdn123_import&pc_hash=<?php echo $_SESSION['pc_hash'];?>&csdn123_id=" + uid;
		$("#mytr" + "" + uid).find("td").eq(5).html("<span style='color:Green'>稍等……</span>");
		$.get(csdn123_url,function(obj){
			
				if(obj.indexOf("hezhiwu_yes")!=-1)
				{
					$("#mytr" + "" + uid).find("td").eq(5).html("<span style='color:Red'>导入成功</span>");
				}
			
			});
	}
}
function csdn123_del(uid)
{
	if(confirm("确定要删除吗？"))
	{
		var csdn123_url="?m=csdn123&c=csdn123&a=csdn123_delid&pc_hash=<?php echo $_SESSION['pc_hash'];?>&csdn123_delid=" + uid;
		$.get(csdn123_url,function(obj){
			
				if(obj.indexOf("yes_hezhiwu_del")!=-1)
				{
					$("#mytr" + "" + uid).remove();
					
				}
			
			});
	}
}
function csdn123_import_all(obj)
{
	var csdn123_i=$("input[name=csdn123_uid]:checked").length;
	var csdn123_uid;
	var csdn123_num=0;
	var csdn123_uid2;
	if(csdn123_i>0)
	{
		$("#myresult").html("正在导入中……");
		for(var i=0;i<csdn123_i;i++)
		{
			csdn123_uid=$("input[name=csdn123_uid]:checked").eq(i).val();
			var csdn123_url="?m=csdn123&c=csdn123&a=csdn123_import&pc_hash=<?php echo $_SESSION['pc_hash'];?>&csdn123_id=" + csdn123_uid;
			$.get(csdn123_url,function(obj){
				
					if(obj.indexOf("hezhiwu_yes")!=-1)
					{
						csdn123_num++;
						$("#myresult").html("成功导入" + csdn123_num + "条");
						csdn123_uid2=$("input[name=csdn123_uid]:checked").eq(csdn123_i-csdn123_num).val();
						$("#mytr" + "" + csdn123_uid2).remove();
						

					}
				
				});
			
		}
		
	} else {
		alert("请勾选需要导入的内容！");
	}
}
function csdn123_delete_all()
{
	var csdn123_i=$("input[name=csdn123_uid]:checked").length;
	var csdn123_uid;
	var csdn123_num=0;
	var csdn123_uid2;
	if(csdn123_i>0)
	{
		for(var i=0;i<csdn123_i;i++)
		{
			$("#myresult").html("正在删除中……");
			csdn123_uid=$("input[name=csdn123_uid]:checked").eq(i).val();
			var csdn123_url="?m=csdn123&c=csdn123&a=csdn123_delid&pc_hash=<?php echo $_SESSION['pc_hash'];?>&csdn123_delid=" + csdn123_uid;
			$.get(csdn123_url,function(obj){
				
					if(obj.indexOf("yes_hezhiwu_del")!=-1)
					{
						csdn123_num++;
						$("#myresult").html("成功删除" + csdn123_num + "条");
						csdn123_uid2=$("input[name=csdn123_uid]:checked").eq(csdn123_i-csdn123_num).val();
						$("#mytr" + "" + csdn123_uid2).remove();
						
					}
				
				});
			
		}
		
	} else {
		alert("请勾选需要删除的内容！");
	}
}
</script>
</body>
</html>
