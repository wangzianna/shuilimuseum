<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',PHPCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);

pc_base::load_app_class('admin', 'admin', 0);
pc_base::load_sys_class('form', '', 0);

class autoNode extends admin {

	private $db,$siteid;
	
	//HTML标签
	private static $html_tag = array("<p([^>]*)>(.*)</p>[|]"=>'<p>', "<a([^>]*)>(.*)</a>[|]"=>'<a>',"<script([^>]*)>(.*)</script>[|]"=>'<script>', "<iframe([^>]*)>(.*)</iframe>[|]"=>'<iframe>', "<table([^>]*)>(.*)</table>[|]"=>'<table>', "<span([^>]*)>(.*)</span>[|]"=>'<span>', "<b([^>]*)>(.*)</b>[|]"=>'<b>', "<img([^>]*)>[|]"=>'<img>', "<object([^>]*)>(.*)</object>[|]"=>'<object>', "<embed([^>]*)>(.*)</embed>[|]"=>'<embed>', "<param([^>]*)>(.*)</param>[|]"=>'<param>', '<div([^>]*)>[|]'=>'<div>', '</div>[|]'=>'</div>', '<!--([^>]*)-->[|]'=>'<!-- -->');
	
	//网址类型
	private $url_list_type = array();
	
	function __construct() {
		parent::__construct();
		$this->db = pc_base::load_model('collection_node_model');
		$this->siteid = get_siteid();
		$this->url_list_type = array('1'=>L('sequence'), '2'=>L('multiple_pages'), '3'=>L('single_page'), '4'=>'RSS');
		
	}

