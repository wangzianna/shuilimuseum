<?php

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

function dmkdir($dir, $mode = 0777, $makeindex = TRUE){
	if(!is_dir($dir)) {
		dmkdir(dirname($dir), $mode, $makeindex);
		@mkdir($dir, $mode);
		if(!empty($makeindex)) {
			@touch($dir.'/index.html'); @chmod($dir.'/index.html', 0777);
		}
	}
	return true;
}

function csdn123_dfsockopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE, $encodetype  = 'URLENCODE', $allowcurl = TRUE, $position = 0, $files = array()) {
	$return = '';
	$headers='';
	$matches = parse_url($url);
	$scheme = $matches['scheme'];
	$host = $matches['host'];
	$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
	$port = !empty($matches['port']) ? $matches['port'] : ($scheme == 'http' ? '80' : '');
	$boundary = $encodetype == 'URLENCODE' ? '' : random(40);

	if($post) {
		if(!is_array($post)) {
			parse_str($post, $post);
		}
		csdn123_format_postkey($post, $postnew);
		$post = $postnew;
	}
	if(function_exists('curl_init') && function_exists('curl_exec')) {
		$ch = curl_init();
		$httpheader = array();
		if($ip) {
			$httpheader[] = "Host: ".$host;
		}
		if($httpheader) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
		}
		curl_setopt($ch, CURLOPT_URL, $scheme.'://'.($ip ? $ip : $host).($port ? ':'.$port : '').$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		if($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			if($encodetype == 'URLENCODE') {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			} else {
				foreach($post as $k => $v) {
					if(isset($files[$k])) {
						$post[$k] = '@'.$files[$k];
					}
				}
				foreach($files as $k => $file) {
					if(!isset($post[$k]) && file_exists($file)) {
						$post[$k] = '@'.$file;
					}
				}
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			}
		}
		if($cookie) {
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		$data = curl_exec($ch);
		$status = curl_getinfo($ch);
		$errno = curl_errno($ch);
		curl_close($ch);
		if($errno || $status['http_code'] != 200) {
			return;
		} else {
			$GLOBALS['filesockheader'] = substr($data, 0, $status['header_size']);
			$data = substr($data, $status['header_size']);
			return !$limit ? $data : substr($data, 0, $limit);
		}
	}

	if($post) {
		if($encodetype == 'URLENCODE') {
			$data = http_build_query($post);
		} else {
			$data = '';
			foreach($post as $k => $v) {
				$data .= "--$boundary\r\n";
				$data .= 'Content-Disposition: form-data; name="'.$k.'"'.(isset($files[$k]) ? '; filename="'.basename($files[$k]).'"; Content-Type: application/octet-stream' : '')."\r\n\r\n";
				$data .= $v."\r\n";
			}
			foreach($files as $k => $file) {
				if(!isset($post[$k]) && file_exists($file)) {
					if($fp = @fopen($file, 'r')) {
						$v = fread($fp, filesize($file));
						fclose($fp);
						$data .= "--$boundary\r\n";
						$data .= 'Content-Disposition: form-data; name="'.$k.'"; filename="'.basename($file).'"; Content-Type: application/octet-stream'."\r\n\r\n";
						$data .= $v."\r\n";
					}
				}
			}
			$data .= "--$boundary\r\n";
		}
		$out = "POST $path HTTP/1.0\r\n";
		$header = "Accept: */*\r\n";
		$header .= "Accept-Language: zh-cn\r\n";
		$header .= $encodetype == 'URLENCODE' ? "Content-Type: application/x-www-form-urlencoded\r\n" : "Content-Type: multipart/form-data; boundary=$boundary\r\n";
		$header .= 'Content-Length: '.strlen($data)."\r\n";
		$header .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$header .= "Host: $host:$port\r\n";
		$header .= "Connection: Close\r\n";
		$header .= "Cache-Control: no-cache\r\n";
		$header .= "Cookie: $cookie\r\n\r\n";
		$out .= $header;
		$out .= $data;
	} else {
		$out = "GET $path HTTP/1.0\r\n";
		$header = "Accept: */*\r\n";
		$header .= "Accept-Language: zh-cn\r\n";
		$header .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$header .= "Host: $host:$port\r\n";
		$header .= "Connection: Close\r\n";
		$header .= "Cookie: $cookie\r\n\r\n";
		$out .= $header;
	}



	$fpflag = 0;
	
	if(!$fp = @csdn123_refsocketopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout)) {
		$context = array(
			'http' => array(
				'method' => $post ? 'POST' : 'GET',
				'header' => $header,
				'content' => $post,
				'timeout' => $timeout,
			),
		);
		$context = stream_context_create($context);
		$fp = @fopen($scheme.'://'.($ip ? $ip : $host).':'.$port.$path, 'b', false, $context);
		$fpflag = 1;
	}

	if(!$fp) {
		return '';
	} else {
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
		if(!$status['timed_out']) {
			while (!feof($fp) && !$fpflag) {
				$header = @fgets($fp);
				$headers .= $header;
				if($header && ($header == "\r\n" ||  $header == "\n")) {
					break;
				}
			}
			$GLOBALS['filesockheader'] = $headers;

			if($position) {
				for($i=0; $i<$position; $i++) {
					$char = fgetc($fp);
					if($char == "\n" && $oldchar != "\r") {
						$i++;
					}
					$oldchar = $char;
				}
			}

			if($limit) {
				$return = stream_get_contents($fp, $limit);
			} else {
				$return = stream_get_contents($fp);
			}
		}
		@fclose($fp);
		return $return;
	}
}

