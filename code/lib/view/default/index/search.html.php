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
			<div class="pro_lei">
      <div class="top">产品展示</div>
<?php 
        foreach ($left_product AS $k => $v) {
            $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
            $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
    echo <<< EOF
				<div class="pro_l_nei">
					<div class="pic">
						<img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter"/>
						<i></i>
					</div>
					<p>{$v['title']}</p>
				</div>
EOF;
        }
?>
			</div>
		</div>
		<div class="right_zi">
			<div class="bar clearfix">
				<span class="b_tt">站内搜索</span>
				<span class="curbar"><i>您当前的位置：</i><a href="index.html">首页</a> > <a href="<?php echo $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg)); ?>">站内搜索</a><?php echo empty($current_nvg) ? '' : '　> <i>' . $current_nvg . '</i>'; ?> ></span>
			</div>
      <ul class="news_zi_ul clearfix">
<?php 
foreach ($article_list as $k => $v) {
    $y_time = date('Y', (int) $v['create_time']);
    $d_time = date('m-d', (int) $v['create_time']);
    $url = $this->_context->url('', array('controller' => 'article', 'action' => 'article', 'sn' => $v['sn']));
echo <<< EOF
        <li>
					<a href="{$url}" class="clearfix">
						<span class="left">
							<h4>{$v['title']}</h4>
							<p>{$v['introduction']}...</p>
						</span>
						<span class="right">
							<time>{$d_time}</time>
							<span>{$y_time}</span>
							<i></i>
						</span>
					</a>
        </li>
EOF;
}
?>
			</ul>
      <section class="pageing">
<?php
if (!empty($pagination)) {
    if (empty($type_sn)) {
        $first_page = $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg, 'page' => 1));
        echo '<a href="' . $first_page . '">首页</a>';
        for($i = (int)$pagination['start']; $i <= $pagination['end']; $i++) {
            $url = $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg, 'page' => $i));
            if ($i == $current_page) {
                echo '<a href="' . $url . '" class="active">' . $i . '</a>';
            } else {
                echo '<a href="' . $url . '">' . $i . '</a>';
            }
        }
        $last_page = $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg, 'page' => $page_count));
        echo '<a href="' . $last_page . '">末页</a>';
    } else {
        $first_page = $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg, 'page' => 1));
        echo '<a href="' . $first_page . '">首页</a>';
        for($i = $pagination['start']; $i <= $pagination['end']; $i++) {
            $url = $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg, 'page' => $i));
            if ($i == $current_page) {
                echo '<a href="' . $url . '" class="active">' . $i . '</a>';
            } else {
                echo '<a href="' . $url . '">' . $i . '</a>';
            }
        }
        $last_page = $this->_context->url('', array('controller' => 'index', 'action' => 'search', 'keywords' => $current_nvg, 'page' => $page_count));
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
