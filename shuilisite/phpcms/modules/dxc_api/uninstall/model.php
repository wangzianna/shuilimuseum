<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('UNINSTALL') or exit('Access Denied');

$dxc_db = pc_base::load_app_class('dxc_api_model', 'dxc_api');
pc_base::load_app_func('dxc_api', 'dxc_api');
$uninstalldir = PC_PATH.'modules'.DIRECTORY_SEPARATOR.'dxc_api'.DIRECTORY_SEPARATOR.'uninstall'.DIRECTORY_SEPARATOR;

if($dxc_db->table_exists('dxcapi_setting')){//如果存在数据表
    $sql = file_get_contents($uninstalldir.'dxc_api.sql');
    dxc_sql_execute($sql, $dxc_db);
    $model_db = pc_base::load_model('module_model');
    $model_db->delete(array('module' => 'dxc_api'));
}

return;
?>
