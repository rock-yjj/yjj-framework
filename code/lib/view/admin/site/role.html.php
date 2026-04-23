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
                    <a href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'addrole')); ?>" class="button">
                        	  <span>添加角色<img width="12" height="9" src="/admin/images/plus-small.gif" alt="New Role"></span>
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
                                 <th class="header" width="26%">操作</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
foreach ($role as $v) {
    $line = ($i % 2) ? 'odd' : 'even';
    $update   = $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'updaterole', 'sn' => $v['sn']));
    $set      = $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'setrole', 'sn' => $v['sn']));
    $delete   = $this->_context->url('', array('module' => 'admin', 'controller' => 'site', 'action' => 'delrole', 'sn' => $v['sn']));
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$i}</td>
            <td>{$v['name']}</td>
            <td><a href="{$set}">设置权限</a> / <a href="{$update}">修改</a> / <a class="delete" href="{$delete}">删除</a></td>
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
