<?php
$csdn123_showimg='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/phpcms/modules/csdn123/templates/csdn123_showimg.php';
?>

<div style="margin:4px auto;border:1px solid #CCC;padding:10px;line-height:24px;background:#EEE;display:none" id="csdn123_console">

<div>
关键词：<input type="text" id="csdn123keyword" class="px" placeholder="输入您想要采集的内容关键词"  size="80" />

<select id="fromtype">
<option value="all">综合采集</option>
    <option value="img">采集图片</option>
    <option value="weixin">采集微信</option>
    <option value="video">采集视频</option>
    <option value="haha">采集笑话</option>
    <option value="wenda">采集问答</option>
    <option value="likeurl">正文提取</option>
</select>

<button type="button"  id="csdn123_query" class="pn vm" style="vertical-align:top;">采集内容</button>
</div>
<div style="margin-top:16px">
请选择：<select id="csdn123_searchresult">
<option value="no">----请在上面输入关键词或者网址采集内容，这儿显示采集的结果----</option>
</select>
<span id="csdn123_loading"></span>
<button type="button"  id="csdn123_newsPre" class="pn vm" style="vertical-align:top;">上一条</button>
<button type="button"  id="csdn123_newsNext" class="pn vm" style="vertical-align:top;">下一条</button>
<button type="button"  id="csdn123_newsPrePage" class="pn vm" style="vertical-align:top;display:none">上一页</button>
<button type="button"  id="csdn123_newsNextPage" class="pn vm" style="vertical-align:top;display:none">下一页</button>
</div>

<div style="clear:both;margin-top:16px;display:block" id="csdn123_moreGongNeng">
其　它：
<button type="button"  id="csdn123_reset" class="pn vm" style="vertical-align:top;">初始内容</button>
<button type="button"  id="csdn123_likearticle" class="pn vm" style="vertical-align:top;">相似内容</button>
<button type="button"  id="csdn123_tongyici" class="pn vm" style="vertical-align:top;">云端伪原创</button>
<button type="button"  id="csdn123_localimgae" class="pn vm" style="vertical-align:top;">图片本地化</button>
<button type="button"  id="csdn123_fromurl" class="pn vm" style="vertical-align:top;">添加来源地址</button>
<button type="button"  id="csdn123_textformat" class="pn vm" style="vertical-align:top;">内容排版</button>
<button type="button"  id="csdn123_showtag" class="pn vm" style="vertical-align:top;">关键词</button>
<button type="button"  id="csdn123_retourl" class="pn vm" style="vertical-align:top;">跳转链接</button>
<br /><br />
常用采集关键词：<a href="javascript:csdn123_keyword('最新微信热文')">最新微信热文</a>&nbsp;|&nbsp;<a href="javascript:csdn123_keyword('最新资讯热点')">最新资讯热点</a>&nbsp;|&nbsp;<a href="javascript:csdn123_keyword('今日娱乐搞笑段子')">今日娱乐搞笑段子</a>&nbsp;|&nbsp;<a href="javascript:csdn123_keyword('今日美女模特欣赏')">今日美女模特欣赏</a>&nbsp;|&nbsp;<a href="javascript:csdn123_keyword('今日正能量语录')">今日正能量语录</a>&nbsp;|&nbsp;<br>
历史采集关键词：<span id="csdn123_tishi_historykeyword"></span>
</div>
</div>

<script src="./phpcms/modules/csdn123/templates/jquery.cookie.js" type="text/javascript"></script> 

<script type="text/javascript">
var _csdn123_siteurl = encodeURIComponent(window.location.href);
var csdn123_remoteUrl="";
var csdn123_page=1;
var csdn123_ToOnePage=true;


