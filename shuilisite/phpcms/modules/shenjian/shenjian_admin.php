<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
class shenjian_admin extends admin {
	private $siteid,$shenjian_setting_db;
	public function __construct() {
		parent::__construct();
		$this->shenjian_setting_db = pc_base::load_model('shenjian_setting_model');
		$this->siteid = $this->get_siteid();
	}
	public function settings () {
		$data = $this->shenjian_setting_db->get_one(array('siteid'=>$this->siteid));
		if (isset($_POST['dosubmit'])) {
			$web_password = isset($_POST['web_password']) && !empty($_POST['web_password']) ? $_POST['web_password'] : "shenjianshou.cn";
			$image_refer = isset($_POST['image_refer']) && intval($_POST['image_refer']) ? intval($_POST['image_refer']) : 0;
			
			$sql = array('web_password'=>$web_password, 'image_refer'=>$image_refer);
			if ($data) {
				$this->shenjian_setting_db->update($sql, array('siteid'=>$this->siteid));
			} else {
				$sql['siteid'] = $this->siteid;
				$this->shenjian_setting_db->insert($sql);
			}
			showmessage(L('operation_success'), HTTP_REFERER);
		} else {
			include $this->admin_tpl('shenjian_setting');
		}
	}
}
?>
