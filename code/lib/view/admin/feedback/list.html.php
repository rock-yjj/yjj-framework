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
                	<h2><span>留言查询</span></h2>
                    <div class="module-body">
                            <form action="" autocomplete="off">
                            <input name="module" type="hidden" value="admin" />
                            <input name="controller" type="hidden" value="feedback" />
                            <input name="action" type="hidden" value="list" />
                            <p>留言内容:<input name="article_title" value="" type="text" class="input-medium" style="width:200px" />
                            <!--开始时间:<input id="d11" name="stattime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />
                            结束时间:<input id="d12" name="endtime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />-->
                            <input type="submit" class="submit-green" value="提交" /></p>
                            </form>
                     </div> <!-- End .module-table-body -->
                </div>
                <div class="module">
                <h2><span>留言列表</span></h2>
                    <div class="module-table-body">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                            <tr>
                                 <th class="header" width="5%">ID</th>
                                 <th class="header">用户名</th>
                                 <th class="header">性别</th>
                                 <th class="header">电话/QQ</th>
                                 <th class="header">Email</th>
                                 <th class="header">内容</th>
                                 <th class="header">回复</th>
                                 <th class="header">IP</th>
                                 <th class="header">审核</th>
                                 <th class="header">时间</th>
                                 <th class="header" width="26%">操作</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
$page = empty($page) ? 1 : $page;
foreach ($feedback as $v) {
    $line = ($i % 2) ? 'odd' : 'even';
    $n = ($page - 1) * 20 + $i++;
    $times = date('Y-m-d H:i:s', $v['create_time']);
    $gender = empty($v['gender']) ? '女' : '男';
    $examine = empty($v['is_examine']) ? '未审核' : '已审核';
    $update   = $this->_context->url('', array('module' => 'admin', 'controller' => 'feedback', 'action' => 'replay', 'sn' => $v['sn']));
    $delete   = $this->_context->url('', array('module' => 'admin', 'controller' => 'feedback', 'action' => 'del', 'sn' => $v['sn']));
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$n}</td>
            <td>{$v['customer']}</td>
            <td>{$gender}</td>
            <td>{$v['tel']}</td>
            <td>{$v['email']}</td>
            <td>{$v['content']}</td>
            <td>{$v['replay']}</td>
            <td>{$v['ip']}</td>
            <td>{$examine}</td>
            <td>{$times}</td>
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
