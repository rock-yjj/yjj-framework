<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<div class="container_12">
            <div class="grid_12">
						<!-- Notification boxes -->
                <script language="javascript" type="text/javascript" src="/admin/js/My97DatePicker/WdatePicker.js"></script>
                <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
                <div class="module">
                	<h2><span>友情连接查询</span></h2>
                    <div class="module-body">
                            <form action="" autocomplete="off">
                            <input name="module" type="hidden" value="admin" />
                            <input name="controller" type="hidden" value="friend" />
                            <input name="action" type="hidden" value="list" />
                            <p>网站名称:<input name="title" value="" type="text" class="input-medium" style="width:200px" />
                            <!--开始时间:<input id="d11" name="stattime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />
                            结束时间:<input id="d12" name="endtime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />-->
                            <input type="submit" class="submit-green" value="提交" /></p>
                            </form>
                     </div> <!-- End .module-table-body -->
                </div>
								<div class="bottom-spacing">
                    <!-- Button -->
                    <div class="float-right">
                    <a href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'friend', 'action' => 'add')); ?>" class="button">
                        	  <span>添加友情连接<img width="12" height="9" src="/admin/images/plus-small.gif" alt="New Friend"></span>
                        </a>
                    </div>
                </div>
                <div class="module">
                <h2><span>连接列表</span></h2>
                    <div class="module-table-body">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                            <tr>
                                 <th class="header" width="5%">ID</th>
                                 <th class="header">名称</th>
                                 <th class="header">简介</th>
                                 <th class="header">连接地址</th>
                                 <th class="header">排序</th>
                                 <th class="header">LOGO</th>
                                 <th class="header" width="26%">操作</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
$page = empty($page) ? 1 : $page;
foreach ($friend as $v) {
    $line = ($i % 2) ? 'odd' : 'even';
    $n = ($page - 1) * 20 + $i++;
    $update   = $this->_context->url('', array('module' => 'admin', 'controller' => 'friend', 'action' => 'update', 'sn' => $v['sn']));
    $delete   = $this->_context->url('', array('module' => 'admin', 'controller' => 'friend', 'action' => 'del', 'sn' => $v['sn']));
    $img = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/friend', $v['sn']);
    if (!$img) {
        $img = '';
    } else {
        $img = '<img src="/upload/friend/' . $img . '" width="88" height="33" />';
    }
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$n}</td>
            <td>{$v['title']}</td>
            <td>{$v['info']}</td>
            <td>{$v['url']}</td>
            <td>{$v['rank']}</td>
            <td>{$img}</td>
            <td><a href="{$update}">修改</a> / <a href="{$delete}">删除</a></td>
        </tr>
EOF;
    }
?>
                          </tbody>
                        </table>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->
<?php echo $pagination; ?>
		</div> 
		<div style="clear: both;"></div>
</div>
<?php
include_once ROOT_TEMP_DIR . '/view/admin/foot.html.php';
?>