	/**
	 * 批量采集列表
	 */
	public function caijiList() {
		$nodeid_=array(30,31);
		if(!empty($_GET['nodeid'])){		
			$nodeid = $_GET['nodeid'];
		}else{
			$nodeid = $nodeid_[0];
		}
		if ($data = $this->db->get_one(array('nodeid'=>$nodeid))) {
			pc_base::load_app_class('collection', '', 0);
			$urls = collection::url_list($data);
			$total_page = count($urls);
			if ($total_page > 0) {
				$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
				$url_list = $urls[$page];
				$url = collection::get_url_lists($url_list, $data);
				$history_db = pc_base::load_model('collection_history_model');
				$content_db = pc_base::load_model('collection_content_model');
				$total = count($url);
				$re = 0;
				if (is_array($url) && !empty($url)) foreach ($url as $v) {
					if (empty($v['url']) || empty($v['title'])) continue;
					$v = new_addslashes($v);
					$v['title'] = strip_tags($v['title']);
					$md5 = md5($v['url']);
					if (!$history_db->get_one(array('md5'=>$md5, 'siteid'=>$this->get_siteid()))) {
						$history_db->insert(array('md5'=>$md5, 'siteid'=>$this->get_siteid()));
						$content_db->insert(array('nodeid'=>$nodeid, 'status'=>0, 'url'=>$v['url'], 'title'=>$v['title'], 'siteid'=>$this->get_siteid()));
					} else {
						$re++;
					}
				}
				$show_header = $show_dialog = true;
				if ($total_page <= $page) {
					$this->db->update(array('lastdate'=>SYS_TIME), array('nodeid'=>$nodeid));
				}
				include $this->admin_tpl('caijiList');
			} else {
				showmessage(L('not_to_collect'));
			}
		} else {
			showmessage(L('notfound'));
		}
	}
	//批量采集文章
	public function caijiCon() {
		$nodeid_=array(30,31);
		if(!empty($_GET['nodeid'])){		
			$nodeid = $_GET['nodeid'];
		}else{
			$nodeid = $nodeid_[0];
		}
		if ($data = $this->db->get_one(array('nodeid'=>$nodeid))) {
			$content_db = pc_base::load_model('collection_content_model');
			//更新附件状态
			$attach_status = false;
			if(pc_base::load_config('system','attachment_stat')) {
				$this->attachment_db = pc_base::load_model('attachment_model');
				$attach_status = true;
			}
			pc_base::load_app_class('collection', '', 0);
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
			$total = isset($_GET['total']) ? intval($_GET['total']) : 0;
			if (empty($total)) $total = $content_db->count(array('nodeid'=>$nodeid, 'siteid'=>$this->get_siteid(), 'status'=>0));
			$total_page = ceil($total/2);
			$list = $content_db->select(array('nodeid'=>$nodeid, 'siteid'=>$this->get_siteid(), 'status'=>0), 'id,url', '2', 'id desc');
			$i = 0;
			if (!empty($list) && is_array($list)) {
				foreach ($list as $v) {
					$GLOBALS['downloadfiles'] = array();
					$html = collection::get_content($v['url'], $data);
					//更新附件状态
					if($attach_status) {
						$this->attachment_db->api_update($GLOBALS['downloadfiles'],'cj-'.$v['id'],1);
					}
					$content_db->update(array('status'=>1, 'data'=>array2string($html)), array('id'=>$v['id']));
					$i++;
				}
			} else {
				if($_SESSION['nodeid']!=count($nodeid_)){
					$_SESSION['nodeid']=$_SESSION['nodeid']+1;
					showmessage(L('正在采集中，请不要关闭...'),"?m=collection&c=autoNode&a=caijiCon&page=0&nodeid=".$nodeid_[$_SESSION['nodeid']]."&pc_hash=".$_SESSION['pc_hash']);
				}else{
					$_SESSION['nodeid']=0;
					showmessage(L('collection_success'), '?m=collection&c=node&a=manage');
				}
			}
			if ($total_page > $page) {
				showmessage(L('collectioning').($i+($page-1)*2).'/'.$total.'<script type="text/javascript">location.href="?m=collection&c=autoNode&a=caijiCon&page='.($page+1).'&nodeid='.$nodeid_[$_SESSION['nodeid']].'&total='.$total.'&pc_hash='.$_SESSION['pc_hash'].'"</script>', '?m=collection&c=autoNode&a=caijiCon&page='.($page+1).'&nodeid='.$nodeid_[$_SESSION['nodeid']].'&total='.$total);
			} else {
				$this->db->update(array('lastdate'=>SYS_TIME), array('nodeid'=>$nodeid));
				if($_SESSION['nodeid']!=count($nodeid_)){
					$_SESSION['nodeid']=$_SESSION['nodeid']+1;
					echo "<script type='text/javascript'>location.href='?m=collection&c=autoNode&a=caijiCon&page=0&nodeid=".$nodeid_[$_SESSION['nodeid']]."&pc_hash=".$_SESSION['pc_hash']."'</script>";
				}else{
					$_SESSION['nodeid']=0;
					showmessage(L('collection_success'), '?m=collection&c=node&a=manage');
				}
			}
		}
	}

