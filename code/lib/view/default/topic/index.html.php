<?php
include ROOT_TEMP_DIR . '/view/default/head.html.php';
include ROOT_TEMP_DIR . '/view/default/top.html.php';
//echo empty($topic['content']) ? '' : $topic['content'];
?>
			
	<!--banner-->
	<section class="banner">
	    <div><img src="/default/images/case_banner.jpg" alt=""></div>
	</section>
	<div class="com_zi clearfix">
		<div class="left_zi">
			<div class="top_com">
				<span>联系我们</span>
			</div>
			<ul class="nav_left">
				<li class="active">
					<a href="#">联系方式</a>
				</li>
				<li>
					<a href="/index.php?controller=feedback&action=add">在线留言</a>
				</li>
				
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
				<span class="b_tt">联系我们</span>
				<span class="curbar"><i>您当前的位置：</i><a href="/">首页</a> <a href="#">联系我们</a> > <i>联系方式</i></span>
			</div>
			<div class="cont_zi">
					<div class="contact_map">
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6d88e38ab7f507ee19cec46443691d95"></script>
						<div id="map"></div>
						<script type="text/javascript">
	
				    // 百度地图API功能
				    var map = new BMap.Map("map");    // 创建Map实例
				    var point = new BMap.Point(108.735611,34.328395);   //坐标拾取网址：http://api.map.baidu.com/lbsapi/getpoint/index.html
				
				    var marker = new BMap.Marker(point);  // 创建标注
				    var mapStyle = {style:"normal"};
	    			map.setMapStyle(mapStyle);
	
				    var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
				    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
				
				    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
				    map.centerAndZoom(point, 18);  // 初始化地图,设置中心点坐标和地图级别
				    map.addOverlay(marker);               // 将标注添加到地图中
				    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
				    map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
				    map.setCurrentCity("上海");          // 设置地图显示的城市 此项是必须设置的
					
				
				
				    window.onresize = function(){
				
				        map.centerAndZoom(point, 15);  // 重置窗口的时候 重新获取中心点坐标的位置
				
				    }
	
			    map.addControl(top_left_control);
			    map.addControl(top_left_navigation);
			    /*map.addControl(top_right_navigation);  */
				</script>
				</div>
				<div class="con_cc">
					<div class="left">
						<img src="images/contact_wei.jpg" alt="" />
						<p>CONTACT US</p>
					</div>
					<ul class="right">
						<li class="clearfix">
            <b>公司名称：</b><span><?php echo $site['name']; ?></span>
						</li>
						<li class="clearfix">
            <b>电话：</b><span><?php echo $site['tel']; ?></span>
						</li>
						<li class="clearfix">
            <b>邮箱：</b><span><?php echo $site['email']; ?></span>
						</li>
						<li class="clearfix">
            <b>手机：</b><span><?php echo $site['mobile']; ?></span>
						</li>
						<li class="clearfix">
            <b>地址：</b><span><?php echo $site['address'];?></span>
						</li>
					</ul>
				</div>
			</div>
			
			
			
		</div>
	</div>
<?php
include ROOT_TEMP_DIR . '/view/default/foot.html.php';

