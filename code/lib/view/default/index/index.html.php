<?php 
include_once ROOT_TEMP_DIR . '/view/default/head.html.php';
include_once ROOT_TEMP_DIR . '/view/default/top.html.php';
?>
	<section class="banner">
	    <div><a href="#"><img src="/default/images/banner1.jpg" alt=""></a></div>
	    <div><a href="#"><img src="/default/images/banner2.jpg" alt=""></a></div>
	    <div><a href="#"><img src="/default/images/banner3.jpg" alt=""></a></div>
	</section>
	<div class="pro_home">
		<div class="pro_qie clearfix">
			<span class="active"><i>冲击波治疗仪</i></span>
			<span><i>银针治疗仪</i></span>
			<span><i>冲击波治疗仪</i></span>
			<span><i>银针治疗仪</i></span>
		</div>                                                                                                                
		<div class="pro_com">
      <ul class="pro_com_ul clearfix" style="display: block;">
<?php 
        foreach ($product_recommend1 AS $k => $v) {
            $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
            $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
echo <<< EOF
        <li class="clearfix">
            <a href="{$url}" class="clearfix">
						<div class="pic">
            <img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter"/>
							<i></i>
						</div> 
						<div class="text">
            <span>{$v['title']}</span>
              <p>
        {$v['introduction']}
							</p>
							<i class="more"></i>
						</div>
					</a>
        </li>
EOF;
        }
?>
			</ul>
      <ul class="pro_com_ul clearfix">
<?php 
        foreach ($product_recommend2 AS $k => $v) {
            $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
            $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
echo <<< EOF
        <li class="clearfix">
            <a href="{$url}" class="clearfix">
						<div class="pic">
            <img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter"/>
							<i></i>
						</div> 
						<div class="text">
            <span>{$v['title']}</span>
              <p>
        {$v['introduction']}
							</p>
							<i class="more"></i>
						</div>
					</a>
        </li>
EOF;
        }
?>
			</ul>
    <ul class="pro_com_ul clearfix">
<?php 
        foreach ($product_recommend3 AS $k => $v) {
            $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
            $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
echo <<< EOF
        <li class="clearfix">
            <a href="{$url}" class="clearfix">
						<div class="pic">
            <img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter"/>
							<i></i>
						</div> 
						<div class="text">
            <span>{$v['title']}</span>
              <p>
        {$v['introduction']}
							</p>
							<i class="more"></i>
						</div>
					</a>
        </li>
EOF;
        }
?>
			</ul>
      <ul class="pro_com_ul clearfix">
<?php
        foreach ($product_recommend4 AS $k => $v) {
            $url = $this->_context->url('', array('controller' => 'product', 'action' => 'article', 'sn' => $v['sn']));
            $img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $v['sn']);
echo <<< EOF
        <li class="clearfix">
            <a href="{$url}" class="clearfix">
						<div class="pic">
            <img src="/upload/product/thumb_{$img_url}" alt="" class="vcenter"/>
							<i></i>
						</div> 
						<div class="text">
            <span>{$v['title']}</span>
              <p>
        {$v['introduction']}
							</p>
							<i class="more"></i>
						</div>
					</a>
        </li>
EOF;
        }
