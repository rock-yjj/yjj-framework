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
<div class="container_12"> 
          <!-- Form elements -->
  <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
	<div class="grid_12">
		<div class="module">
				<h2><span>修改下载</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();" enctype="multipart/form-data">
            <p>
                <label>名称</label>
                <input type="text" name="title" id="titles" value="<?php echo empty($download['title']) ? '' : $download['title'];?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>上传文件</label>
                <input type="file" name="upload" value="" class="input-medium" style="width:200px" /><br /><br />
                <a href="<?php echo $download['download_url']; ?>"><?php echo $download['title']; ?></a>
            </p>
            <p>
                <label>排序</label>
                <input type="text" name="rank" value="<?php echo empty($download['rank']) ? '' : $download['rank'];?>" class="input-medium" style="width:50px" />
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
