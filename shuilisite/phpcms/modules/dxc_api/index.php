<?php
defined('IN_PHPCMS') or exit('No permission resources.');

//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);

define("DXC_VERSION", '1.0.0');
define("DXC_PLUGIN_DIR", PC_PATH.'/modules/dxc_api/');


define("SITEID", get_siteid());

//ini_set("display_errors", "On");
//error_reporting(E_ALL);

class index {

	private $db;
	private $db2;
	public $category = '';
	private $sdk;

	function __construct() {

		pc_base::load_app_func('global');
		$this->username = param::get_cookie('_username');
		$this->userid = param::get_cookie('_userid');
		$this->groupid = param::get_cookie('_groupid');
		$this->ip = ip();

		$this->db = pc_base::load_app_class('dxc_api_model');
		$this->db2 = pc_base::load_app_class('dxc_setting_model');
		$this->sdk = pc_base::load_app_class('dxcsdk');
		$this->sdk->charset = CHARSET;

		$this->siteid = SITEID;


 	}

	public function init() {
		$siteid = SITEID;
		$action = $_POST['action'];
		$api_key = $_POST['api_key'];


		if(empty($action) || empty($api_key)) return;
		$allow_actions = array('api_info', 'category_list', 'category_relation_list', 'field_data', 'post_data', 'attach_upload');
		if(!in_array($action, $allow_actions)) return;


		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());

		$ori_api_key = $this->get_api_key();



		if($ori_api_key != $api_key){
			$result_data['status'] = -1;
			$result_data['msg'] = L('api_key_err1');
			echo $this->sdk->json_encode($result_data);
			exit();
		}

