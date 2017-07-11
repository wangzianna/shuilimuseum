<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>批量采集</title>
<style type="text/css">
table {
	border-collapse: collapse
}
</style>
<script src="./phpcms/modules/csdn123/templates/jquery.min.js" language="javascript"></script>
</head>
<body>
<br />
<br />
<br />
<form action="?m=csdn123&c=csdn123&a=add_postdata&pc_hash=<?php echo $_SESSION['pc_hash'];?>" method="post" id="form1">
  <table border="1" align="center" cellpadding="8">
    <tr>
      <th align="center" colspan="2"><span style="font-size:22px;font-weight:bold">批量采集</span></th>
    </tr>
    <tr>
      <td align="right">采集关键词：</td>
      <td><input type="text" size="30" name="csdn123_keyword" id="csdn123_keyword" /></td>
    </tr>
    <tr>
      <td align="right">限制内容来源：</td>
      <td><select name="csdn123_fromtype" id="csdn123_fromtype">
          <option value="0">不限内容来源</option>
          <option value="1">仅限微信公众号内容</option>
          <option value="3">仅限搞笑娱乐内容</option>
          <option value="4">仅限视频内容</option>
          <option value="5">仅限图库内容</option>
          <option value="6">仅限问答内容</option>
        </select></td>
    </tr>
    <tr>
      <td align="right">导入栏目：</td>
      <td><select name="csdn123_typeid" id="csdn123_typeid">
          <?php
    	foreach($csdn123_categoryName as $typeid_rs)
        {
        	echo "<option value=\"" . $typeid_rs["catid"] . "\">" . $typeid_rs["catname"] . "</option>";
        }
    ?>
        </select></td>
    </tr>
    <tr>
      <td align="right">显示来源链接：</td>
      <td><input type="radio" id="csdn123_fromurl1" name="csdn123_showfromurl" value="1" checked="checked" />
        <label for="csdn123_fromurl1">是</label>&nbsp;
        <input type="radio" id="csdn123_fromurl2" name="csdn123_showfromurl" value="0" />
        <label for="csdn123_fromurl2">否</label></td>
    </tr>
    <tr>
      <td align="right">内容图片本地化：</td>
      <td><input type="radio" id="csdn123_savelocalimg1" name="csdn123_savelocalimg" value="1"  onclick="alert('如果选择了“是”，内容的图片本地化存储会影响到服务器性能，请谨慎选择！！')"  />
        <label for="csdn123_savelocalimg1">是</label>&nbsp;
        <input type="radio" id="csdn123_savelocalimg2" name="csdn123_savelocalimg" value="0" checked="checked"/>
        <label for="csdn123_savelocalimg2">否</label></td>
    </tr>
    <tr>
      <th align="center" colspan="2"> <br />
        <input type="button" value="　确定采集　" id="myform"/>
        <br /> <br />
      </th>
    </tr>
  </table>
</form>
<script type="text/javascript">
$("#myform").click(function(){ 

	if($("#csdn123_keyword").val()=="")
	{
		alert("关键词不能为空！！");
		$("#csdn123_keyword").focus();
		
	} else {
		
		$("#form1").submit();		
	}

});
</script>
</body>
</html>

