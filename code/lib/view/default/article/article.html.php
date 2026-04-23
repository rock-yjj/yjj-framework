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
				<span>新闻资讯</span>
			</div>
      <ul class="nav_left">
<?php 
foreach ($type as $v) {
    $url = $this->_context->url('', array('controller' => 'article', 'action' => 'type', 'sn' => $v['sn']));
    if ($v['sn'] == $article['type_sn']) {
        echo '<li class="active"><a href="' . $url . '">' . $v['name'] . '</a></li>';
    } else {
        echo '<li><a href="' . $url . '">' . $v['name'] . '</a></li>';
    }
}
?>
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
				<span class="b_tt">新闻资讯</span>
				<span class="curbar"><i>您当前的位置：</i><a href="index.html">首页</a> > <a href="<?php echo $this->_context->url('', array('controller' => 'article', 'action' => 'type')); ?>">新闻资讯</a><?php echo empty($current_nvg) ? '' : '　>　<i>' . $current_nvg . '</i>'; ?></span>
			</div>
			<div class="news_show_zi">
      <h4><?php echo $article['title']; ?></h4>
      <p style="width:60%;margin:auto;text-align:center;padding-bottom:10px;"><?php echo date('Y-m-d H:i:s', (int) $article['create_time']); ?></p>
<?php echo $article['content']; ?>
			</div>
			
		</div>
	</div>

<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
