<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class dxc_setting_model extends model {
	function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'dxcapi_setting';
		parent::__construct();
	}

	function get_api_key($is_force = 0){
		global $wpdb;
		$info = $this->get_one(array('name'=> 'api_key'));
	    $api_key = $info['data'];
	    if(empty($api_key) || !empty($is_force)) {
			$api_key = $this->random(20);
			$this->delete(array('name'=>'api_key'));
			$insert_id = $this->insert(array('name' => 'api_key', 'data' => $api_key), true);
	    }
	    return $api_key;
	}

	function random($length, $numeric = 0) {
		$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
		$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
		if($numeric) {
			$hash = '';
		} else {
			$hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
			$length--;
		}
		$max = strlen($seed) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $seed{mt_rand(0, $max)};
		}
		return $hash;
	}

}
?>
