<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class inquiry extends admin{
	function __construct() {
		$this->db = pc_base::load_model('inquiry_model');
	}
	function init()
	{
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->db->listinfo('','created_at DESC',$page, '10');
		$pages = $this->db->pages;
		include $this->admin_tpl('inquiry_list');
	}
	
	function read(){
		$inquiry_id = intval($_GET['inquiry_id']);
		if($inquiry_id < 1) showmessage("Invalid ID", HTTP_REFERER);
		$this->db->update(['status' => 'read'], array('id'=>$inquiry_id));
		$inquiry = $this->db->get_one(array('id' => $inquiry_id));
		//var_dump($inquiry);
		$name = $inquiry['name'];
		showmessage("The inquiry - $name has been marked as Read", HTTP_REFERER);
	}

	function delete()
	{
		if((!isset($_GET['inquiry_id']) || empty($_GET['inquiry_id']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
			$id = intval($_GET['inquiry_id']);
			if($id < 1) return false;
			$result = $this->db->delete(array('id'=>$id));
			if($result){
				showmessage('删除成功', '?m=inquiry&c=inquiry&a=init');
			}else{
				showmessage('删除失败', HTTP_REFERER);
			}
		}	
	}
}
?>