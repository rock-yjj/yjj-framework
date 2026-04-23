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
				<h2><span>添加友情连接</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();" enctype="multipart/form-data">
            <p>
                <label>网站名称</label>
                <input type="text" name="title" id="titles" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>连接地址</label>
                <input type="text" name="url" id="url" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>网站简介</label>
                <textarea rows="5" cols="40" id="info" name="info"></textarea>
            </p>
            <p>
                <label>上传logo</label>
                <input type="file" name="upload" id="file" value="" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>排序</label>
                <input type="text" name="rank" id="rank" value="" class="input-medium" style="width:200px" />
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
