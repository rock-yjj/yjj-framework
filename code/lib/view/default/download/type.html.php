<?php
include ROOT_TEMP_DIR . '/view/default/head.html.php';
include ROOT_TEMP_DIR . '/view/default/top.html.php';
?>
<!--banner-->
	<section class="banner">
	    <div><img src="/default/images/news_banner.jpg" alt=""></div>
	</section>
	<div class="com_zi clearfix">
		<div class="left_zi">
			<div class="top_com">
				<span>下载中心</span>
			</div>
      <ul class="nav_left">
        <li class="active"><a href="#">下载中心</a></li>
			</ul>
			<div class="pro_lei">
      <div class="top">产品展示</div>
<?php 
        foreach ($left_product AS $k => $v) {
            $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
            $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
    echo <<< EOF
				<div class="pro_l_nei">
					<div class="pic">
						<a href="{$url}"><img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter"/></a>
						<i></i>
					</div>
					<p><a href="{$url}">{$v['title']}</a></p>
				</div>
EOF;
        }
?>
			</div>
		</div>
		<div class="right_zi">
			<div class="bar clearfix">
				<span class="b_tt">下载中心</span>
				<span class="curbar"><i>您当前的位置：</i><a href="index.html">首页</a> > <a href="<?php echo $this->_context->url('', array('controller' => 'download', 'action' => 'type')); ?>">下载中心</a> ></span>
      </div>
      <ul class="down_ul">
<?php 
foreach ($download_list as $k => $v) {
    $y_time = date('Y-m-d', (int) $v['create_time']);
    $url = $v['download_url'];
    echo <<< EOF
        <li>
					<a href="{$url}" target="_blank"><span>{$v['title']}  </span><time> [ {$y_time} ]</time></a>
				</li>
EOF;
}
?>
			</ul>
      <section class="pageing">
<?php
if (!empty($pagination)) {
    if (empty($type_sn)) {
        $first_page = $this->_context->url('', array('controller' => 'download', 'action' => 'type', 'page' => 1));
        echo '<a href="' . $first_page . '">首页</a>';
        for($i = (int)$pagination['start']; $i <= $pagination['end']; $i++) {
            $url = $this->_context->url('', array('controller' => 'download', 'action' => 'type', 'page' => $i));
            if ($i == $current_page) {
                echo '<a href="' . $url . '"><b>' . $i . '</b></a>';
            } else {
                echo '<a href="' . $url . '">' . $i . '</a>';
            }
        }
        $last_page = $this->_context->url('', array('controller' => 'download', 'action' => 'type', 'page' => $page_count));
        echo '<a href="' . $last_page . '">末页</a>';
    } else {
        $first_page = $this->_context->url('', array('controller' => 'download', 'action' => 'type', 'sn' => $type_sn, 'page' => 1));
        echo '<a href="' . $first_page . '">首页</a>';
        for($i = $pagination['start']; $i <= $pagination['end']; $i++) {
            $url = $this->_context->url('', array('controller' => 'download', 'action' => 'type', 'sn' => $type_sn, 'page' => $i));
            if ($i == $current_page) {
                echo '<a href="' . $url . '" class="active">' . $i . '</a>';
            } else {
                echo '<a href="' . $url . '">' . $i . '</a>';
            }
        }
        $last_page = $this->_context->url('', array('controller' => 'download', 'action' => 'type', 'sn' => $type_sn, 'page' => $page_count));
        echo '<a href="' . $last_page . '">末页</a>';
    }
}
?>
            </section>
		</div>
	</div>
<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