$("#csdn123_query").click(function(){

var csdn123keywordQuery = $("#csdn123keyword").val();
if(/^http\:\/\//g.test(csdn123keywordQuery)==true)
{
$("#fromtype").val("likeurl");
}
var csdn123fromtype=$("#fromtype").val();
csdn123_getcookies(csdn123keywordQuery);
if(csdn123keywordQuery=="")
{
alert("输入您想要采集的内容关键词或者内容页网址");
$("#csdn123keyword").focus();
return;
}
if(csdn123keywordQuery.length<2)
{
alert("您输入的关键词太短了，请输入至少二个字符以上的关键词！");
$("#csdn123keyword").focus();
return;
}
if(csdn123fromtype=="likeurl" && csdn123keywordQuery.indexOf("http://")==-1)
{
alert("您选择了正文提取，请在关键词那里填写内容页的网址。");
$("#csdn123keyword").focus();
return;
}
csdn123keywordQuery=encodeURIComponent(csdn123keywordQuery);
$("#csdn123_loading").html('<img src="./phpcms/modules/csdn123/templates/loading.gif" alt="loading" />');
if(csdn123_ToOnePage)
{
csdn123_page=1;
}
var csdn123_ajax_url="http://www.csdn123.net/zd_version/zd7/main_news.php?cms=phpcms&ip=<?php echo $_SERVER['REMOTE_ADDR']; ?>&fromtype=" + csdn123fromtype + "&page=" + csdn123_page + "&query="+ csdn123keywordQuery +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";
$.getJSON(csdn123_ajax_url, function(data) {
if(data.total>0){

$("#csdn123_searchresult").html("");
csdn123_getRemoteUrlContent(data.items[0].url);
var csdn123_i=0;		
for(csdn123_i=0;csdn123_i<data.items.length;csdn123_i++)
{
$("<option value='" + data.items[csdn123_i].url + "' csdn123fromurl='" + data.items[csdn123_i].fromurl + "'>" + data.items[csdn123_i].title + "</option>").appendTo("#csdn123_searchresult");
}


} else {
alert("抱歉，未采集到内容！！网络蜘蛛正在拼命抓取此关键词最新的相关内容，请过一段时间再来尝试此关键词的采集");
$("#csdn123keyword").focus();
}
$("#csdn123_loading").html("");
$("#csdn123_newsNextPage").show();
$("#csdn123_newsPrePage").show();
csdn123_ToOnePage=true;
});	
});

$("#csdn123_newsPre,#csdn123_newsNext").click(function(){

var csdn123_sel_index=$("#csdn123_searchresult option:selected").index();
if($(this).text()=="上一条")
{
csdn123_sel_index--;
} else {
csdn123_sel_index++;
}
if(csdn123_sel_index<=0)
{
csdn123_sel_index=0;
}
if(csdn123_sel_index>=$("#csdn123_searchresult option").length)
{
csdn123_sel_index--;
}
var csdn123_preObj=$("#csdn123_searchresult option").eq(csdn123_sel_index);
csdn123_preObj.attr('selected','selected');
csdn123_getRemoteUrlContent(csdn123_preObj.val());

});

$("#csdn123_newsPrePage,#csdn123_newsNextPage").click(function(){

if($(this).attr("id")=="csdn123_newsNextPage")
{
csdn123_page++;
} 
if($(this).attr("id")=="csdn123_newsPrePage")
{
csdn123_page--;
}
if(csdn123_page<=1)
{
csdn123_page=1;
}
csdn123_ToOnePage=false;
$("#csdn123_query").click();

});

$("#csdn123_tongyici").click(function(){

$(this).css("color","#ccc");
$("#csdn123_loading").html('<img src="./phpcms/modules/csdn123/templates/loading.gif" alt="loading" />');
if(typeof(CKEDITOR)!="undefined")
{
	var csdn123_tongyiciText=CKEDITOR.instances.content.document.getBody().getText();
	var csdn123_contentHtmlCode=CKEDITOR.instances.content.getData();

}
if(typeof(FCKeditorAPI)!="undefined")
{
	var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
	var csdn123_contentHtmlCode=csdn123_fckeditor.GetXHTML(true);
	var csdn123_tongyiciText=csdn123_contentHtmlCode.replace(/\s+/ig,"");
	csdn123_tongyiciText=csdn123_tongyiciText.replace(/<.+?>/ig,"");
	
}
if(typeof(ue)!="undefined")
{
	var csdn123_contentHtmlCode="";
	var csdn123_tongyiciText="";
	ue.ready(function() {
    	csdn123_contentHtmlCode = ue.getContent();
		csdn123_tongyiciText=ue.getContentTxt();
		
	});
}
csdn123_tongyiciText=csdn123_tongyiciText.replace(/[^\u4e00-\u9fa5]/ig,"");
if(csdn123_tongyiciText=="")
{
$("#csdn123_loading").html('');
return;
}
$.post("?m=csdn123&c=csdn123&a=csdn123_tongyici&pc_hash=<?php echo $_SESSION['pc_hash'];?>","csdn123_mycontent=" + csdn123_tongyiciText,function(data){

var csdn123_tempTongyiciArr;
for(var csdn123_i=0;csdn123_i<data.content.length;csdn123_i++)
{
csdn123_tempTongyiciArr=data.content[csdn123_i].split("=");
csdn123_contentHtmlCode=csdn123_contentHtmlCode.replace(csdn123_tempTongyiciArr[0],csdn123_tempTongyiciArr[1]);
}
csdn123_contentHtmlCode=csdn123_contentHtmlCode.replace(/hzw/ig,"");
if(typeof(CKEDITOR)!="undefined")
{
	CKEDITOR.instances.content.setData(csdn123_contentHtmlCode);

}
if(typeof(FCKeditorAPI)!="undefined")
{
	var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
	csdn123_fckeditor.SetHTML(csdn123_contentHtmlCode);

}
if(typeof(ue)!="undefined")
{
	ue.ready(function() {
    	ue.setContent(csdn123_contentHtmlCode);
	});
}
$("#csdn123_loading").html('');

},"json")

});

$("#csdn123_likearticle").click(function(){
	
	$("#csdn123_loading").html('<img src="./phpcms/modules/csdn123/templates/loading.gif" alt="loading" />');
	$("#fromtype").val("all");
	$.getJSON("http://www.csdn123.net/zd_version/zd7/getKeywords.php?url=" + encodeURIComponent(csdn123_remoteUrl) + "&siteurl=" + _csdn123_siteurl + "&csdn123newweixincallback=?",function(data){
	
		$("#csdn123keyword").val(data);
		$("#csdn123_query").click();

	});

});

$("#csdn123_showtag").click(function(){
	
	if($("#keywords").val()=="")
	{
		$(this).css("color","#ccc");
		$("#csdn123_loading").html('<img src="./phpcms/modules/csdn123/templates/loading.gif" alt="loading" />');
		$.getJSON("http://www.csdn123.net/zd_version/zd7/getKeywords.php?url=" + encodeURIComponent(csdn123_remoteUrl) + "&siteurl=" + _csdn123_siteurl + "&csdn123newweixincallback=?",function(data){
		
			$("#keywords").val(data.replace(/\s+/g,","));
			$("#csdn123_loading").html('');

		});
		
	} else {
		
		$("#keywords").val("");
		$(this).css("color","#000");
		
	}

});

$("#csdn123_retourl").click(function(){
	
	if($("#islink").attr("checked")==false || $("#islink").attr("checked")==undefined)
	{
		$(this).css("color","#ccc");
		$("#islink").attr("checked",true);
		var csdn123_redirecturl=$("#csdn123_searchresult option:selected").attr("csdn123fromurl");
		$("#linkurl").val(csdn123_redirecturl);
		$("#linkurl").removeAttr("disabled");
		
		
	} else {
		
		$(this).css("color","#000");
		$("#islink").attr("checked",false);
		$("#linkurl").attr("disabled","disabled");
		$("#linkurl").val("");
		
	}

});

$.getJSON("http://www.csdn123.net/zd_version/zd7/elite_new.php?siteurl=" + _csdn123_siteurl + "&ip=<?php echo $_SERVER['REMOTE_ADDR']; ?>&csdn123newweixincallback=?",function(data){

for(var csdn123_i=0;csdn123_i<data.length;csdn123_i++)
{
$("<option value='" + data[csdn123_i].url + "' csdn123fromurl='" + data[csdn123_i].fromurl + "'>" + data[csdn123_i].title + "</option>").appendTo("#csdn123_searchresult");
}

});

$("#csdn123_searchresult").change(function(){

csdn123_CurrentRemoteUrl=$(this).children('option:selected').val();
if(csdn123_CurrentRemoteUrl.indexOf("http")!=-1)
{
csdn123_getRemoteUrlContent(csdn123_CurrentRemoteUrl);
}


});

$("#csdn123_localimgae").click(function(){
	
	$("#csdn123_loading").html('<img src="./phpcms/modules/csdn123/templates/loading.gif" alt="loading" />');
	if(confirm("图片本地化会下载远程图片，在下载图片的过程中可能会导致网页很卡，是否要下载远程的图片到本地存储？？")==false)
	{
	$("#csdn123_loading").html('');
	return false;
	}
	var csdn123_htmlcode="";
	if(typeof(CKEDITOR)!="undefined")
	{
		csdn123_htmlcode=CKEDITOR.instances.content.getData();
	
	}
	if(typeof(FCKeditorAPI)!="undefined")
	{
		var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
		var csdn123_htmlcode=csdn123_fckeditor.GetXHTML(true);
	}
	if(typeof(ue)!="undefined")
	{
		var csdn123_htmlcode="";
		ue.ready(function() {
			csdn123_htmlcode = ue.getContent();
		});
	}
	var csdn123_imgPatt = /<img[^>]*src\s*=\s*(['"]?)([^'">]*)\1(?=\s|\/|>)/img
	var csdn123_imgRegStr=csdn123_htmlcode.match(csdn123_imgPatt);
	for(var csdn123_i=0;csdn123_i<csdn123_imgRegStr.length;csdn123_i++)
	{
	var csdn123_imgValue=csdn123_imgRegStr[csdn123_i];
	var csdn123_imgValue_arr=csdn123_imgValue.match(/<img[^>]*src\s*=\s*(['"]?)([^'">]*)\1/i);
	csdn123_imgValue=csdn123_imgValue_arr[2];
	$.ajax({async:false,cache:false,data:"csdn123_localimgUrl="+encodeURIComponent(csdn123_imgValue),type:"GET",url:"?m=csdn123&c=csdn123&a=csdn123_imgsavetolocal&pc_hash=<?php echo $_SESSION['pc_hash'];?>",success:function(data){
	
		csdn123_htmlcode=csdn123_htmlcode.replace(csdn123_imgValue,data);
	
	}})
	
	
	}
	if(typeof(CKEDITOR)!="undefined")
	{
		CKEDITOR.instances.content.setData(csdn123_htmlcode);
	
	}
	if(typeof(FCKeditorAPI)!="undefined")
	{
		var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
		csdn123_fckeditor.SetHTML(csdn123_htmlcode);
	}
	if(typeof(ue)!="undefined")
	{
		ue.ready(function() {
			ue.setContent(csdn123_htmlcode);
		});
	}
	$("#remote").attr("checked","checked");
	$("#csdn123_loading").html('');
	
});

$("#csdn123_fromurl").click(function(){
	
$(this).css("color","#ccc");
var csdn123fromurl=$("#csdn123_searchresult option:selected").attr("csdn123fromurl");
if(csdn123fromurl.indexOf("http")!=-1)
{
	
	if(typeof(CKEDITOR)!="undefined")
	{
		csdn123_htmlcode=CKEDITOR.instances.content.getData();
		csdn123_htmlcode=csdn123_htmlcode + "<br><br>来源地址：" + csdn123fromurl;
		CKEDITOR.instances.content.setData(csdn123_htmlcode);
	
	}
	if(typeof(FCKeditorAPI)!="undefined")
	{
		var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
		csdn123_htmlcode=csdn123_fckeditor.GetXHTML(true);
		csdn123_htmlcode=csdn123_htmlcode + "<br><br>来源地址：" + csdn123fromurl;
		csdn123_fckeditor.SetHTML(csdn123_htmlcode);	
		
	}
	if(typeof(ue)!="undefined")
	{
		ue.ready(function() {
			csdn123_htmlcode=ue.getContent();
			csdn123_htmlcode=csdn123_htmlcode + "<br><br>来源地址：" + csdn123fromurl;
			ue.setContent(csdn123_htmlcode);
		});
	}
	alert("文章来源地址已经添加到文章的最下面！");
	
}

});
$("#csdn123_textformat").click(function(){

	if(typeof(CKEDITOR)!="undefined")
	{
		csdn123_htmlcode=CKEDITOR.instances.content.getData();
		csdn123_htmlcode=csdn123_htmlcode.replace(/(<img[^<>]+?>)/ig,"<br>$1<br>");
		csdn123_htmlcode=csdn123_htmlcode.replace(/<\/p>/ig,"</p><br />");
		CKEDITOR.instances.content.setData(csdn123_htmlcode);
	
	}
	if(typeof(FCKeditorAPI)!="undefined")
	{
		var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
		csdn123_htmlcode=csdn123_fckeditor.GetXHTML(true);
		csdn123_htmlcode=csdn123_htmlcode.replace(/(<img[^<>]+?>)/ig,"<br>$1<br>");
		csdn123_htmlcode=csdn123_htmlcode.replace(/<\/p>/ig,"</p><br />");
		csdn123_fckeditor.SetHTML(csdn123_htmlcode);
		
	}
	if(typeof(ue)!="undefined")
	{
		ue.ready(function() {
			csdn123_htmlcode=ue.getContent();
			csdn123_htmlcode=csdn123_htmlcode.replace(/(<img[^<>]+?>)/ig,"<br>$1<br>");
			csdn123_htmlcode=csdn123_htmlcode.replace(/<\/p>/ig,"</p><br />");
			ue.setContent(csdn123_htmlcode);	
		});
	}

});
$("#csdn123_reset").click(function(){

if(csdn123_remoteUrl.indexOf("http")!=-1)
{
csdn123_getRemoteUrlContent(csdn123_remoteUrl);
}

});



function csdn123_keyword(str)
{
	$("#fromtype").val("all");
	$("#csdn123keyword").val(str);
	$("#csdn123_query").click();
}

function csdn123_getRemoteUrlContent(url)
{
csdn123_remoteUrl=url;
$("#csdn123_loading").html('<img src="./phpcms/modules/csdn123/templates/loading.gif" alt="loading" />');
csdn123_catchUrl="http://www.csdn123.net/zd_version/zd7/getContent.php?cms=dedecms&ip=<?php echo $_SERVER['REMOTE_ADDR'] ?>&siteurl=" + _csdn123_siteurl + "&url="+ encodeURIComponent(url) +"&csdn123content=?";
$.getJSON(csdn123_catchUrl,function(data){

if(data.status=="ok")
{
$("#title").val(data.title);
var url_content=data.content;
url_content=url_content.replace(/http:\/\/www.csdn123.net\/mydata\/showimg\.php/g,"<?php echo $csdn123_showimg; ?>");
url_content=url_content.replace(/http:\/\/www.csdn123.net\/mydata\/zhihuimg\.php/g,"<?php echo $csdn123_showimg; ?>");
url_content=url_content.replace(/http:\/\/www.csdn123.net\/mydata\/nicimg\.php/g,"<?php echo $csdn123_showimg; ?>");
url_content=url_content.replace(/http:\/\/www.csdn123.net\/mydata\/showbaiduimg\.php/g,"<?php echo $csdn123_showimg; ?>");
if(typeof(CKEDITOR)!="undefined")
{
	CKEDITOR.instances.content.setData(url_content);

}
if(typeof(FCKeditorAPI)!="undefined")
{
	var csdn123_fckeditor = FCKeditorAPI.GetInstance('content');
	csdn123_fckeditor.SetHTML(url_content);
	
}
if(typeof(ue)!="undefined")
{
	ue.ready(function() {
    	ue.setContent(url_content);
	});
}
$("#csdn123_loading").html('');
}
$("#keywords,#linkurl").val("");
$("#islink").attr("checked",false);
$("#csdn123_tongyici,#csdn123_fromurl,#csdn123_showtag,#csdn123_retourl").css("color","#000");

});

}

function csdn123_getcookies(csdn123keywordQuery)
{
if(csdn123keywordQuery.indexOf("http")!=-1 || csdn123keywordQuery.length>5)
{
return false;
}
var csdn123TempCookies=$.cookie("csdn123");
if(csdn123TempCookies==undefined && csdn123keywordQuery=="")
{
return false;

}else if(csdn123keywordQuery!=""){

if(csdn123TempCookies && csdn123TempCookies.indexOf("|")>0)
{
csdn123TempCookies=csdn123TempCookies.replace(csdn123keywordQuery + "|","");
}
if(csdn123TempCookies==undefined)
{
csdn123TempCookies=csdn123keywordQuery + "|";
} else {
csdn123TempCookies=csdn123keywordQuery + "|" + csdn123TempCookies;
}
}
$.cookie("csdn123",csdn123TempCookies);
var csdn123TempCookiesArr=csdn123TempCookies.split("|");
var csdn123_j=0;
var csdn123_cookieKeyword="";
for(csdn123_j=0;csdn123_j<csdn123TempCookiesArr.length;csdn123_j++)
{
if(csdn123TempCookiesArr[csdn123_j]!="" && csdn123TempCookiesArr[csdn123_j]!="undefined")
{
csdn123_cookieKeyword+="<a href=\"javascript:csdn123_keyword('" + csdn123TempCookiesArr[csdn123_j] + "')\">" + csdn123TempCookiesArr[csdn123_j] + "</a>&nbsp;|&nbsp;"
}
if(csdn123_j>16)
{
break;
}
}
$("#csdn123_tishi_historykeyword").html(csdn123_cookieKeyword);
}
csdn123_getcookies("");

function csdn123_console()
{
	var csdn123_console_display=$("#csdn123_console").css("display");
	if(csdn123_console_display=="none")
	{
		$("#csdn123_console").show();
	} else {
		$("#csdn123_console").hide();
	}
}

$(".crumbs").append("&nbsp;&nbsp;<input type=\"button\" value=\"众大云采集\" onclick=\"csdn123_console()\" />");
</script>