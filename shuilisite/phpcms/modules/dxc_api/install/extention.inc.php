<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');

pc_base::load_app_func('dxc_api', 'dxc_api');

$parentid = $menu_db->insert(array('name'=>'dxc_api', 'parentid'=>'29', 'm'=>'dxc_api', 'c'=>'dxc_api', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);

$language = array('dxc_api'=> dxc_lang('dxc_api'));


$dxc_db = pc_base::load_app_class('dxc_api_model', 'dxc_api');
pc_base::load_app_func('dxc_api', 'dxc_api');
$installdir = PC_PATH.'modules'.DIRECTORY_SEPARATOR.'dxc_api'.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR;
if($dxc_db->table_exists('dxcapi_setting') == 0 && empty($_GET['module'])){//如果不存在数据表

    $sql = file_get_contents($installdir.'dxc_api.sql');

    dxc_sql_execute($sql, $dxc_db);

    $model_db = pc_base::load_model('module_model');
    $model_db->update(array('name' => dxc_lang('dxc_api')), array('module' => 'dxc_api'));

    $old_path = dxc_lang_path();
    $new_path = PC_PATH.'modules'.DIRECTORY_SEPARATOR.'dxc_api/install/languages/zh-cn/dxc_api.lang.php';

    @unlink($new_path);

    //拷贝语言包
    if(!$fp = fopen($new_path, 'wb')) {
        exit('插件目录需要给可写权限');
    } else {
        flock($fp, 2);
        fwrite($fp, file_get_contents($old_path));
        fclose($fp);
    }


}



?>
