<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<script type="text/javascript">
//<![CDATA[
function vail() {
    return true;
}
//]]>
</script>
<script src="/admin/js/My97DatePicker/WdatePicker.js" type="text/javascript" language="javascript"></script>
<?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
<div class="container_12"> 
					<!-- Form elements -->
	<div class="grid_12">
		<div class="module">
				<h2><span>设置角色权限</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();">
<?php 
foreach ($module AS $vm) {
    echo '<p><label>' . $vm['name'] . '</label>';
    foreach ($authority AS $k => $v) {
        if ($v['module_sn'] != $vm['sn']) continue;
        $checkbox = empty($role_authority[$v['sn']]) ? '' : 'checked="checked"';
        echo <<< EOF
                {$v['name']}
                <input type="checkbox" name="authority_sn[]" value="{$v['sn']}" {$checkbox} />
EOF;
    }
    echo '</p>';
}
?>
 					<fieldset>
						<input type="submit" value="提  交" class="submit-green">
						<input type="reset" value="重 置" id="cancel" class="submit-gray" name="cancel">
          </fieldset>
        </form>
			</div>
							<!-- End .module-body --> 
							
						</div>
		<!-- End .module -->
		<div style="clear: both;"></div>
	</div>
					<!-- End .grid_12 -->
					<div style="clear: both;"></div>
      </div>
<?php
include_once ROOT_TEMP_DIR . '/view/admin/foot.html.php';
?>
