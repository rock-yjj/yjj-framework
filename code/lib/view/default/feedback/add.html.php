<?php 
include_once ROOT_TEMP_DIR . '/view/default/head.html.php';
include_once ROOT_TEMP_DIR . '/view/default/top.html.php';
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
				<li>
					<a href="/html/topic/101.html">联系方式</a>
				</li>
				<li  class="active">
					<a href="/index.php?controller=feedback&action=add">在线留言</a>
				</li>
				
			</ul>
			<div class="pro_lei">
				<div class="top">新闻资讯 </div>
				<ul class="left_g_new"><?php 
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
				<span class="curbar"><i>您当前的位置：</i><a href="/">首页</a> <a href="#">联系我们</a> > <i>在线留言</i></span>
			</div>
			<form name="form1" method="post" class="form_div">
				<ul class="feed_ul clearfix">
					<li>
						<div class="div_biao"><img src="/default/images/ct_tu1.jpg" alt="" />姓名<i>*</i></div>
						<input type="text" name="yourname" placeholder="" id="name"/>
						
					</li>
					<li>
						<div class="div_biao"><img src="/default/images/ct_tu2.jpg" alt="" />电话<i>*</i></div>
						<input type="text" name="youradd" placeholder="" id="phone"/>
					
					</li>
					<li>
						<div class="div_biao"><img src="/default/images/ct_tu3.jpg" alt="" />公司<i>*</i></div>
						<input type="text" name="yourphone" placeholder="" id="add"/>
						
					
					</li>
					<li>
						<div class="div_biao"><img src="/default/images/ct_tu4.jpg" alt="" />邮 箱<i>*</i></div>
						<input type="text" name="youremail" placeholder="" id="email"/>
						
					</li>
				</ul>
				<div class="nei_c">
					<div class="div_biao"><img src="/default/images/ct_tu5.jpg" alt="" />在线留言<i>*</i></div>
					<textarea placeholder="" type="text" name="yourcont" id="cont"></textarea>
				</div>
				<div class="yan_div clearfix">
					<div class="div_biao"><img src="images/ct_tu6.jpg" alt="" />验证码<i>*</i></div>
          <input type="text" name="youryan" onblur="checkyan()" id="yan" placeholder=""/>
<img border="0" align="absMiddle" src="/index.php?module=default&controller=captword&action=codeimg" alt="" style="CURSOR: pointer" id="verifyImg">
					<img src="images/yan_l.jpg" alt="" />
					<a href="">看不清，换一张</a>
				</div>
        <a href="javascript::void(0);" class="btn_th" id="submits">提交</a>
			</form>
			
		</div>
	</div>

<?php
include_once ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
