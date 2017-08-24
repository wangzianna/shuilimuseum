<?php 
defined('IN_PHPCMS') or exit('No permission resources.');
class index {
	function __construct() {
		$this->db = pc_base::load_model('inquiry_model');
		$this->_username = param::get_cookie('_username');
		$this->_userid = param::get_cookie('_userid');
	}
	
	public function init() {
		include template('inquiry', 'index');
	}
	
	/**
	 *  Create new inquiry
	 */
	public function send()  {
		if(isset($_POST['dosubmit'])){
			foreach (['title', 'name', 'email', 'content'] as $key => $value) {
				if(! isset($_POST[$value]) || empty(trim($_POST[$value]))) {
					showmessage(L("The $value field can not be empty."), HTTP_REFERER);
				}
			}
			if( ! filter_var($_POST['email'])) {
				showmessage(L('The email is invalid.'), HTTP_REFERER);
			}
			$this->db->insert([
				'title' 		=> $_POST['title'],
				'name' 			=> $_POST['name'],
				'content' 		=> $_POST['content'],
				'email' 		=> $_POST['email'],
				'phone' 		=> $_POST['phone'],
				'user_id' 		=> $this->_userid ? $this->_userid : 0,
				'updated_at' 	=> SYS_TIME,
				'created_at' 	=> SYS_TIME
			]);
			showmessage(L('添加成功'), HTTP_REFERER);
		}  else  {
			echo  '请通过正常的方式提交留言，谢谢';
		}
	}
}
?>