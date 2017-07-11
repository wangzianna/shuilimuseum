<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//ini_set("display_errors", "On");
//error_reporting(E_ALL);
pc_base::load_app_class('admin','admin',0);
pc_base::load_app_func('dxc_api', 'dxc_api');

class dxc_api extends admin {
	private $db;
	private $db2;
	public $category = '';
	function __construct() {
		parent::__construct();
		$this->M = new_html_special_chars(getcache('dxc_api', 'commons'));
		$this->db = pc_base::load_app_class('dxc_api_model');
		$this->db2 = pc_base::load_app_class('dxc_setting_model');
		$this->siteid = get_siteid();
		dxc_lang('load');


	}



	public function init() {
		$is_force = intval($_GET['is_force']);
		$api_key = $this->db2->get_api_key($is_force);
		include $this->admin_tpl('info');
 	}


	function category_show($parentid = 0, $catid, $classids){
		$show_html = '<ul class="categorychecklist">';
		foreach ($this->categorys as $key => $value) {
			if($value['type'] == 1) continue;
			if($value['parentid'] != $parentid) continue;
			$children_html = $this->category_show($value['catid'], $catid, $classids);
			$disabled = $value['child'] > 0 || $catid == $value['catid'] ? 'disabled' : '';
			$disabled_class = $value['child'] > 0 || $catid == $value['catid'] ? 'disabled_class' : '';
			$checked = in_array(intval($value['catid']), $classids) ? 'checked="checked"' : '';
			$show_html .= '<li><label class="selectit '.$disabled_class.'">'.($parentid > 0 ? dxc_lang('aaaaa') : '').' <input '.$checked.' value="'.$value['catid'].'" '.$disabled.' type="checkbox" name="relation_ids[]" id="in-category-1"> '.$value['catname'].'</label>'.$children_html.'</li>';
		}
		$show_html .= '</ul>';
		return $show_html;

	}

	function category_show_select($parentid = 0, $catid, $level = 0){
		$show_html = $parentid == 0 ? '<select name="catid">' : '';
		foreach ($this->categorys as $key => $value) {
			if($value['type'] == 1) continue;
			if($value['parentid'] != $parentid) continue;
			$disabled = $value['child'] > 0 ? 'disabled' : '';
			$children_html = $this->category_show_select($value['catid'], $classids, $level + 1);
			$checked = intval($value['catid']) == $catid ? 'selected="selected"' : '';
			$show_html .= '<option '.$checked.' '.$disabled.' value="'.$value['catid'].'">'.str_repeat('--', $level).$value['catname'].'</option>'.$children_html;
		}
		$show_html .=  $parentid == 0 ? '</select>' : '';
		return $show_html;

	}




}
?>
