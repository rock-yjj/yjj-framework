	<div class="links clearfix">
		<span>
			友情链接
		</span>
    <div class="link_a">
<?php 
foreach ($friend AS $v) {
    echo '<a href="' . $v['url'] . '" title="' . $v['info'] . '" />' . $v['title'] . '</a> | ';
}
?> 
		<a href="/">聚鑫医疗</a>			
		</div>				
	</div>
	<div class="footer">
		<div class="footer_com clearfix">
			<ul class="di_nav">
				<li>
          <a href="#" class="tit">关于我们</a>
<?php 
foreach ($type_assocc['20c758aa-96be-42e2-b097-5a05b78a33d7'] AS $k => $v) {
    $url = $this->_context->url('', array('controller' => 'about', 'action' => 'article', 'sn' => $v['sn']));
?>
    <a href="<?php echo $url; ?>"><?php echo $v['name']; ?></a>
<?php
}
?>
				</li>
				<li>
        <a href="#" class="tit">产品展示</a>
<?php 
foreach ($type_assocc['65ec02fc-1e94-4093-8c2c-497d5eaea547'] AS $k => $v) {
    $url = $this->_context->url('', array('controller' => 'product', 'action' => 'type', 'sn' => $v['sn']));
?>
    <a href="<?php echo $url; ?>"><?php echo $v['name']; ?></a>
<?php
}
?>
				</li>
			
				<li>
        <a href="#" class="tit">典型业绩</a>
<?php 
foreach ($type_assocc['c96377f1-15a5-4ac2-93c7-7ef436bafc96'] AS $k => $v) {
    $url = $this->_context->url('', array('controller' => 'special', 'action' => 'type', 'sn' => $v['sn']));
?>
    <a href="<?php echo $url; ?>"><?php echo $v['name']; ?></a>
<?php
}
?>
				</li>
				<li>
					<a href="#" class="tit">联系我们</a>
					<a href="/html/topic/101.html">联系方式</a>
	    			<a href="/index.php?controller=feedback&action=add">在线留言</a>    	
				</li>
			</ul>
			<div class="er_right">
				<div class="er">
					<div class="pic">
						<img src="/default/images/erwei.png" alt="" class="vcenter">
						<i></i>
					</div>
					<div class="text">
						<span>微信公众平台</span>
						<span>关注聚鑫</span>
					</div>
				</div>
				<div class="dian">
					<div class="di_bg">
						<a href="tel:4000029921">400-0029-921</a>
						<span>服务咨询热线</span>
					</div>
					<a href="/index.php?module=default&controller=about&action=map" class="map_a">网站地图</a>
					
				</div>
			</div>
			
		</div>
		<div class="copy clearfix">
     <div class="copy_cc">
				<span style="color:#97989a"> CopyRight &copy; 西咸新区聚鑫医疗器械有限公司 <a style="color:#97989a" href="http://beian.miit.gov.cn">陕ICP备18014963号</a>  证书编号：（陕）-非经营性-2018-0035</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#97989a">联系地址：西咸新区沣西新城清华科技园企业孵化中心1号厂房1号企业孵化层A、B户</span> <div class="y_a">
					<a href="/"><img src="/default/images/yu.png" alt="" data-bd-imgshare-binded="1"></a></div>
			</div>
		</div>
	</div>
<div style="" class="search_mask">
	<div class="s_box">
		<p class="text1">请输入搜索关键字</p>
		<a href="javascript:;" class="sure">确定</a>
	</div>
</div>
<!--移动端底部导航--><div class="phonefooternav">
		<ul class="clearfix">
			<li>
				<a href="tel:02938109221">
					<i class="iconfont">&#xe60c;</i>
					<span>一键电话</span>
				</a>
			</li>
			<li>
				<a href="/index.php?controller=feedback&action=add">
					<i class="iconfont">&#xe683;</i>
					<span>在线留言</span>
				</a>
			</li>
			<li>
				<a href="/html/topic/101.html">
					<i class="iconfont">&#xe61d;</i>
					<span>联系我们</span>
				</a>
			</li>
			<li>
				<a href="/">
					<i class="iconfont">&#xe607;</i>
					<span>返回首页</span>
				</a>
			</li>
		</ul>
	</div><!--移动端  Mmenu-->
	<!--移动端  Mmenu-->
	<nav id="mmenu">
		<ul>
      <li><a href="/">首 页</a></li>
