<?php
include ROOT_TEMP_DIR . '/view/default/head.html.php';
include ROOT_TEMP_DIR . '/view/default/top.html.php';
?>
	<!--banner-->
	<section class="banner">
	    <div><img src="/default/images/pro_banner.jpg" alt=""></div>
	</section>
	<div class="com_zi clearfix">
		<div class="left_zi">
			<div class="top_com">
				<span>产品展示</span>
			</div>
      <ul class="nav_left">
<?php 
foreach ($type as $v) {
    $url = $this->_context->url('', array('controller' => 'product', 'action' => 'type', 'sn' => $v['sn']));
    if ($type_sn == $v['sn']) {
        echo '<li class="active"><a href="' . $url . '">' . $v['name'] . '</a></li>';
    } else {
        echo '<li><a href="' . $url . '">' . $v['name'] . '</a></li>';
    }
}
?>
			</ul>
			<div class="pro_lei">
				<div class="top">新闻资讯 </div>
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
      <span class="b_tt"><?php echo $current_nvg; ?></span>
				<span class="curbar"><i>您当前的位置：</i><a href="/">首页</a> > <a href="#">产品中心</a> > <i><?php echo empty($current_nvg) ? '' : '　>　<a href="#">' . $current_nvg . '</a>'; ?></i></span>
			</div>
      <ul class="pro_zi_ul clearfix">

<?php 
foreach ($article_list as $k => $v) {
    $create_time = date('Y-m-d', (int) $v['create_time']);
    $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
    $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
    echo <<< EOF
				<li>
					<a href="{$url}" class="pic">
						<img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter" />
						<i></i>
					</a>
					<div class="text">
						<p>{$v['title']}</p>
						<a href="{$url}">VIEW MORE+</a>
					</div>
				</li>
EOF;
}
?>
			</ul>
      <section class="pageing">

<?php
if (!empty($pagination)) {
    $first_page = $this->_context->url('', array('controller' => 'product', 'action' => 'type', 'page' => 1));
    echo '<a href="' . $first_page . '">首页</a>';
    for($i = $pagination['start']; $i <= $pagination['end']; $i++) {
        $url = $this->_context->url('', array('controller' => 'product', 'action' => 'type', 'page' => $i));
        if ($i == $current_page) {
            echo '<a href="' . $url . '" class="active">' . $i . '</a>';
        } else {
            echo '<a href="' . $url . '">' . $i . '</a>';
        }
    }
    $last_page = $this->_context->url('', array('controller' => 'product', 'action' => 'type', 'page' => $page_count));
    echo '<a href="' . $last_page . '">末页</a>';
}
?>
            </section>
		</div>
	</div>

<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
