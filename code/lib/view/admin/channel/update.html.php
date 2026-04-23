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
				<h2><span>添加渠道</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();">
            <p>
                <label>名称</label>
                <input type="text" name="name" id="name" value="<?php echo empty($channel['name']) ? '' : $channel['name']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>描述</label>
                <textarea name="desc"><?php echo empty($channel['desc']) ? '' : $channel['desc']; ?></textarea>
            </p>
            <p>
                <label>链接</label>
                <input type="text" name="url" id="url" value="<?php echo empty($channel['url']) ? '' : $channel['url']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>排序</label>
                <input type="text" name="rank" id="rank" value="<?php echo empty($channel['rank']) ? '' : $channel['rank']; ?>" class="input-medium" style="width:200px" />
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
