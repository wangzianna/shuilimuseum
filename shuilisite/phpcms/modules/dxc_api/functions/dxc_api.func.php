<?php
defined('IN_PHPCMS') or exit('No permission resources.');

$dxc_lang_data;

function dxc_sql_execute($sql, $m_db) {
    $sqls = dxc_sql_split($sql, $m_db);

    if (is_array($sqls)) {
        foreach ($sqls as $sql) {
            if (trim($sql) != '') {
                $m_db->query($sql);
            }
        }
    } else {
        $m_db->query($sqls);
    }
    return true;
}

function dxc_sql_split($sql, $m_db) {

    $dbcharset = $GLOBALS['dbcharset'];
    if (!$dbcharset) {
        $dbcharset = pc_base::load_config('database','default');
        $dbcharset = $dbcharset['charset'];
    }
    if($m_db->version() > '4.1' && $dbcharset) {
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$dbcharset, $sql);
    }
    if($m_db->db_tablepre != "phpcms_") $sql = str_replace("phpcms_", $m_db->db_tablepre, $sql);
    $sql = str_replace(array("\r", '2010-9-05'), array("\n", date('Y-m-d')), $sql);
    $ret = array();
    $num = 0;
    $queriesarray = explode(";\n", trim($sql));
    unset($sql);
    foreach ($queriesarray as $query) {
        $ret[$num] = '';
        $queries = explode("\n", trim($query));
        $queries = array_filter($queries);
        foreach ($queries as $query) {
            $str1 = substr($query, 0, 1);
            if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
        }
        $num++;
    }
    return $ret;
}

function dxc_lang($var){
	global $dxc_lang_data;
	if(!empty($dxc_lang_data)){
		return $dxc_lang_data[$var] ? $dxc_lang_data[$var] : L($var);
	}
	require_once dxc_lang_path();
	$dxc_lang_data  = $LANG;
	return $LANG[$var];
}

function dxc_lang_path(){
	$charset_str = CHARSET == 'gbk' ? '_gbk' : '_utf8';
	return PC_PATH.'modules'.DIRECTORY_SEPARATOR.'dxc_api/install/languages/dxc_api'.$charset_str.'.lang.php';
}


?>