?>
			</ul>
		</div>
	</div>

	<div class="case_home">
		<div class="case_com">
			<div class="top">
				<span>典型案例</span>
				<i>TYPICAL PERFORMANCE</i> 
				<em></em>
			</div>
			<ul class="clearfix">
				<li class="clearfix">
					<div class="pic_ca">
						<img src="/default/images/case1.jpg" alt="" class="vcenter"/>
						<i></i>
            <a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '8a9b8fe2-9784-4a1f-8994-66b40ef1abd5')); ?>" class="zhe_a slideExpandUp">
							<div class="zhe_n">
								<p>某医院<br>
								整体解决方案</p>
								<img src="/default/images/zhe_jia.png" alt="" />
							</div>
						</a>
					</div>
					<div class="text_ca">
						<p>冲击波治疗仪</p>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '8a9b8fe2-9784-4a1f-8994-66b40ef1abd5')); ?>">查看详细>></a>
					</div>
				</li>
				<li>
					<div class="pic_ca">
						<img src="/default/images/case2.jpg" alt="" class="vcenter"/>
						<i></i>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '97ff5187-bccb-4cd8-85eb-d435a673499f')); ?>" class="zhe_a slideExpandUp">
							<div class="zhe_n">
								<p>某医院<br>
								整体解决方案</p>
								<img src="/default/images/zhe_jia.png" alt="" />
							</div>
						</a>
					</div>
					<div class="text_ca">
						<p>银针治疗仪</p>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '97ff5187-bccb-4cd8-85eb-d435a673499f')); ?>">查看详细>></a>
					</div>
				</li>
				<li>
					<div class="pic_ca">
						<img src="/default/images/case3.jpg" alt="" class="vcenter"/>
						<i></i>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '2735b59b-64cf-44e4-997b-34de37597d7f')); ?>" class="zhe_a slideExpandUp">
							<div class="zhe_n">
								<p>某医院<br>
								整体解决方案</p>
								<img src="/default/images/zhe_jia.png" alt="" />
							</div>
						</a>
					</div>
					<div class="text_ca">
						<p>银针治疗仪</p>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '2735b59b-64cf-44e4-997b-34de37597d7f')); ?>">查看详细>></a>
					</div>
				</li>
				<li>
					<div class="pic_ca">
						<img src="/default/images/case4.jpg" alt="" class="vcenter"/>
						<i></i>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => '0466279c-cf0d-45f8-800c-1d810df8abc2')); ?>" class="zhe_a slideExpandUp">
							<div class="zhe_n">
								<p>某医院<br>
								整体解决方案</p>
								<img src="/default/images/zhe_jia.png" alt="" />
							</div>
						</a>
					</div>
					<div class="text_ca">
						<p>冲击波治疗仪</p>
						<a href="<?php echo $this->_context->url('', array('controller' => 'special', 'action' => 'article', 'sn' => '0466279c-cf0d-45f8-800c-1d810df8abc2')); ?>">查看详细>></a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="new_home clearfix">
		<div class="left_new clearfix">
			<div class="pic">
				<a href="<?php echo $this->_context->url('', array('controller' => 'about', 'action' => 'article', 'sn' => 'faf3de47-58fe-4a56-b3b1-33b5364f9a5d')); ?>">
					<img src="/default/images/about1.jpg" alt="" class="vcenter"/>
				<i></i></a>
			</div>
			<div class="text">
				<h4>西咸新区聚鑫医疗器械有限公司</h4>
        <p><?php echo $about_info['introduction']; ?>...……</p>
	      <a href="<?php echo $this->_context->url('', array('controller' => 'about', 'action' => 'article', 'sn' => 'faf3de47-58fe-4a56-b3b1-33b5364f9a5d')); ?>">查看详细 >></a>
			</div>
		</div>
		<ul  class="right_new">
			<li>
        <a href="<?php echo $this->_context->url('', array('controller' => 'article', 'action' => 'article', 'sn' => $news[0]['sn'])); ?>">
					<div class="pic"><img src="/default/images/news1.jpg" alt="" class="vcenter"/><i></i></div>
					<div class="text">
          <h4><?php echo $news[0]['title']; ?></h4>
          <time>[<?php echo date('Y-m-d', (int) $news[0]['create_time']); ?>]</time>
						<p><?php echo $news[0]['introduction']; ?>.....</p>
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo $this->_context->url('', array('controller' => 'article', 'action' => 'article', 'sn' => $news[1]['sn'])); ?>">
					<div class="pic"><img src="/default/images/news2.jpg" alt="" class="vcenter"/><i></i></div>
					<div class="text">
						<h4><?php echo $news[1]['title']; ?></h4>
						<time>[<?php echo date('Y-m-d', (int) $news[1]['create_time']); ?>]</time>
						<p><?php echo $news[1]['introduction']; ?>.....
						</p>
					</div>
				</a>
			</li>
		</ul>
	</div>
<?php 
include_once ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
