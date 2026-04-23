<?php 
include_once ROOT_TEMP_DIR . '/view/default/head.html.php';
include_once ROOT_TEMP_DIR . '/view/default/top.html.php';
?>
<script src="/default/js/jquery-1.5.1.min.js"></script>
<div style=" height:122px; background:#D8E9F1 url(/default/images/ny_img5.jpg) no-repeat center top;"></div>
<div style="background:#fff;">
  <div class="ny w_980">
    <div class="left" style="width:193px;">
      <div class="sub_nav m_t_15">
        <div class="h2_1">05 留言</div>
        <ul>
          <li><a href="<?php echo $this->_context->url('', array('controller' => 'feedback', 'action' => 'add')); ?>">我要留言</a></li>
          <li><a href="<?php echo $this->_context->url('', array('controller' => 'feedback', 'action' => 'list')); ?>">查看留言</a></li>
        </ul>
      </div>
      <div class="lxwm_1">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="57" align="center" valign="bottom"><div class="f_tb1">　　 　13572121782</div></td>
          </tr>
          <tr>
            <td height="82" valign="bottom" style="padding-left:10px;">　西安峻网网络科技有限公司<br />
              全国服务热线：13572121782<br />
              公司地址：陕西省西安市科技路<br />
              天朗蓝湖树</td>
          </tr>
        </table>
      </div>
      <div class="clear"></div>
    </div>
    <div class="nr_y right m_t_15">
    	<div class="h2_2"><span class="left">查看留言<font class="f_c_bd"> MESSAGE</font></span><span class="right">当前位置:<a href="#">首页</a>　>　<a href="#">在线留言</a></span></div>
        <div class="guestbook">
        <div class="hzzy_con">
            <div style="padding:10px; border:solid 1px #E6E6E6; background:#F7F7F7;">
              <p class="f_c_bd"><b>留言说明</b></p>
              <p>1、为了给大家更好的服务，我们需要收集大家的宝贵意见。<br />
                2、留言必须理智，不能有过激言论。<br />
              </p>
            </div>
<?php 
foreach ($feedback as $v) {
    $create_time = date('Y年m月d日', (int) $v['create_time']);
    $replay_time = date('Y年m月d日', (int) $v['replay_time']);
    echo <<< EOF
           <div class="same_05">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#F3FBFE" align="right"><font class="f_c_bd">留 言 人：</font></td>
                  <td width="63%" bgcolor="#F3FBFE">{$v['customer']}</td>
                  <td width="26%" bgcolor="#F3FBFE" class=" f_c_bd">留言时间：[{$create_time}]</td>
                </tr>
                <tr>
                  <td width="11%" valign="top" align="right"><font class="f_c_bd">留言内容：</font></td>
                  <td colspan="2">{$v['content']}</td>
                </tr>
                <tr>
                  <td valign="top" align="right"><font class="f_c_bd">回复内容：</font></td>
                  <td>{$v['replay']}</td>
                  <td class="f_c" valign="top">回复时间：[{$replay_time}]</td>
                </tr>
              </table>
            </div>
EOF;
}
?>
          </div>
<div id="pagination">
<?php
if (!empty($pagination)) {
    $first_page = $this->_context->url('', array('controller' => 'feedback', 'action' => 'list', 'page' => 1));
    echo '<a href="' . $first_page . '">首页</a>';
    for($i = $pagination['start']; $i <= $pagination['end']; $i++) {
        $url = $this->_context->url('', array('controller' => 'feedback', 'action' => 'list', 'page' => $i));
        if ($i == $current_page) {
            echo '<a href="' . $url . '"><b>' . $i . '</b></a>';
        } else {
            echo '<a href="' . $url . '">' . $i . '</a>';
        }
    }
    $last_page = $this->_context->url('', array('controller' => 'feedback', 'action' => 'list', 'page' => $page_count));
    echo '<a href="' . $last_page . '">末页</a>';
}
?>
</div>

        </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php 
include_once ROOT_TEMP_DIR . '/view/default/foot.html.php';
?>
