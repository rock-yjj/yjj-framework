<!--header-->
<header class="header">
<div class="kuan_heaaer clearfix">
	<a href="/" class="logo">
		<img src="/default/images/logo.png" alt="" />
	</a>
	<div class="nav_div">
		<ul class="nav_ul">                                                                                                      
			<li <?php echo empty($current_channel) ? 'class="active"' : ''; ?>>
		      <a href="/"><span>网站首页</span></a>
          </li>
<?php 
foreach ($channel AS $k => $v) {
    $class = ($v['sn'] == $current_channel) ? ' class="active"' : '';
    echo <<< EOF
			<li{$class}>
				<a href="{$v['url']}"><span>{$v['name']}</span></a>
EOF;
    if (!empty($type_assocc[$v['sn']]) && ('topic' != $v['type'])) {
    echo <<< EOF
				<div class="erji">
EOF;
foreach ($type_assocc[$v['sn']] AS $kt => $vt) {
        if (('about' == $v['type'])) {
        	if($vt['sn']=='697df8f8-7af2-4db1-8561-2aabd43a136d'){
        		$current_url = $this->_context->url('', array('controller' => 'honor', 'action' => 'list'));
        	}else{
        		$current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'article', 'sn' => $vt['sn']));
        	}
            
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
EOF;
    }
    echo <<< EOF
			</li>
EOF;
}
?>
		</ul>
	</div>
	<div class="ensou">
		<a href="#" class="cn">CN</a>
		<a href="javascript:;" class="sou_img"><img src="/default/images/fang.jpg" alt="" /></a>
		<div class="sou_nei">
			<input name="keywords" id="keywords" placeholder="输入关键词" type="">
			<img src="/default/images/fang.jpg" alt="" id="search"/>
		</div>
	</div>
	<a href="#mmenu" class="iconfont phone-nav">
		 <span class="glyphicon glyphicon-align-justify"></span>
	</a>
</div>
</header>

