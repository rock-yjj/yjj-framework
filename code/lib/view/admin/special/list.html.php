<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<div class="container_12">
            <div class="grid_12">
						<!-- Notification boxes -->
								<div class="bottom-spacing">
                    <!-- Button -->
                    <div class="float-right">
                    <a href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'special', 'action' => 'add')); ?>" class="button">
                            <span>添加案例<img width="12" height="9" src="/admin/images/plus-small.gif" alt="New Product"></span>
                        </a>
                    </div>
                </div>
                <script language="javascript" type="text/javascript" src="/admin/js/My97DatePicker/WdatePicker.js"></script>
                <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
                <div class="module">
                    <h2><span>案例查询</span></h2>
                    <div class="module-body">
                            <form action="" autocomplete="off">
                            <input name="module" type="hidden" value="admin" />
                            <input name="controller" type="hidden" value="product" />
                            <input name="action" type="hidden" value="list" />
                            <p>名称:<input name="article_title" value="" type="text" class="input-medium" style="width:200px" />
                            <!--开始时间:<input id="d11" name="stattime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />
                            结束时间:<input id="d12" name="endtime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />-->
                            <input type="submit" class="submit-green" value="提交" /></p>
                            </form>
                     </div> <!-- End .module-table-body -->
                </div>
                <div class="module">
                <h2><span>案例列表</span></h2>
                    <div class="module-table-body">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                            <tr>
                                 <th class="header" width="5%">ID</th>
                                 <th class="header">名称</th>
                                 <th class="header">来源</th>
                                 <th class="header">编辑</th>
                                 <th class="header">类别</th>
                                 <th class="header">排序</th>
                                 <th class="header">时间</th>
                                 <th class="header" width="26%">操作</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
$page = empty($page) ? 1 : $page;
foreach ($article as $v) {
    $line = ($i % 2) ? 'odd' : 'even';
    $n = ($page - 1) * 20 + $i++;
    $times = date('Y-m-d H:i:s', $v['create_time']);
    $passport = empty($users[$v['passport_sn']]) ? '' : $users[$v['passport_sn']]['username'];
    $type     = empty($types[$v['type_sn']]) ? '' : $types[$v['type_sn']]['name'];
    $update   = $this->_context->url('', array('module' => 'admin', 'controller' => 'special', 'action' => 'update', 'sn' => $v['sn']));
    $delete   = $this->_context->url('', array('module' => 'admin', 'controller' => 'special', 'action' => 'del', 'sn' => $v['sn']));
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$n}</td>
            <td>{$v['title']}</td>
            <td>{$v['source']}</td>
            <td>{$passport}</td>
            <td>{$type}</td>
            <td>{$v['rank']}</td>
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