function csdn123_format_postkey($post, &$result, $key = '') {
	foreach($post as $k => $v) {
		$_k = $key ? $key.'['.$k.']' : $k;
		if(is_array($v)) {
			csdn123_format_postkey($v, $result, $_k);
		} else {
			$result[$_k] = $v;
		}
	}
}

function csdn123_refsocketopen($hostname, $port = 80, &$errno, &$errstr, $timeout = 15) {
	$fp = '';
	if(function_exists('fsockopen')) {
		$fp = @fsockopen($hostname, $port, $errno, $errstr, $timeout);
	} elseif(function_exists('pfsockopen')) {
		$fp = @pfsockopen($hostname, $port, $errno, $errstr, $timeout);
	} elseif(function_exists('stream_socket_client')) {
		$fp = @stream_socket_client($hostname.':'.$port, $errno, $errstr, $timeout);
	}
	return $fp;
}

function csdn123_remoteSaveLocalImg($csdn123_remoteUrl)
{

	$csdn123_uploads=PHPCMS_PATH . 'uploadfile' . '/' . 'csdn123/';
	$csdn123_imgurl=APP_PATH . 'uploadfile/csdn123/';
	if($csdn123_remoteUrl=="" || strpos($csdn123_remoteUrl,'http')===false)
	{
		return "no";
	} else {
		
		$csdn123_pathName=$csdn123_uploads . date('Ym',time()) . '/' . date('d',time());
		dmkdir($csdn123_pathName, 0777);
		$csdn123_return=csdn123_dfsockopen("http://www.csdn123.net/zw_oss/zd_v6_get_img.php?siteurl=" . urlencode($csdn123_imgurl) . "&ip=" . $_SERVER['REMOTE_ADDR'] . "&imgurl=" . urlencode($csdn123_remoteUrl));
		$csdn123_localFileName=md5($csdn123_return);
		$csdn123_ext=pathinfo($csdn123_return,PATHINFO_EXTENSION);
		if($csdn123_ext=="" || empty($csdn123_ext))
		{
			$csdn123_ext="jpg";
		}
		$csdn123_localFileName=$csdn123_localFileName . '.' . $csdn123_ext;
		$csdn123_pathName_httpUrl=$csdn123_imgurl . date('Ym',time()) . '/' . date('d',time()) . '/' . $csdn123_localFileName;
		$csdn123_localFileName=$csdn123_pathName . '/' . $csdn123_localFileName;
		$csdn123_imageData=csdn123_dfsockopen($csdn123_return);
		file_put_contents($csdn123_localFileName,$csdn123_imageData);
		return $csdn123_pathName_httpUrl;
		
	}
}


