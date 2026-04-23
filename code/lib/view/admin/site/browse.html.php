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
                    <h2><span>信息查询</span></h2>
                    <div class="module-body">
                            <form action="" autocomplete="off">
                            <input name="module" type="hidden" value="admin" />
                            <input name="controller" type="hidden" value="site" />
                            <input name="action" type="hidden" value="browse" />
                            <p>名称:<input name="title" value="" type="text" class="input-medium" style="width:200px" />
                            <!--开始时间:<input id="d11" name="stattime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />
                            结束时间:<input id="d12" name="endtime" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'2011-01-30 11:30:00',maxDate:'2030-06-30 20:59:30',readOnly:true});" />-->
                            <input type="submit" class="submit-green" value="提交" /></p>
                            </form>
                     </div> <!-- End .module-table-body -->
                </div>
                <div class="module">
                <h2><span>信息列表</span></h2>
                    <div class="module-table-body">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                            <tr>
                                 <th class="header" width="5%">ID</th>
                                 <th class="header">IP</th>
                                 <th class="header">COOKIE</th>
                                 <th class="header">AGENT</th>
                                 <th class="header">RFERER</th>
                                 <th class="header">时间</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
$i = 1;
$page = empty($page) ? 1 : $page;
foreach ($browse as $v) {
    $line = ($i % 2) ? 'odd' : 'even';
    $n = ($page - 1) * 20 + $i++;
    $times = date('Y-m-d H:i:s', $v['create_time']);
    $cookiess = mb_substr($v['cookies'], 0, 100, 'utf-8');
    echo <<< EOF
        <tr class="{$line}">
            <td class="align-center">{$n}</td>
            <td>{$v['ip']}</td>
            <td title="{$v['cookies']}">{$cookiess}</td>
            <td>{$v['agent']}</td>
            <td>{$v['referer']}</td>
            <td>{$times}</td>
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
