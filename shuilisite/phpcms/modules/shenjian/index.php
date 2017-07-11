<?php
defined('IN_PHPCMS') or exit('No permission resources.');
class index {
	private $shenjian_setting_db,$settings,$category_db,$content_db;
	public function __construct() {
		//open error display
		ini_set("display_errors", "On");
		error_reporting(E_ALL | E_STRICT);

		pc_base::load_app_func('global');
		$this->shenjian_setting_db = pc_base::load_model('shenjian_setting_model');
		$this->settings = $this->shenjian_setting_db->get_one();
	}
	public function post(){
		$request_data = mergeRequest();
		$web_password = $this->settings["web_password"];
		if (empty($request_data['__sign']) || $request_data['__sign'] != $web_password) {
			ta_fail(TA_ERROR_INVALID_PWD, "password is wrong", L("error_password"));
		}

		if(!isset($request_data["modelid"])){
			ta_fail(TA_ERROR_MISSING_FIELD, "invalid modelid", L("error_empty_model"));
		}
		$modelid = intval($request_data["modelid"]);
		$siteid = isset($request_data["siteid"])?intval($request_data["siteid"]):$this->settings["siteid"];
		$this->category_db = pc_base::load_model('category_model');
		$title = $this->gbkutf8($request_data["article_title"]);
		$content = $this->gbkutf8($request_data["article_content"]);
		$post = array();
		$post['status'] = 99;

		if (empty($content) || empty($title)) {
			ta_fail(TA_ERROR_MISSING_FIELD, "article_content and article_title are both empty", L("error_empty_content"));
		}

		if(!empty($title)){
			$post['title'] = $title;
		}
		if(!empty($content)){
			$post['content'] = $content;
		}


		$author = $this->gbkutf8($request_data["article_author"]);

		if(!empty($author)){
			$post['username'] = $author;
		}

		$publish_time = intval($request_data["article_publish_time"]);
		if(!empty($publish_time)){
			$post['inputtime'] = $publish_time;
		}
		
		$article_categories = $this->gbkutf8($request_data["article_categories"]);
		if (!empty($article_categories)) {
			$raw_cates = stripslashes($article_categories);
			$cates = json_decode($raw_cates);
			if (is_array($cates)) {
				$post_cates = array();
				foreach ($cates as $cate) {
					$cate = addslashes($cate);
					$category = $this->category_db->get_one("catid='".$cate."' OR catname='".$cate."'");
					$catid = 0;
					if (!$category) {
						$info = array();
						$info["catname"] = $cate;
						$info["siteid"] = $siteid;
						$info["module"] = "content";
						$info["type"] = 0;
						$info["modelid"] = $modelid;
						$info["catdir"] = "catdir".time();
						$info["parentid"] = intval($request_data["category_parent"]);
						$catid = $this->category_db->insert($info);
					}else{
						$catid = intval($category["catid"]);
					}
					if ($catid) {
						array_push($post_cates, $catid);
					}
				}
				if (count($post_cates) <= 0) {
					ta_fail(TA_ERROR_MISSING_FIELD, "category is empty", L("error_category"));
				}
				$post['catid'] = $post_cates[0];
				if(count($post_cates) > 1){
					$post['othor_catid'] = array_slice($post_cates,1);
				}
			}
		}
		$cate_id = $post['catid'];


		$article_topics = $this->gbkutf8($request_data["article_topics"]);
		if (!empty($article_topics)) {
			$raw_tags = stripslashes($article_topics);
			$tags = json_decode($raw_tags);
			if (is_array($tags)) {
				$post["keywords"] = implode($tags,",");
			}
		}

		if (!empty($request_data["article_thumbnail"])) {
			$post["thumb"] = $request_data["article_thumbnail"];
		}else{
			$_POST['auto_thumb'] = "true";
		}

		$this->content_db = pc_base::load_model('content_model');
		$this->content_db->set_model($modelid);

		$id = $this->content_db->add_content($post,true);
		if(!$id){
			ta_fail(TA_ERROR_ERROR, "Empty Post ID", L("error_insert_fail"));
		}
		$url = APP_PATH."index.php?m=content&c=index&a=show&catid=".$cate_id."&id=".$id;

		//insert comment
		$comment_module = pc_base::load_app_class('comment','comment');
		$comment_json = preg_replace("/[\r\n\t]/", '', $this->gbkutf8($request_data['article_comment']));
		$article_comment = json_decode(stripslashes($comment_json), true);
		if ($comment_module!== false && $article_comment != null && is_array($article_comment)) {
					
			foreach ($article_comment as $comment) {
				$content = $comment["article_comment_content"];
				if (!empty($content)) {
					//content is not empty
					$commentid = "content_".$cate_id."-".$id."-".$siteid;
					$cdata = array(
						'userid' => 0,
						'content' => $content,
						'direction' => 0
					);
					$cauthor = $comment["article_comment_author"];
					if (!empty($cauthor)) {
						$cdata["username"] = $cauthor;
					}else{
						$cdata["username"] = L("user_anonymous");
					}

					$comment_module->add($commentid,$siteid,$cdata,$id,$title,$url);
				}
			}
		}


		
		ta_success(array("url" => $url));
	}
	public function details(){
		$request_data = mergeRequest();
		$siteid = isset($request_data["siteid"])?intval($request_data["siteid"]):$this->settings["siteid"];
		$web_password = $this->settings["web_password"];
		if (empty($request_data['__sign']) || $request_data['__sign'] != $web_password) {
			ta_fail(TA_ERROR_INVALID_PWD, "password is wrong", L("error_password"));
		}
		if(isset($request_data["type"]) && $request_data["type"]=="cate"){
			$result = getcache('category_content_'.$siteid,'commons');
			$model_id = 1;//default for article model
			if(isset($request_data["model_id"])){
				$model_id = intval($request_data["model_id"]);
			}
			$categories = array();
			if(!empty($result)) {
				foreach($result as $r) {
					if(intval($r["modelid"]) == $model_id){
						$categories[] =array("value"=>$r['catid'],"text"=>$r['catname']);
					}
				}
			}
			ta_success($categories);
		}
	}
	public function version(){
		$web_password = $this->settings["web_password"];
		if (empty($request_data['__sign']) || $request_data['__sign'] != $web_password) {
			ta_fail(TA_ERROR_INVALID_PWD, "password is wrong", L("error_password"));
		}
		$phpcms_version = pc_base::load_config('version','pc_version');
		$versions = array(
			'php' => PHP_VERSION,
			'plugin' => "1.0.0",
			'pc' => $phpcms_version,
		);
		ta_success($versions);
	}

	private function gbkutf8($data){
		if(CHARSET != 'utf-8'){
			$data = iconv('utf-8', CHARSET, $data);
		}
		return $data;
	}
}
?>
