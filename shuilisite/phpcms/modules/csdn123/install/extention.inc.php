<?php

defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');

$parentid = $menu_db->insert(array('name'=>'csdn123', 'parentid'=>0, 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$parentid2 = $menu_db->insert(array('name'=>'csdn123', 'parentid'=>$parentid , 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'csdn123_bilang', 'parentid'=>$parentid2, 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'add_bilang', 'data'=>'', 'listorder'=>2, 'display'=>'1'));
$menu_db->insert(array('name'=>'csdn123_one', 'parentid'=>$parentid2, 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'add_one', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'csdn123_help', 'parentid'=>$parentid2, 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'add_help', 'data'=>'', 'listorder'=>6, 'display'=>'1'));
$menu_db->insert(array('name'=>'csdn123_admindata', 'parentid'=>$parentid2, 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'add_admindata', 'data'=>'', 'listorder'=>4, 'display'=>'1'));
$menu_db->insert(array('name'=>'csdn123_delete', 'parentid'=>$parentid2, 'm'=>'csdn123', 'c'=>'csdn123', 'a'=>'add_delete', 'data'=>'', 'listorder'=>8, 'display'=>'1'));

$language=array('csdn123'=>'众大云采集','csdn123_bilang'=>'批量采集','csdn123_one'=>'单篇采集','csdn123_help'=>'购买授权','csdn123_admindata'=>'管理采集','csdn123_delete'=>'卸载模块');

?>