	//批量导入文章
	public function caijiRep() {
		$nodeid_=array(30,31);
		if(!empty($_GET['nodeid'])){		
			$nodeid = $_GET['nodeid'];
		}else{
			$nodeid = $nodeid_[0];
		}
		if (!$node = $this->db->get_one(array('nodeid'=>$nodeid), 'coll_order,content_page')) {
			showmessage(L('node_not_found'), '?m=collection&c=node&a=manage');
		}
		$program_db = pc_base::load_model('collection_program_model');
		$collection_content_db = pc_base::load_model('collection_content_model');
		$content_db = pc_base::load_model('content_model');
		$program_list = $program_db->select(array('nodeid'=>$nodeid, 'siteid'=>$this->get_siteid()), 'id');
		$programid=$program_list[0]['id'];
		$type ='all';
		//更新附件状态
		$attach_status = false;
		if(pc_base::load_config('system','attachment_stat')) {
			$attachment_db = pc_base::load_model('attachment_model');
			$att_index_db = pc_base::load_model('attachment_index_model');
			$attach_status = true;
		}
		$order = $node['coll_order'] == 1 ? 'id desc' : '';
		$str = L('operation_success');
		$url = '?m=collection&c=node&a=publist&nodeid='.$nodeid.'&status=2&pc_hash='.$_SESSION['pc_hash'];


			$total = isset($_GET['total']) && intval($_GET['total']) ? intval($_GET['total']) : '';
			if (empty($total)) $total = $collection_content_db->count(array('siteid'=>$this->get_siteid(), 'nodeid'=>$nodeid, 'status'=>1));
			$total_page = ceil($total/20);
			$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
			$total_page = ceil($total/20);
			$data = $collection_content_db->select(array('siteid'=>$this->get_siteid(), 'nodeid'=>$nodeid, 'status'=>1), 'id, data', '20', $order);
			

		$program = $program_db->get_one(array('id'=>$programid));
		$program['config'] = string2array($program['config']);
		$_POST['add_introduce'] = $program['config']['add_introduce'];
		$_POST['introcude_length'] = $program['config']['introcude_length'];
		$_POST['auto_thumb'] = $program['config']['auto_thumb'];
		$_POST['auto_thumb_no'] = $program['config']['auto_thumb_no'];
		$_POST['spider_img'] = 0;
		$i = 0;
		$content_db->set_model($program['modelid']);
		$coll_contentid = array();
		
		//加载所有的处理函数
		$funcs_file_list = glob(dirname(__FILE__).DIRECTORY_SEPARATOR.'spider_funs'.DIRECTORY_SEPARATOR.'*.php');
		foreach ($funcs_file_list as $v) {
			include $v;
		}
		foreach ($data as $k=>$v) {
			$sql = array('catid'=>$program['catid'], 'status'=>$program['config']['content_status']);
			$v['data'] = string2array($v['data']);
			
			foreach ($program['config']['map'] as $a=>$b) {
				if (isset($program['config']['funcs'][$a]) && function_exists($program['config']['funcs'][$a])) {
					$GLOBALS['field'] = $a;
					$sql[$a] = $program['config']['funcs'][$a]($v['data'][$b]);
				} else {
					$sql[$a] = $v['data'][$b];
				}
			}
			if ($node['content_page'] == 1) $sql['paginationtype'] = 2;
			$contentid = $content_db->add_content($sql, 1);
			if ($contentid) {
				$coll_contentid[] = $v['id'];
				$i++;
				//更新附件状态,将采集关联重置到内容关联
				if($attach_status) {
					$datas = $att_index_db->select(array('keyid'=>'cj-'.$v['id']),'*',100,'','','aid');
					if(!empty($datas)) {
						$datas = array_keys($datas);
						$datas = implode(',',$datas);
						$att_index_db->update(array('keyid'=>'c-'.$program['catid'].'-'.$contentid),array('keyid'=>'cj-'.$v['id']));
						$attachment_db->update(array('module'=>'content')," aid IN ($datas)");
					}
				}
			} else {
				$collection_content_db->delete(array('id'=>$v['id']));
			}
		}
		$sql_id = implode('\',\'', $coll_contentid);
		$collection_content_db->update(array('status'=>2), " id IN ('$sql_id')");

		if ($total_page > $page) {
			$str = L('are_imported_the_import_process').(($page-1)*20+$i).'/'.$total.'<script type="text/javascript">location.href="?m=collection&c=autoNode&a=caijiRep&nodeid='.$nodeid.'&programid='.$programid.'&type=all&page='.($page+1).'&total='.$total.'&pc_hash='.$_SESSION['pc_hash'].'"</script>';
			$url = '';
		}else{
			if($_SESSION['nodeid']!=count($nodeid_)){
				$_SESSION['nodeid']=$_SESSION['nodeid']+1;
				echo "<script type='text/javascript'>location.href='?m=collection&c=autoNode&a=caijiRep&page=0&type=all&nodeid=".$nodeid_[$_SESSION['nodeid']]."&pc_hash=".$_SESSION['pc_hash']."'</script>";
			}else{
				$_SESSION['nodeid']=0;
				showmessage(L('导入完成！'), '?m=collection&c=node&a=manage');
			}
		}
	}
}
?>