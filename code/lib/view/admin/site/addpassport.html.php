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
				<h2><span>添加用户</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();">
            <p>
                <label>用户名</label>
                <input type="text" name="name" id="name" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>密码</label>
                <input type="text" name="password" id="password" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>角色</label>
<select name="role_sn">
<?php 
foreach ($role AS $k => $v) {
    echo '<option value="' . $v['sn'] . '">' . $v['name'] . '</option>';
}
?>
</select>
            </p>
            <p>
                <label>真是姓名</label>
                <input type="text" name="realname" id="realname" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>电话</label>
                <input type="text" name="tel" id="tel" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>邮箱</label>
                <input type="text" name="email" id="email" value="" class="input-medium" style="width:200px" />
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