<?php 
foreach ($channel AS $k => $v) {
    echo <<< EOF
			<li>
				<a href="{$v['url']}"><span>{$v['name']}</span></a>
EOF;
    if (!empty($type_assocc[$v['sn']])) {
    echo <<< EOF
				<ul>
EOF;
foreach ($type_assocc[$v['sn']] AS $kt => $vt) {
        if (('about' == $v['type']) || ('topic' == $v['type'])) {
            $current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'article', 'sn' => $vt['sn']));
        } else if (('topic' == $v['type'])) {
            $current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'index', 'sn' => $vt['sn']));
        } else {
            $current_url = $this->_context->url('', array('controller' => $v['type'], 'action' => 'type', 'sn' => $vt['sn']));
        }
        echo <<< EOF
        <li><a href="{$current_url}">{$vt['name']}</a></li>
EOF;
    }
    echo <<< EOF
        </ul>
EOF;
    }
    echo <<< EOF
			</li>
EOF;
}
?>
		</ul>
	</nav>	
		
</div>	

<!--Include Js-->
<script src="http://apps.bdimg.com/libs/jquery/1.8.3/jquery.min.js" type="text/javascript" charset="utf-8"></script>

<!--移动端导航-->
<script src="/default/js/jquery.mmenu.all.min.js" type="text/javascript" charset="utf-8"></script>

<script src="/default/js/public.js" type="text/javascript" charset="utf-8"></script>

<!--slick-->
<script src="/default/js/slick.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	    $(function(){
		    $('.banner').slick({
		        dots: true,
		        autoplay:true,
		        arrows:false,
		        autoplaySpeed:3000,
		    });
		});
</script>

<!--placeholder-->
<script src="/default/js/jquery.placeholder.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function(){ 
    $('input, textarea').placeholder(); 
    $('#search').click(function (e) {
        var v = $('#keywords')[0].value;
        if (v.length < 1) {
            window.alert('请输入搜索关键词!');
            return;
        }
        window.location = '/index.php?controller=index&action=search&keywords=' + v;
    });
});
</script>

<!--<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
<script type="text/javascript">
$('#verifyImg').click(function (e) {
    e.target.src = '/index.php?module=default&controller=captword&action=codeimg&v=' + Math.random();
});
$('#submits').click(function (e) {
    var data = {};
    var name = $('#name').attr('value');
    var address = $('#add').attr('value');
    var t = $('#phone').attr('value');
    var email = $('#email').attr('value');
    //var reg = /^[0-9]{6,11}$/;
    //if (!reg.test(t)) {
    //    window.alert('电话或qq号码填写不正确，\n这里填电话号码或者QQ号码其中一个即可！');
    //    $('#tel').focus();
    //    return false;
    //}
    data['t'] = t;
    data['name'] = name;
    data['address'] = address;
    data['email'] = email;
    data['ct'] = $('#cont').attr('value');
    var v = $('#yan').attr('value');
    var reg = /^[0-9a-zA-Z]{4}$/;
    if (!reg.test(v)) {
        window.alert('验证码不正确，\n请填写图片上显示的数字或者字母！');
        $('#code').focus();
        return false;
    }
    data['v'] = v;
    $.ajax({
        type : 'POST',
        url  : '/index.php?controller=feedback&action=add',
        data : data,
        success : function (msg) {
            var msg = jQuery.parseJSON(msg);
            window.alert(msg.info);
        }
    });
});
</script>
<link href="/default/qq/css/zzsc.css" type="text/css" rel="stylesheet" />
<script src="/default/qq/js/zzsc.js" type="text/javascript"></script>
</body>
</html>