class csdn123 extends admin {
	
function  __construct() {
          parent::__construct();
}

public function init()
{
	
}

public function add_bilang()
{

	$db=pc_base::load_model('category_model');
	$csdn123_categoryName=$db->select("modelid=1","catid,catname");
	include $this->admin_tpl('add_bilang');
	
}

private function csdn123_typename($catid)
{
	$db=pc_base::load_model('category_model');
	$csdn123_typenameArr=$db->get_one('catid=' . $catid,'catname');
	return $csdn123_typenameArr["catname"];
	
}
public function csdn123_delid()
{
	
	$db=pc_base::load_model('csdn123_model');
	if($db->delete("id=" . $_GET["csdn123_delid"]))
	{
		echo "yes_hezhiwu_del";
	} else {
		echo "no";
	}
}
public function csdn123_import($csdn123_id)
{
	if(empty($_GET["csdn123_id"]))
	{
		echo "csdn123_id_empty";
		exit;
	}
	$csdn123_id=$_GET["csdn123_id"];
	$db=pc_base::load_model('csdn123_model');
	$tablepre=$db->db_tablepre;
	$csdn123_news=$db->get_one("is_import is null and id=" . $csdn123_id);
	if(empty($csdn123_news))
	{
		echo "hezhiwu_no";
	}else {

		$db->query("update " . $tablepre . "zd_news set is_import=1 where id=" . $csdn123_id);
		$csdn123_fid=$csdn123_news["typeid"];
		$csdn123_title=$csdn123_news["title"];
		$csdn123_time=$csdn123_news["getdatetime"];
		$csdn123_showfromurl=$csdn123_news["showfromurl"];
		$csdn123_fromurl=$csdn123_news["fromurl"];
		$csdn123_savelocalimg=$csdn123_news["savelocalimg"];
		$csdn123_content=csdn123_dfsockopen("http://www.csdn123.net/zd_version/zd7/getContent_list.php?cms=dedecms&ip=" . $_SERVER['REMOTE_ADDR'] . "&siteurl=" . $_SERVER['HTTP_HOST'] . "&url=" . $csdn123_news["url"]);
		$csdn123_content=json_decode($csdn123_content);
		$csdn123_lang=pc_base::load_config('system','charset');
		$csdn123_lang=strtoupper($csdn123_lang);
		if(strpos($csdn123_lang,"GBK")!==false)
		{
			$csdn123_lang="GBK";
		}
		if(strpos($csdn123_lang,"BIG")!==false)
		{
			$csdn123_lang="BIG5";
		}		
		if(strpos($csdn123_lang,'UTF')===false)
		{
			$csdn123_content=mb_convert_encoding($csdn123_content,$csdn123_lang,"UTF-8");
		}
		$csdn123_showimg=APP_PATH . 'phpcms/modules/csdn123/templates/csdn123_showimg.php';
		$csdn123_content=str_replace('http://www.csdn123.net/mydata/showimg.php',$csdn123_showimg,$csdn123_content);
		$csdn123_content=str_replace('http://www.csdn123.net/mydata/zhihuimg.php',$csdn123_showimg,$csdn123_content);
		$csdn123_content=str_replace('http://www.csdn123.net/mydata/nicimg.php',$csdn123_showimg,$csdn123_content);
		$csdn123_content=str_replace('http://www.csdn123.net/mydata/showbaiduimg.php',$csdn123_showimg,$csdn123_content);
		if($csdn123_showfromurl==1)
		{
			$csdn123_content=$csdn123_content . "<br><br><br>来源链接：" . $csdn123_fromurl;
		}
		if($csdn123_savelocalimg==1)
		{
			preg_match_all('/<img[^>]*src\s*=\s*([\'"]?)([^\'">]*)\1(?=\s|\/|>)/i',$csdn123_content,$csdn123_imgArr);
			$csdn123_AllImg=$csdn123_imgArr[2];
			foreach($csdn123_AllImg as $csdn123_AllImgValue)
			{
				$csdn123_AllImgValue_locale=csdn123_remoteSaveLocalImg($csdn123_AllImgValue);
				$csdn123_content=str_replace($csdn123_AllImgValue,$csdn123_AllImgValue_locale,$csdn123_content);					
			}
		}		
		$v9_news_sql="INSERT INTO `" . $tablepre . "news` (`catid`, `typeid`, `title`, `style`, `thumb`, `keywords`, `description`, `posids`, `url`, `listorder`, `status`, `sysadd`, `islink`, `username`, `inputtime`, `updatetime`)";
		$v9_news_sql=$v9_news_sql . "VALUES (" . $csdn123_fid . ", 0, '". $csdn123_title . "', '', '', '', '', 0, '', 0, 99, 1, 0, '本站', " . time() . ", " . time() . ");";
		$db->query($v9_news_sql);
		$csdn123_insert_id=$db->insert_id();
		$v9_news_data_sql="INSERT INTO `" . $tablepre . "news_data` (`id`, `content`, `readpoint`, `groupids_view`, `paginationtype`, `maxcharperpage`, `template`, `paytype`, `relation`, `voteid`, `allow_comment`, `copyfrom`) ";
		$v9_news_data_sql=$v9_news_data_sql . "VALUES (" . $csdn123_insert_id . ", '" . mysql_escape_string($csdn123_content) . "', 0, '', 0, 10000, '', 0, '', 0, 1, '|0')";
		$db->query($v9_news_data_sql);
		$csdn123_app_path=pc_base::load_config('system','app_path');
		$csdn123_url=$csdn123_app_path . "index.php?m=content&c=index&a=show&catid=" . $csdn123_fid . "&id=" . $csdn123_insert_id;
		$csdn123_update_sql="update `" . $tablepre . "news` set url='" . $csdn123_url . "' where id=" . $csdn123_insert_id;
		$db->query($csdn123_update_sql);
		echo "hezhiwu_yes";
		
	}

}
public function add_postdata()
{
	$db=pc_base::load_model('csdn123_model');
	$tablepre=$db->db_tablepre;
	$charset=pc_base::load_config('system','charset');
	$csdn123_keyword=$_POST["csdn123_keyword"];
	$csdn123_fromtype=$_POST["csdn123_fromtype"];
	$csdn123_typeid=$_POST["csdn123_typeid"];
	$csdn123_showfromurl=$_POST["csdn123_showfromurl"];
	$csdn123_savelocalimg=$_POST["csdn123_savelocalimg"];
	$csdn123_i=0;
	$csdn123_info="";
	$csdn123_lang=strtoupper($charset);
	if(strpos($csdn123_lang,"GBK")!==false)
	{
		$csdn123_lang="GBK";
	}
	if(strpos($csdn123_lang,"BIG")!==false)
	{
		$csdn123_lang="BIG5";
	}
	if(strpos($csdn123_lang,'UTF')===false)
	{
		$csdn123_keyword=mb_convert_encoding($csdn123_keyword,"UTF-8",$csdn123_lang);
	}
	$csdn123_url="http://www.csdn123.net/zd_version/zd7/main_news_list.php?ip=" . $_SERVER['REMOTE_ADDR'] . "&siteurl=" . $_SERVER['HTTP_HOST'] . "&query=" . urlencode($csdn123_keyword) . "&fromtype=" . $csdn123_fromtype . "&showfromurl=1";
	$csdn123_getdata=file_get_contents($csdn123_url);
	$csdn123_getdata=json_decode($csdn123_getdata,true);
	foreach($csdn123_getdata["items"] as $csdn123_key=>$csdn123_value)
	{
		if(strpos($csdn123_lang,'UTF')===false){
		
			$csdn123_getdata["items"][$csdn123_key]['title']=mb_convert_encoding($csdn123_getdata["items"][$csdn123_key]['title'],$csdn123_lang,"UTF-8");
		}
		$csdn123_insert_sql="insert into " . $tablepre . "zd_news(title,getdatetime,url,fromurl,typeid,showfromurl,savelocalimg) values('" . $csdn123_getdata["items"][$csdn123_key]['title'] . "'," . time() . ",'" . $csdn123_getdata["items"][$csdn123_key]['url'] . "','" . $csdn123_getdata["items"][$csdn123_key]['fromurl'] . "'," . $csdn123_typeid . "," . $csdn123_showfromurl . "," . $csdn123_savelocalimg . ")";
		$csdn123_num_rows=$db->count("url='" . $csdn123_getdata["items"][$csdn123_key]['url'] . "'");
		if($csdn123_num_rows==0)
		{
			$db->query($csdn123_insert_sql);
			$csdn123_i++;
		}
	}
	
	if(strpos($csdn123_lang,'UTF')===false){
		
		$csdn123_getdata['pass']=mb_convert_encoding($csdn123_getdata['pass'],$csdn123_lang,"UTF-8");
	}
	
	$csdn123_news_list=$db->select("is_import is null","*","100","id desc");
	if($csdn123_getdata['pass']!='yes')
	{
		$csdn123_info=$csdn123_getdata['pass'];
		
		
	}
	include $this->admin_tpl('article_list');
	
}
public function add_admindata()
{
	$db=pc_base::load_model('csdn123_model');
	$csdn123_news_list=$db->select("is_import is null","*","100","id desc");
	include $this->admin_tpl('article_adminlist');
}
public function add_help()
{

	$csdn123_siteurl="http://www.csdn123.net/zd_version/zd7/check.php?url=" . urlencode($_SERVER['HTTP_HOST']) . "&ip=" . $_SERVER['REMOTE_ADDR'];
	$csdn123_getdata=csdn123_dfsockopen($csdn123_siteurl);
	$csdn123_lang=strtoupper(CHARSET);
	$csdn123_getdata=json_decode($csdn123_getdata,true);
	$csdn123_getdata_info=$csdn123_getdata['info'];
	if(strpos($csdn123_lang,"GBK")!==false)
	{
		$csdn123_lang="GBK";
		$csdn123_getdata_info=mb_convert_encoding($csdn123_getdata_info,"GBK","UTF-8");
	}
	if(strpos($csdn123_lang,"BIG")!==false)
	{
		$csdn123_lang="BIG5";
		$csdn123_getdata_info=mb_convert_encoding($csdn123_getdata_info,"BIG5","UTF-8");
	}
	include $this->admin_tpl('gethelp');
	
}
public function add_one()
{
	$csdn123_file=fopen("./phpcms/modules/content/templates/content_add.tpl.php","r+");
	$csdn123_contents=fread($csdn123_file,filesize("./phpcms/modules/content/templates/content_add.tpl.php"));
	if(strpos($csdn123_contents,'csdn123_news.htm')!==false)
	{
		$csdn123_contents=str_replace('<?php require_once("./phpcms/modules/content/templates/csdn123_news/csdn123_news.htm"); ?>','',$csdn123_contents);
		$csdn123_contents=str_replace('require_once("./phpcms/modules/content/templates/csdn123_news/csdn123_news.htm");','',$csdn123_contents);
		
	}
	if(strpos($csdn123_contents,'mycontrol.tpl.php')===false)
	{
		$csdn123_contents=str_replace('<table width="100%" cellspacing="0" class="table_form">','<?php include_once("./phpcms/modules/csdn123/templates/mycontrol.tpl.php"); ?><table width="100%" cellspacing="0" class="table_form">',$csdn123_contents);
		rewind($csdn123_file);
		fwrite($csdn123_file,$csdn123_contents);
		
	}
	fclose($csdn123_file);
	include $this->admin_tpl('add_one');
}
public function add_delete()
{
	if($_GET["csdn123del"]=="yes")
	{
		$csdn123_file=fopen("./phpcms/modules/content/templates/content_add.tpl.php","r+");
		$csdn123_contents=fread($csdn123_file,filesize("./phpcms/modules/content/templates/content_add.tpl.php"));
		if(strpos($csdn123_contents,'csdn123')!==false)
		{
			$csdn123_contents=preg_replace('/<\?php.+?csdn123.+?\?>/i','',$csdn123_contents);
			fclose($csdn123_file);
			$csdn123_file=fopen("./phpcms/modules/content/templates/content_add.tpl.php","w+");
			fwrite($csdn123_file,$csdn123_contents);
			
		}
		fclose($csdn123_file);
		$db=pc_base::load_model('csdn123_model');
		$tablepre=$db->db_tablepre;
		$module_del="delete from $tablepre" . "module where module='csdn123'";
		$menu_del="delete from $tablepre" . "menu where m='csdn123' and c='csdn123'";
		if($db->query($module_del) && $db->query($menu_del))
		{
			include $this->admin_tpl('add_delete');
		}
		
	} else {
		
		include $this->admin_tpl('uninstallinfo');
		
	}
	
}
public function csdn123_tongyici()
{


	$csdn123_mycontent=$_POST["csdn123_mycontent"];
	$cfg_version=pc_base::load_config('system','charset');
	$csdn123_data = array ('csdn123_mycontent' => $csdn123_mycontent,'csdn123_is_utf8' => $cfg_version);
	$csdn123_url="http://www.csdn123.net/zd_version/zd7/replaceTongyici.php?cms=dedecms&siteurl=" . urlencode($_SERVER['HTTP_HOST']) . "&ip=" . $_SERVER['REMOTE_ADDR'];
	$csdn123_return=csdn123_dfsockopen($csdn123_url,0,$csdn123_data);
	echo $csdn123_return;

}
public function csdn123_imgsavetolocal()
{
	
	$csdn123_uploads=PHPCMS_PATH . 'uploadfile' . '/' . 'csdn123/';
	$csdn123_imgurl=APP_PATH . 'uploadfile/csdn123/';
	$csdn123_showimg=APP_PATH . 'phpcms/modules/csdn123/templates/csdn123_showimg.php';
	$csdn123_localimgUrl=$_GET["csdn123_localimgUrl"];
	if($csdn123_localimgUrl=="" || strpos($csdn123_localimgUrl,'http')===false)
	{
		echo "no";
		
	} else {
		
		$csdn123_pathName=$csdn123_uploads . date('Ym',time()) . '/' . date('d',time());
		dmkdir($csdn123_pathName, 0777);
		$csdn123_return=csdn123_dfsockopen("http://www.csdn123.net/zw_oss/zd_v6_get_img.php?siteurl=" . urlencode(APP_PATH) . "&ip=" . $_SERVER['REMOTE_ADDR'] . "&imgurl=" . urlencode($csdn123_localimgUrl));
		$csdn123_localFileName=md5($csdn123_return);
		$csdn123_ext=pathinfo($csdn123_return,PATHINFO_EXTENSION);
		if($csdn123_ext=="" || empty($csdn123_ext))
		{
			$csdn123_ext="jpg";
		}
		$csdn123_localFileName=$csdn123_localFileName . '.' . $csdn123_ext;
		$csdn123_pathName_httpUrl=$csdn123_imgurl . date('Ym',time()) . '/' . date('d',time()) . '/' . $csdn123_localFileName;
		$csdn123_localFileName=$csdn123_pathName . '/' . $csdn123_localFileName;
		$csdn123_imageData=csdn123_dfsockopen($csdn123_return);
		file_put_contents($csdn123_localFileName,$csdn123_imageData);
		echo $csdn123_pathName_httpUrl;
		
	}
	
	
	
}
}
?>