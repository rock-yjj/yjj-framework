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
				<h2><span>添加权限</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();">
            <p>
                <label>名称</label>
                <input type="text" name="name" id="name" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>分组</label>
                <select name="module_sn">
<?php
foreach ($module AS $k => $v) {
    echo '<option value="' . $v['sn'] . '">' . $v['name'] . '</option>';
}
?>
                </select>
            </p>
            <p>
                <label>类名</label>
                <input type="text" name="class_name" id="class_name" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>方法名</label>
                <input type="text" name="action_name" id="action_name" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>排序</label>
                <input type="text" name="rank" id="rank" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>是否显示</label>
                <select name="is_display">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </p>
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
