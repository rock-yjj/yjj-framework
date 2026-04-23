<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<div class="container_12">
            <div class="grid_12">
						<!-- Notification boxes -->
                <script language="javascript" type="text/javascript" src="/admin/js/My97DatePicker/WdatePicker.js"></script>
                <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
								<div class="bottom-spacing">
                    <!-- Button -->
                    <div class="float-right">
                    <a href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'addauthority')); ?>" class="button">
                        	  <span>添加权限<img width="12" height="9" src="/admin/images/plus-small.gif" alt="New Authority"></span>
                        </a>
                    </div>
                </div>
                <div class="module">
                <h2><span>权限列表</span></h2>
                    <div class="module-table-body">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                            <tr>
                                 <th class="header" width="5%">ID</th>
                                 <th class="header">名称</th>
                                 <th class="header">所属组</th>
                                 <th class="header">类</th>
                                 <th class="header">方法</th>
                                 <th class="header">排序</th>
                                 <th class="header">是否显示</th>
                                 <th class="header" width="26%">操作</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
foreach ($authority as $v) {
    $line = ($i % 2) ? 'odd' : 'even';
    $update   = $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'updateauthority', 'sn' => $v['sn']));
    $delete   = $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'delauthority', 'sn' => $v['sn']));
    $module_name = empty($module[$v['module_sn']]['name']) ? '' : $module[$v['module_sn']]['name'];
    $is_display = empty($v['is_display']) ? '否' : '是';
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$i}</td>
            <td>{$v['name']}</td>
            <td>{$module_name}</td>
            <td>{$v['class_name']}</td>
            <td>{$v['action_name']}</td>
            <td>{$v['rank']}</td>
            <td>{$is_display}</td>
            <td><a href="{$update}">修改</a> / <a class="delete" href="{$delete}">删除</a></td>
        </tr>
EOF;
$i++;
}
?>
                          </tbody>
                        </table>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->
		</div> 
		<div style="clear: both;"></div>
</div>
<?php
include_once ROOT_TEMP_DIR . '/view/admin/foot.html.php';
?>
