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
    if ($v['sn'] == $article['type_sn']) {
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
      <span class="b_tt"><?php echo $article['title']; ?></span>
      <span class="curbar"><i>您当前的位置：</i><a href="#">首页</a> > <a href="#">产品中心</a> > <i><?php echo $article['title']; ?></i></span>
			</div>
			<div class="pro_zi_show" style="padding-top:0px;">
				<div class="pro_show2" style="margin-top:0px; padding-top:10px;">
        <h4 style="text-align:center"><?php echo $article['title']; ?></h4>
            <?php echo $article['content']; ?>
				</div>
				<!--<ul class="prev_next clearfix">
					<li><b>上一篇：</b><a href="pro_show.html">暂无信息！</a></li>
					<li><b>下一篇：</b><a href="pro_show.html">丰富功能与便捷操作的完美结合——解读DZS-708... </a></li>
				</ul>-->
			</div>
		</div>
	</div>
<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
