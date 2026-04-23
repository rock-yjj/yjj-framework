<?php
include ROOT_TEMP_DIR . '/view/default/head.html.php';
include ROOT_TEMP_DIR . '/view/default/top.html.php';
?>
	<section class="banner">
	    <div><img src="/default/images/about_banner.jpg" alt=""></div>
	</section>
	<div class="com_zi clearfix">
		<div class="left_zi">
			<div class="top_com">
				<span>公司简介</span>
			</div>
      <ul class="nav_left">
<?php 
foreach ($type as $v) {
    $url = $this->_context->url('', array('controller' => 'about', 'action' => 'article', 'sn' => $v['sn']));
     if (('697df8f8-7af2-4db1-8561-2aabd43a136d' === $v['sn'])) {
    	$url = $this->_context->url('', array('controller' => 'honor', 'action' => 'list'));
        if (('697df8f8-7af2-4db1-8561-2aabd43a136d' === $current_sn)) {
    			echo '<li class="active"><a href="' . $url . '">' . $v['name'] . '</a></li>';
    			continue;
    	}
    	echo '<li><a href="' . $url . '">' . $v['name'] . '</a></li>';
    	continue;
    }
    if ($v['sn'] == $current_sn) {

        echo '<li class="active"><a href="' . $url . '">' . $v['name'] . '</a></li>';
    } else {
        echo '<li><a href="' . $url . '">' . $v['name'] . '</a></li>';
    }
}
?>
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
				<span class="b_tt"><?php echo $current_type['name']; ?></span>
				<span class="curbar"><i>您当前的位置：</i><a href="/">首页</a> > <a href="#">关于我们</a> > <i><?php echo $current_type['name']; ?></i></span>
			</div>
			<div class="about_zi">
				<p><?php echo empty($article['content']) ? '' : $article['content']; ?></p>
			</div>
			
		</div>
	</div>
<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
