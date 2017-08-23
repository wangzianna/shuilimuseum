<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="main container">
    <div class="row main-content-1">
        <div class="col col-md-4 col-sm-4 content-1">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="<?php echo IMG_PATH;?>b2.jpg" alt="">
                        <div class="carousel-caption f-thide">
                            中国水利博物馆开馆
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo IMG_PATH;?>p1.jpg" alt="">
                        <div class="carousel-caption f-thide">
                            中国水利博物馆开馆
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo IMG_PATH;?>p2.jpg" alt="">
                        <div class="carousel-caption f-thide">
                            中国水利博物馆开馆
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col col-md-5 col-sm-5 content-2">
            <div class="zl">
                <ul class="sub-tab">
                    <li class="sub-tab-item active" id="slzl">水利纵览</li>
                    <li class="sub-tab-item" id="wbdt">文博动态</li>
                    <li class="more">More >></li>
                </ul>
               <!-- 水利纵览内容-->
                <div class="sub-tab-content slzl current">
                	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0c90a94bb736e44f05ae0a26d35aedc6&action=lists&catid=4&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'4','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
                	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <div class="zl-detail cb">
                        <h3 class="f-thide"><?php echo $r['title'];?></h3>
                        <p class="f-thide2"><?php echo str_cut(strip_tags($r[description]),500);?></p>
                    </div>
                    <?php $n++;}unset($n); ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7a36085c1b1023b24668070180614821&action=lists&catid=4&order=id+DESC+LIMIT+1%2C4--&num=4&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'4','order'=>'id DESC LIMIT 1,4--','mroeinfo'=>'1','limit'=>'4',));}?>
                <!-- 水利纵览内容从第二条数据取到第四条数据-->
                    <ul class="list">
                    	 	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                        <li class="list-item">
                            <a href="<?php echo $r['url'];?>">
                                <span class="title f-thide"><?php echo $r['title'];?></span>
                                <span class="time"><?php echo date('Y-m-d',$r[inputtime]);?></span>
                            </a>
                        </li>
                        <?php $n++;}unset($n); ?>         
                    </ul>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
                <div class="sub-tab-content wbdt">
                		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9b407c1dfbb5437d2589b7684fcbdeda&action=lists&catid=5&order=id+DESC&num=1&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'5','order'=>'id DESC','mroeinfo'=>'1','limit'=>'1',));}?>
                	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <div class="zl-detail cb">
                        <h3 class="f-thide"><?php echo $r['title'];?></h3>
                        <p class="f-thide2"><?php echo str_cut(strip_tags($r[description]),500);?></p>
                    </div>
                    <?php $n++;}unset($n); ?>
                 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=89deacd6f32fb00a3e789c18c0394034&action=lists&catid=5&order=id+DESC+LIMIT+1%2C4--&num=4&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'5','order'=>'id DESC LIMIT 1,4--','mroeinfo'=>'1','limit'=>'4',));}?>
                <!-- 水情内容从第二条数据取到第四条数据-->
                   <ul class="list">
                    	 	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                        <li class="list-item">
                            <a href="<?php echo $r['url'];?>">
                                <span class="title f-thide"><?php echo $r['title'];?></span>
                                <span class="time"><?php echo date('Y-m-d',$r[inputtime]);?></span>
                            </a>
                        </li>
                        <?php $n++;}unset($n); ?>         
                    </ul>
                </div>
            </div>
        </div>
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=749ed1151b116b8c89e93d3adfcc73b3&action=lists&catid=8&order=id+DESC&num=5&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'8','order'=>'id DESC','mroeinfo'=>'1','limit'=>'5',));}?>
          
        <div class="col col-md-3 col-sm-3 content-3">
            <h2 class="zx-title">
                <span class="fl">水博公告</span>
                <a class="fr more">More >></a>
            </h2>
            <ul class="list">
            	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list-item">
                    <a class="title f-thide" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                </li>
               <?php $n++;}unset($n); ?>
                
            </ul>
        </div>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <div class="row main-content-1">
        <div class="col col-md-4 col-sm-4 content-1">
            <ul class="tab">
                <li class="tab-item active" id="zhici">
                    <span>馆长致辞</span>
                </li>
                <li class="tab-item" id="jianjie">
                    <span>水博简介</span>
                </li>
            </ul>
            <div class="tab-detail">
                <p class="f-thide7 active zhici">馆长致辞 水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》水利部发布《2017年中国水资源公告》
                </p>
                <p class="f-thide7 jianjie">水博简介 中国水利博物馆是水利部直属的国家级行业博物馆。为了宣传人民群众治水的历史功绩和伟大成就，弘扬水利精神，传承水利文化，普及水利知识，促进水利持续发展，2004年7月，经国务院批准、中央编办批复，中国水利博物馆在浙江杭州设立，由水利部和浙江省人民政府共同管理。
                </p>
            </div>
            <a class="ad">
                <img  src="<?php echo IMG_PATH;?>poster.png">
            </a>
            <a class="ad">
                <img  src="<?php echo IMG_PATH;?>poster.png">
            </a>
        </div>
        <div class="col col-md-5 col-sm-5 content-2 content-22">
            <div class="zx">
                <h2 class="zx-title">
                    <span class="fl">水博资讯</span>
                    <a class="fr more">More >></a>
                </h2>
                  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=fbabb7ea213e0baf1dabc14a65bc65c0&action=lists&catid=3&order=id+DESC&num=12&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'3','order'=>'id DESC','mroeinfo'=>'1','limit'=>'12',));}?>
                <ul class="list">
                	 	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <li class="list-item">
                        <a href="<?php echo $r['url'];?>">
                            <span class="title f-thide"><?php echo $r['title'];?></span>
                            <span class="time"><?php echo date('Y-m-d',$r[inputtime]);?></span>
                        </a>
                    </li>
                    <?php $n++;}unset($n); ?>
                </ul>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
        </div>
        <div class="col col-md-3 col-sm-3 content-3 content-32">
            <div class="service">服务指南</div>
            <div class="open-time">
                <p>开放日期：每周二至周日</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    （周一闭馆）</p>
                <p>开放时间：9:00 --- 16:30</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    （16点后停止入馆）</p>
            </div>
            <img class="fl service-icon icon1" src="<?php echo IMG_PATH;?>jiaotong.png">
            <img class="fl service-icon icon2" src="<?php echo IMG_PATH;?>jianjie.png">
            <img class="fl service-icon icon3" src="<?php echo IMG_PATH;?>wenwu.png">
            <img class="fl service-icon icon4" src="<?php echo IMG_PATH;?>liuyanban.png">
        </div>
    </div>

    <div class="row main-content-2">
        <div class="col col-md-4 col-sm-4 content-2-item video">
            <div class="picture-list">
                精彩视频
            </div>
            <div class="pic-detail">
                <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <a href="https://www.baidu.com/" class="car-item">
                                <img src="<?php echo IMG_PATH;?>p2.jpg" alt="">
                                <div class="carousel-caption f-thide">
                                    中国水利博物馆开馆
                                </div>
                            </a>

                            <a href="http://news.baidu.com/" class="car-item">
                                <img src="<?php echo IMG_PATH;?>p1.jpg" alt="">
                                <div class="carousel-caption f-thide">
                                    中国水利博物馆开馆
                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <div class="car-item">
                                <img src="<?php echo IMG_PATH;?>p1.jpg" alt="">
                                <div class="carousel-caption f-thide">
                                    中国水利博物馆开馆
                                </div>
                            </div>
                            <div class="car-item">
                                <img src="<?php echo IMG_PATH;?>p1.jpg" alt="">
                                <div class="carousel-caption f-thide">
                                    中国水利博物馆开馆
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
                        <
                        <!--<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>-->
                        <!--<span class="sr-only">Previous</span>-->
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
                        >
                        <!--<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>-->
                        <!--<span class="sr-only">Next</span>-->
                    </a>
                </div>

            </div>
        </div>
        <div class="col col-md-8 col-sm-8 content-2-item">
            <div class="picture-list">
                图片锦集
            </div>
            <div class="row picture">
                <div class="col-sm-3 col-xs-6 pic-detail">
                    <img  src="<?php echo IMG_PATH;?>banner.jpg">
                    <p>情切关怀</p>
                </div>
                <div class="col-sm-3 col-xs-6 pic-detail">
                    <img  src="<?php echo IMG_PATH;?>banner.jpg">
                    <p>情切关怀</p>
                </div>
                <div class="col-sm-3 col-xs-6 pic-detail">
                    <img  src="<?php echo IMG_PATH;?>banner.jpg">
                    <p>情切关怀</p>
                </div>
                <div class="col-sm-3 col-xs-6 pic-detail">
                    <img  src="<?php echo IMG_PATH;?>banner.jpg">
                    <p>情切关怀</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row main-content-3">
        <div class="col col-md-4 col-sm-4 content-3-item item-border">
            <h2 class="zx-title">
                <span class="fl">社会教育</span>
                <a class="fr more">More >></a>
            </h2>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0ff300de4a8ccfb83ab920ee3a5ba129&action=lists&catid=19&order=id+DESC&num=5&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'19','order'=>'id DESC','mroeinfo'=>'1','limit'=>'5',));}?>
            <ul class="list">
              	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list-item">
                    <a class="title f-thide" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                </li>
                <?php $n++;}unset($n); ?>
            </ul>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
        <div class="col col-md-4 col-sm-4 content-3-item item item-border">
            <h2 class="zx-title">
                <span class="fl">水利遗产</span>
                <a class="fr more">More >></a>
            </h2>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a3762fa0857a10f67847494477d8ad59&action=lists&catid=20&order=id+DESC&num=5&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'20','order'=>'id DESC','mroeinfo'=>'1','limit'=>'5',));}?>
            <ul class="list">
              	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list-item">
                    <a class="title f-thide" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                </li>
                <?php $n++;}unset($n); ?>
            </ul>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
        <div class="col col-md-3 col-sm-3 content-3-item item-border">
            <h2 class="zx-title">
                <span class="fl">访谈协作</span>
                <a class="fr more">More >></a>
            </h2>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=88f3d28e3b2373bbf433737e741beb66&action=lists&catid=22&order=id+DESC&num=5&mroeinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'22','order'=>'id DESC','mroeinfo'=>'1','limit'=>'5',));}?>
            <ul class="list">
              	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="list-item">
                    <a class="title f-thide" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                </li>
                <?php $n++;}unset($n); ?>
            </ul>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>
    <div class="row main-content-4">
        <div class="col col-md-12 col-sm-12">
            <div class="order">友情链接</div>
            <ul class="order-nav">
                <li class="order-nav-item current" id="slbwz">水利部网站</li>
                <li class="order-nav-item" id="slbzswz">水利部直属单位</li>
                <li class="order-nav-item" id="zjsl">浙江水利</li>
                <li class="order-nav-item" id="wbw">文博网</li>
                <li class="order-nav-item" id="sblm">水博联盟</li>

            </ul>
            <div class="nav-detail cb slbwz active">
                <a>国家文物局bswz</a>
                <a>国家文物局bswz</a>
                <a>国家财税博物馆bswz</a>
                <a>国家文物局bswz</a>
                <a>国家文物局bswz</a>
                <a>国家财税博物馆bswz</a>
                <a>国家文物局bswz</a>
                <a>国家文物局bswz</a>
                <a>国家财税博物馆bswz</a>
            </div>
            <div class="nav-detail cb slbzswz">
                <div class="col col-md-2 col-sm-2 sub-order">
                    文物系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
                <div class="col col-md-2 col-sm-2 sub-order">
                    行业系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
            </div>
            <div class="nav-detail cb zjsl">
                <div class="col col-md-2 col-sm-2 sub-order">
                    文物系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
                <div class="col col-md-2 col-sm-2 sub-order">
                    行业系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
            </div>
            <div class="nav-detail cb wbw">
                <div class="col col-md-2 col-sm-2 sub-order">
                    文物系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
                <div class="col col-md-2 col-sm-2 sub-order">
                    行业系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
            </div>
            <div class="nav-detail cb sblm">
                <div class="col col-md-2 col-sm-2 sub-order">
                    文物系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
                <div class="col col-md-2 col-sm-2 sub-order">
                    行业系统
                </div>
                <div class="col col-md-10 col-sm-10 sub-order-item">
                    <a>国家文物局bswz</a>
                    <a>国家文物局bswz</a>
                    <a>国家财税博物馆bswz</a>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

<?php include template("content","footer"); ?>