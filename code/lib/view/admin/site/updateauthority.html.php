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
                <input type="text" name="name" id="name" value="<?php echo empty($authority['name']) ? '' : $authority['name']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>分组</label>
                <select name="module_sn">
<?php
foreach ($module AS $k => $v) {
    if ($authority['module_sn'] == $v['sn']) {
        echo '<option selected="selected" value="' . $v['sn'] . '">' . $v['name'] . '</option>';continue;
    }
    echo '<option value="' . $v['sn'] . '">' . $v['name'] . '</option>';
}
?>
                </select>
            </p>
            <p>
                <label>类名</label>
                <input type="text" name="class_name" id="class_name" value="<?php echo empty($authority['class_name']) ? '' : $authority['class_name']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>方法名</label>
                <input type="text" name="action_name" id="action_name" value="<?php echo empty($authority['action_name']) ? '' : $authority['action_name']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>排序</label>
                <input type="text" name="rank" id="rank" value="<?php echo empty($authority['rank']) ? '' : $authority['rank']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>是否显示</label>
                <select name="is_display">
                    <option value="1">是</option>
                    <option value="0" <?php echo empty($authority['is_display']) ? 'selected="selected"' : ''; ?>>否</option>
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
