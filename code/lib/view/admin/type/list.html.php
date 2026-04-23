<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
                <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
<?php
foreach ($type AS $k => $v) {
?>
<div class="container_12">
            <div class="grid_12">
						<!-- Notification boxes -->
								<div class="bottom-spacing">
                    <!-- Button -->
                    <div class="float-right">
                    <a href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'type', 'action' => 'add', 'sn' => $k)); ?>" class="button">
                        	  <span>添加类别<img width="12" height="9" src="/admin/images/plus-small.gif" alt="New Type"></span>
                        </a>
                    </div>
                </div>
                <div class="module">
                <h2><span>频道 <?php echo empty($channel[$k]['name']) ? '' : $channel[$k]['name']; ?> 分类</span></h2>
                    <div class="module-table-body">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                            <tr>
                                 <th class="header" width="5%">ID</th>
                                 <th class="header">名称</th>
                                 <th class="header">排序</th>
                                 <th class="header" width="26%">操作</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
foreach ($v as $ks => $vs) {
    $line = ($i % 2) ? 'odd' : 'even';
    $update   = $this->_context->url('', array('module' => 'admin', 'controller' => 'type', 'action' => 'update', 'sn' => $k, 'type_sn' => $ks));
    $delete   = $this->_context->url('', array('module' => 'admin', 'controller' => 'type', 'action' => 'del', 'sn' => $vs['sn']));
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$i}</td>
            <td>{$vs['name']}</td>
            <td>{$vs['rank']}</td>
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
}
include_once ROOT_TEMP_DIR . '/view/admin/foot.html.php';
?>
