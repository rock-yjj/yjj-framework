<?php
include ROOT_TEMP_DIR . '/view/default/head.html.php';
include ROOT_TEMP_DIR . '/view/default/top.html.php';
?>
	<!--banner-->
	<section class="banner">
	    <div><img src="/default/images/map_banner.jpg" alt=""></div>
	</section>
	<div class="com_zi clearfix">
		<div class="left_zi">
			<div class="top_com">
				<span>网站地图</span>
			</div>
			<ul class="nav_left">
				<li>
					<a href="#">网站地图</a>
				</li>
				
			</ul>
			<div class="pro_lei">
				<div class="top">新闻资讯  </div>
        <ul class="left_g_new">
<?php 
foreach ($left_news AS $k => $v) {
    $url = $this->_context->url('', array('controller' => 'article', 'action' => 'article', 'sn' => $v['sn']));
		echo '<li><a href="' . $url . '">' . $v['title'] . '</a></li>';
}
?>
				</ul>
			</div> 
		</div>
		<div class="right_zi">
			<div class="bar clearfix">
				<span class="b_tt">网站地图</span>
				<span class="curbar"><i>您当前的位置：</i><a href="/">首页</a> > <i>网站地图</i></span>
			</div>
			<div class="w1004">
			<div class="map">
<?php 
foreach ($channel AS $k => $v) {
    $class = ($v['sn'] == $current_channel) ? ' class="active"' : '';
    echo <<< EOF
      <dl>
				<dt><a href="{$v['url']}">{$v['name']}</a></dt>
EOF;
    if (!empty($type_assocc[$v['sn']]) && ('topic' != $v['type'])) {
        echo <<< EOF
        <dd>
				<div>
EOF;
foreach ($type_assocc[$v['sn']] AS $kt => $vt) {
        if (('about' == $v['type'])) {
            $current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'article', 'sn' => $vt['sn']));
        } else if (('topic' == $v['type'])) {
            //$current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'index', 'sn' => $vt['sn']));
        } else {
            $current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'type', 'sn' => $vt['sn']));
        }
        echo <<< EOF
        <a href="{$current_url}">{$vt['name']}</a>
EOF;
    }
    echo <<< EOF
        </div>
        </dd>
EOF;
    }
    echo <<< EOF
			</dl>
EOF;
}
?>
		</div>
		</div>
		</div>
	</div>
<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
