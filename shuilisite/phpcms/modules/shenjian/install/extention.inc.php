<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'shenjian', 'parentid'=>'29', 'm'=>'shenjian', 'c'=>'shenjian_admin', 'a'=>'settings', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);

require_once dirname(__FILE__).'/languages/zh-cn/shenjian.lang.php';

$module_db = pc_base::load_model('module_model');
if($module_db !== false){
	$module_db->update(array("name"=>$LANG["shenjian"],"description"=>$LANG["shenjian_info"]),"module='shenjian'");
}
?>