		$this->categorys = getcache('category_content_'.$this->siteid,'commons');
		ob_end_clean();
		ob_start();
		echo $this->sdk->json_encode($this->$action());
		exit();


	}

	function api_info(){

		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());

		$system['cms_type'] = 'phpcms';
		$system['cms_vertion'] = pc_base::load_config('version');
		$system['api_version'] = DXC_VERSION;
		$system['charset'] = CHARSET;

		$result_data['data'] = $system;

		return $result_data;
	}

	function category_list(){

		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());
		$categorys = getcache('category_content_'.$this->siteid,'commons');
		$categery_data = array();
		foreach ($categorys as $key => $value) {
			if($value['type'] == 1) continue;
			$categery_data[] = array('id' => $value['catid'], 'name' => $value['catname'], 'parent_id' => $value['parentid'], 'disabled' =>  0);
		}

		$result_data['data']['categery_data'] = $categery_data;
		$result_data['data']['api_callback'] = 'category_relation_list';//选择分类是否需要回调请求

		return $result_data;


	}

	function category_relation_list(){

		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());

		$categorys = getcache('category_content_'.$this->siteid,'commons');

		$catid = $_POST['cat_data']['catid'];


		$categery_data = array();
		foreach ($categorys as $key => $value) {
			if($value['type'] == 1) continue;
			$categery_data[] = array('id' => $value['catid'], 'name' => $value['catname'], 'parent_id' => $value['parentid'], 'disabled' =>  ( $value['child'] > 0 || $catid == $value['catid']) ? 1 : 0);
		}


		$field_data['relation_ids'] = array('id' => 'relation_ids', 'name' => L('post_relation'), 'type' => 'checkbox_list', 'data' => $categery_data);

	    $result_data['data'] = $field_data;


		return $result_data;


	}

	function field_data(){

		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());

		$catid = $_POST['cat_data']['catid'];


		$tpl_data = array(

			'title' => array(
				'name' => L('title'),
			),
			'content' => array(
				'name' => L('content'),
			),

			'inputtime' => array(
				'name' => L('public_time'),
			),

			'thumb' => array(
				'name' => L('thumb'),
			),

			'comment' => array(
				'name' => L('comment'),
			),

			'comment_time' => array(
				'name' => L('reply_time'),
			),

		);

		pc_base::load_sys_class('form','',0);
		require CACHE_MODEL_PATH.'content_form.class.php';

		$ext_field_data = $this->get_fields($catid);

		$new_ext_field_data = array();

		$no_allow_field = array('catid', 'keywords', 'copyfrom', 'islink');//不要的字段

		foreach ($ext_field_data as $key => $value) {
			if($tpl_data[$key]) continue;
			if(in_array($key, $no_allow_field)) continue;
			$new_ext_field_data[$key] = array('name' => $value['name']);
		}



		$result_data['data']['bind'] = array_merge($tpl_data, $new_ext_field_data);


		return $result_data;

	}

	function get_api_key(){
		return $this->db2->get_api_key();
	}



	function attach_upload(){

		$api_key = $_POST['api_key'];
		$api_id = intval($_POST['api_id']);

		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());

		$re = dxcsdk::upload(DXC_PLUGIN_DIR.'/data/');

	    if($re < 0) {
	        $result_data['status'] = -2;
	        $result_data['msg'] = L('attach_dir_no_write');
			return $result_data;
	    } else {
	        return $result_data;
	    }

	}

	function post_data(){

		$api_key = $_POST['api_key'];
		$api_id = intval($_POST['api_id']);

		$result_data = array('status' => 0, 'msg'=> 'ok', 'data' => array());


		$post_data = dxcsdk::get_post_data(DXC_PLUGIN_DIR.'/data/');

		//发布

		$title = $post_data['field_data']['title'];
		$content = $post_data['field_data']['content'];

		if(empty($title) || empty($content)){
			$result_data['status'] = -3;
			$result_data['msg'] = L('title_content_empty');
			return $result_data;
		}


		$length = empty($title) ? 0 : (is_string($title) ? strlen($title) : count($title));
		if($length > 80){
			$result_data['status'] = -4;
			$result_data['msg'] = 'title'.' '.L('not_more_than').' '.'80 '.L('characters');
			return $result_data;
		}

		$tree = pc_base::load_sys_class('tree');
		$data = getcache('sitelist', 'commons');
		$this->categorys = getcache('category_content_'.$this->siteid,'commons');



		$is_edit = 0;//判断是否是编辑

		//检测是否发布过
		if(!empty($post_data['data_id'])){
			$data_id_arr = explode('|', $post_data['data_id']);

			$old_catid = $data_id_arr[0];
			$old_data_id = $data_id_arr[1];

			$model = getcache('model', 'commons');
			$category = $this->categorys[$old_catid];
			$modelid = $category['modelid'];
			$content_model_db = pc_base::load_model('content_model');
			$content_model_db->table_name = $content_model_db->db_tablepre.$model[$modelid]['tablename'];
			$r = $content_model_db->get_one(array('id'=> $old_data_id));
			$content_model_db->table_name = $content_model_db->table_name.'_data';
			$r2 = $content_model_db->get_one(array('id'=> $old_data_id));
			if(!empty($r2['id'])){
				$is_edit = 1;
				//删除附件
				$keyid = 'c-'.$old_catid.'-'.$old_data_id;
				$att_index_db = pc_base::load_model('attachment_index_model');
				$datas = $att_index_db->listinfo(array('keyid' => $keyid), $order = 'aid DESC');
				$att_db = pc_base::load_model('attachment_model');
				if(count($datas) > 0){
					$aids = array();
					foreach ($datas as $key => $value) {
						$aids[] = $value['aid'];
					}
					$where_sql = ' aid IN ('.implode(',', $aids).')';
					$attach_datas = $att_db->select($where_sql);
					$upload_root = pc_base::load_config('system','upload_path');
					foreach ($attach_datas as $key => $value) {
						$filepath = $upload_root.$value['filepath'];
						@unlink($filepath);
					}

					$att_db->delete($where_sql);//删除记录

				}

				//删除评论
				if(module_exists('comment')){
					$comment_obj = pc_base::load_app_class('comment', 'comment');
					$commentid = id_encode('content_'.$old_catid, $old_data_id, $this->siteid);
					$comment_obj->del($commentid, $this->siteid, $old_data_id, $old_catid);
				}


			}


		}



		//分页符号 [page]

		$post_data['field_data']['status'] = 99;
		//$post_data['field_data']['pictureurls'] = 1;
		$post_data['field_data']['allow_comment'] = 1;
		$post_data['field_data']['allow_comment'] = 1;
		$post_data['field_data']['posids'][0] = -1;

		$relation_ids = array();

		foreach ($post_data['post_config']['cat_data']['ext_catid']['relation_ids'] as $key => $value) {
			$value = trim($value);
			if(empty($value)) continue;
			$relation_ids[] = $value;
		}
		$post_data['post_config']['cat_data']['ext_catid']['relation_ids'] = $relation_ids;
		$post_data['field_data']['relation'] = implode('|', $post_data['post_config']['cat_data']['ext_catid']['relation_ids']);//同时发布到其他栏目
		$othor_catid = array();
		foreach ($post_data['post_config']['cat_data']['ext_catid']['relation_ids'] as $key => $value) {
			$othor_catid[$value] = '';
		}
		$_POST['othor_catid'] = $othor_catid;

		$catid =  $post_data['post_config']['cat_data']['catid'];//这是要发布到栏目

		//print_r($post_data['post_config']['cat_data']);

		//var_dump($catid);exit();


		if(!empty($post_data['field_data']['inputtime'])){//如果有发布时间,进行转换
			$new_date = strtotime($post_data['field_data']['inputtime']);
			$post_data['field_data']['inputtime'] = date('Y-m-d H:i:s', $new_date);
		}else{
			//发布时间
			$post_data['field_data']['inputtime'] = dxcsdk::create_public_time($post_data['post_config']['field_ext']['public_time'], 0, 1, 0);

		}

		if($post_data['attach_list']['thumb']){
			$attach_data = $this->attach_add($post_data['attach_list']['thumb']['attach'], $catid, 'content');
			if($attach_data['aid']){
				$post_data['field_data']['thumb'] = $attach_data['url'];
			}
		}



		//发布者uid
		$public_user_data = $this->get_user_uid($post_data['post_config']['field_ext']);
		$post_data['field_data']['username'] = $public_user_data['name'];


		$content_db = pc_base::load_model('content_model');



		$modelid = $this->categorys[$catid]['modelid'];
		$content_db->set_model($modelid);
		$tablename = $content_db->model[$modelid]['tablename'];


		//处理分页
		if(is_array($post_data['field_data']['content'])){
			$new_attach_list = array();
			foreach($post_data['attach_list']['content'] as $k => $v){
				$new_attach_list = array_merge($new_attach_list, $v);
			}
			$post_data['attach_list']['content'] = $new_attach_list;
			$page_str = ($tablename != 'picture' && $tablename != 'download') ? '[page]' : '';
			$post_data['field_data']['content'] = implode($page_str, $post_data['field_data']['content']);
			$content = $post_data['field_data']['content'];
		}

		$modelid = $category['modelid'];

		$attach_arr = $post_data['attach_list']['content'];





		$attach_data_inserts = array();

		$_POST['pictureurls_url'] = array();
		$_POST['pictureurls_alt'] = array();

		//处理a标签
		foreach($attach_arr as $key => $attach_info){

			if($attach_info['isimage'] == 1){
				continue;
			}

			$text = $attach_info['text'] ? $attach_info['text'] : $attach_info['url'];
			$imagereplace['search'][$key] = $attach_info['ref'];
			$imagereplace['replace'][$key] = '<a href="'.$attach_info['url'].'" >'.$text.'</a>';

			if(empty($attach_info['content']) || empty($attach_info['ext'])) {
				continue;
			}

			$attach_data = $this->attach_add($attach_info, $catid, 'content');

			if($attach_data['aid'] < 0) continue;
			$_POST['pictureurls_url'][] = $attach_data['url'];
			$_POST['pictureurls_alt'][] = $attach_info['text'];
			$attach_data_inserts[] = $attach_data;

			$imagereplace['replace'][$key] = '<a href="'.$attach_data['url'].'" >'.($text ? $text: $attach_data['url']).'</a>';

		}


		$content = str_replace($imagereplace['search'], $imagereplace['replace'], $content);


		$imagereplace = array();


		//处理img标签
		$max_img_data = array('max_area' => 0, 'attach_id' => 0);

		foreach($attach_arr as $key => $attach_info){

			if($attach_info['isimage'] == 0){
				continue;
			}


			$imagereplace['search'][$key] = $attach_info['ref'];
			if($tablename != 'picture'){//如果不是图片模型
				$imagereplace['replace'][$key] = '<img src="'.$attach_info['url'].'" alt="'.$attach_info['text'].'" />';
			}else{
				$imagereplace['replace'][$key] = '';
			}

			if(empty($attach_info['content']) || empty($attach_info['ext'])) {
				continue;
			}

			$attach_data = $this->attach_add($attach_info, $catid, 'content');
			if($attach_data['aid'] < 0) continue;

			$attach_data_inserts[] = $attach_data;

			$_POST['pictureurls_url'][] = $attach_data['url'];
			$_POST['pictureurls_alt'][] = $attach_info['text'];

			if($attach_data['width']*$attach_data['height'] > $max_img_data['max_area']){
				$max_img_data['max_area'] = $attach_data['width']*$attach_data['height'];
				$max_img_data['attach_id'] = $attach_data['attach_id'];
			}


			if($tablename != 'picture'){//如果不是图片模型
				$imagereplace['replace'][$key] = '<img src="'.$attach_data['url'].'" alt="'.$attach_info['text'].'" />';
			}else{
				$imagereplace['replace'][$key] = '';
			}

		}


		$content = str_replace($imagereplace['search'], $imagereplace['replace'], $content);

		$_POST['downfiles_fileurl'] = array();
		$_POST['downfiles_filename'] = array();

		if($tablename == 'download' && !empty($post_data['field_data']['downfiles'])){//如果是下载
			if(!is_array($post_data['field_data']['downfiles'])) {
				$post_data['field_data']['downfiles'] = array($post_data['field_data']['downfiles']);
				$post_data['attach_list']['downfiles'] = array($post_data['attach_list']['downfiles']);
			}
			$downfiles_attachs = $post_data['attach_list']['downfiles'];

			$filesize = 0;
			foreach ($downfiles_attachs as $key => $value) {
				$attach_info = $value['attach'];

				$attach_data = $this->attach_add($attach_info, $catid, 'content');

				if($attach_data['aid'] < 0) continue;

				$filesize += $attach_info['size'];

				$_POST['downfiles_fileurl'][] = $attach_data['url'];
				$_POST['downfiles_filename'][] = $attach_info['text'];

				$attach_data_inserts[] = $attach_data;

			}

			$post_data['field_data']['filesize'] = $post_data['field_data']['filesize'] > 0 ? $post_data['field_data']['filesize'] : $filesize.' B';

		}



		$post_data['field_data']['content'] = $content;
		$post_data['field_data']['catid'] = $catid;
		$post_data['field_data']['paginationtype'] = 2;
		$_POST['auto_thumb_no'] = 1;
		$_POST['introcude_length'] = 200;
		$_POST['auto_thumb'] = 1;
		$_POST['add_introduce'] = 1;




		require_once(PC_PATH.'/modules/admin/classes/admin.class.php');


		define('IN_ADMIN', true);
		define('SYS_STYLE', 'zh-cn');

		//print_r($post_data['field_data']);exit();
		if($is_edit == 1){
			$content_db->edit_content($post_data['field_data'], $old_data_id);
			$post_id = $old_data_id;
		}else{
			$post_id = $content_db->add_content($post_data['field_data']);
		}



		if($post_id && count($attach_data_inserts) > 0){
			$att_index_db = pc_base::load_model('attachment_index_model');
			foreach ($attach_data_inserts as $key => $value) {
				$keyid = 'c-'.$catid.'-'.$post_id;
				$att_index_db->insert(array('keyid'=>$keyid,'aid'=> $value['aid']));
			}
		}
		if(!empty($post_data['post_config']['field_ext']['view_num'])){//如果设置了文章查看数
			$model = getcache('model', 'commons');
			$category = $this->categorys[$catid];
			$modelid = $category['modelid'];
			$views = dxcsdk::get_rand_data($post_data['post_config']['field_ext']['view_num']);
			$hits_db = pc_base::load_model('hits_model');
			$hitsid = 'c-'.$modelid.'-'.$post_id;
			$hits_db->update(array('views' => $views), array('hitsid' => $hitsid));
		}

		$data_url = 'http://'.SITE_URL.WEB_PATH.'index.php?m=content&c=index&a=show&catid='.$catid.'&id='.$post_id;

		if(!empty($post_data['field_data']['comment'])){//如果有评论

			$commentid = id_encode('content_'.$catid, $post_id, $this->siteid);
			$comment_count = count($post_data['field_data']['comment']);
			$post_data['post_config']['field_ext']['reply_time'] = $post_data['post_config']['field_ext']['reply_time'] ? $post_data['post_config']['field_ext']['reply_time'] : 2;
			$time_arr = dxcsdk::create_public_time($post_data['post_config']['field_ext'], strtotime($post_data['field_data']['inputtime']), $comment_count, 1);
			$uid_datas = $this->get_user_uid($post_data['post_config']['field_ext'], $comment_count);
			$default_userid = 1;
			$default_username = 'admin';
			$title = $post_data['field_data']['title'];
			$url = $data_url;
			$comment_obj = pc_base::load_app_class('comment', 'comment');
			foreach ($post_data['field_data']['comment'] as $key => $value) {

				$content = $value;
				$direction = '';

				$userid = $uid_datas[$key]['ID'];
				$username = $uid_datas[$key]['name'];
				$comment_time = $post_data['field_data']['comment_time'][$key];
				if(!empty($comment_time)) {
					$comment_time = strtotime($comment_time);
				}

				if(!$comment_time) $comment_time  = $time_arr[$key];


				if(empty($userid)){
					$userid = $default_userid;
					$username = $default_username;
				}

				$data = array('userid'=>$userid, 'username'=>$username, 'content'=>$content, 'direction'=>$direction);

				$re = $comment_obj->add($commentid, $this->siteid, $data, $post_id, $title, $url);
				if($re && $comment_time){//更新发布时间
					$comment_data_db = pc_base::load_model('comment_data_model');
					$info = $comment_data_db->get_one(array('commentid' => $commentid), 'id', 'id DESC');
					$comment_data_db->update(array('creat_at' =>$comment_time), array('id' => $info['id']) );
				}

			}

		}


		$result_data['data']['data_id'] = $catid.'|'.$post_id;
		$result_data['data']['data_url'] = $data_url;



		return $result_data;



	}







	function get_user_uid($api_info, $num = 1){
		$member_db = pc_base::load_model('member_model');
		$uid_set_rules = $num == 1 ? $api_info['public_uid'] : $api_info['reply_uid'];
		$user_table = $wpdb->prefix.'users';
		$no_uid_sql = '';
		$sql = '';
		$limit_str = $num ==1 ? " 1" : " 0,$num";
		$default_datas = array('ID' => '1', 'name' => 'admin');
		if(dxcsdk::strexists($uid_set_rules, '|')){

			$uid_arr = explode('|', $uid_set_rules);
			$uid_arr = array_filter($uid_arr);
			$datas = $member_db->select("$no_uid_sql userid IN (".implode(',', $uid_arr).") ".$sql, 'userid,username', $limit_str, 'rand()');
			$new_arr = array();
			foreach ($datas as $key => $value) {
				$new_arr[] = array('ID' => $value['userid'], 'name' => $value['username']);
			}
			if(count($new_arr) == 1) return $new_arr[0];
			if(count($new_arr) > 0) return $new_arr;


		}else if(dxcsdk::strexists($uid_set_rules, ',')) {
			$range_arr = dxcsdk::format_wrap($uid_set_rules, ',');
			$max = intval($range_arr[1]) + 1;
			$min = intval($range_arr[0]) - 1;
			if($max < 0 || $min < 0 || (($max - $min) < 0 )) return $default_datas;
			$datas = $member_db->select("$no_uid_sql userid<$max AND userid>$min ".$sql, 'userid,username', $limit_str, 'rand()');
			$new_arr = array();
			foreach ($datas as $key => $value) {
				$new_arr[] = array('ID' => $value['userid'], 'name' => $value['username']);
			}
			if(count($new_arr) == 1) return $new_arr[0];
			if(count($new_arr) > 0) return $new_arr;

		}else if(!empty($uid_set_rules)){
			$user_info = $member_db->get_one(array('userid'=> $uid_set_rules));
			if($user_info['userid']) return array('ID' => $user_info['userid'], 'name' => $user_info['username']);
		}
		return array('ID' => '1', 'name' => 'admin');//默认管理员
	}






	function attach_add($attach_info, $catid, $module){

		$admin_username = $_SESSION['roleid'];
		$userid = $_SESSION['userid'] ? $_SESSION['userid'] : (param::get_cookie('_userid') ? param::get_cookie('_userid') : sys_auth($_POST['userid_flash'],'DECODE'));
		$isadmin = 2;
		$groupid = param::get_cookie('_groupid') ? param::get_cookie('_groupid') : 8;
		$grouplist = getcache('grouplist','member');

		pc_base::load_sys_class('attachment','',0);
		$siteid = $this->siteid;
		$siteinfo = getcache('sitelist', 'commons');

		$site_setting = string2array($siteinfo[$siteid]['setting']);
		$site_allowext = $site_setting['upload_allowext'];
		$attachment = new attachment($module,$catid,$siteid);
		$attachment->set_userid($userid);

		$upload_root = pc_base::load_config('system','upload_path');
		$dir = date('Y/md/');
		$savepath = $upload_root.$dir;

		if(!dir_create($savepath)) {
			return '-8';
			return false;
		}
		if(!is_dir($savepath)) {
			return '-8';
		}

		@chmod($savepath, 0777);


		$temp_filename = date('Ymdhis').rand(100, 999).'.'.$attach_info['ext'];
		$savefile = $savepath.$temp_filename;

		$savefile = preg_replace("/(php|phtml|php3|php4|jsp|exe|dll|asp|cer|asa|shtml|shtm|aspx|asax|cgi|fcgi|pl)(\.|$)/i", "_\\1\\2", $savefile);
		$filepath = preg_replace(new_addslashes("|^".$this->upload_root."|"), "", $savefile);
		if(!$fp = fopen($savefile, 'wb')) {
	        return -1;
	    } else {
	        flock($fp, 2);
	        fwrite($fp, $attach_info['content']);
	        fclose($fp);
	    }




		pc_base::load_sys_class('image','','0');

		$thumb_enable = is_array($thumb_setting) && ($thumb_setting[0] > 0 || $thumb_setting[1] > 0 ) ? 1 : 0;
		$watermark_enable = 1;
		$image = new image($thumb_enable, $siteid);
		if($thumb_enable) {
			$image->thumb($savefile,'',$thumb_setting[0],$thumb_setting[1]);
		}
		if($watermark_enable) {
			$image->watermark($savefile, $savefile);
		}

		//debug
		$temp = $attach_info;
		unset($temp['content']);


		$att_db = pc_base::load_model('attachment_model');
		$uploadedfile['filepath'] = $dir.$temp_filename;
		$uploadedfile['module'] = $module;
		$uploadedfile['catid'] = $catid;
		$uploadedfile['siteid'] = $siteid;
		$uploadedfile['userid'] = $userid;
		$uploadedfile['filesize'] = $attach_info['size'];
		$uploadedfile['fileext'] = $attach_info['ext'];
		$uploadedfile['uploadtime'] = SYS_TIME;
		$uploadedfile['uploadip'] = ip();
		$uploadedfile['status'] = 1;
		$uploadedfile['authcode'] = md5($uploadedfile['filepath']);
		$uploadedfile['filename'] = $temp_filename;
		$uploadedfile['isimage'] = 1;
		$aid = $att_db->api_add($uploadedfile);

		$upload_url = pc_base::load_config('system','upload_url').$dir.$temp_filename;
		$attach_data = array('aid' => $aid, 'url' => $upload_url);
		return $attach_data;

	}




	function get_fields($catid){
		$category = $this->categorys[$catid];
		$modelid = $category['modelid'];
		//取模型ID，依模型ID来生成对应的表单
		$content_form = new content_form($modelid, $catid, $this->categorys);

		//print_r($content_form->fields);
		$forminfos = $content_form->get();
		return $forminfos;
		//print_r($forminfos);exit('asdasfsa');
	}






}
?>
