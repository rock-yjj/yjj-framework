<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<script type="text/javascript">
//<![CDATA[
function vail() {
    return true;
}
window.addEvent('domready', function() {
});
//]]>
</script>
<script src="/admin/js/My97DatePicker/WdatePicker.js" type="text/javascript" language="javascript"></script>
<script src="/admin/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script>
<script src="/admin/ckfinder/ckfinder.js" type="text/javascript" language="javascript"></script>
<div class="container_12"> 
          <!-- Form elements -->
  <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
	<div class="grid_12">
		<div class="module">
				<h2><span>网站基本参数设置</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();">
            <p>
                <label>网站名称</label>
                <input type="text" name="name" id="name" value="<?php echo empty($site['name']) ? '' : $site['name'];?>" />
            </p>
            <p>
                <label>网站域名</label>
                <input type="text" name="dns" id="dns" value="<?php echo empty($site['dns']) ? '' : $site['dns'];?>" />
            </p>
            <p>
                <label>关键字</label>
                <input type="text" name="key" id="key" value="<?php echo empty($site['key']) ? '' : $site['key'];?>" />
            </p>
            <p>
                <label>网站简介</label>
                <textarea name="info" id="info" cols=40 rows=5><?php echo empty($site['info']) ? '' : $site['info']; ?></textarea>
            </p>
            <p>
                <label>备案信息</label>
                <input type="text" name="icp" id="icp" value="<?php echo empty($site['icp']) ? '' : $site['icp'];?>" />
            </p>
            <p>
                <label>QQ</label>
                <input type="text" name="qq" id="qq" value="<?php echo empty($site['qq']) ? '' : $site['qq'];?>" />
            </p>
            <p>
                <label>Email</label>
                <input type="text" name="email" id="email" value="<?php echo empty($site['email']) ? '' : $site['email'];?>" />
            </p>
            <p>
                <label>电话</label>
                <input type="text" name="tel" id="tel" value="<?php echo empty($site['tel']) ? '' : $site['tel'];?>" />
            </p>
            <p>
                <label>联系人</label>
                <input type="text" name="personl" id="personl" value="<?php echo empty($site['personl']) ? '' : $site['personl'];?>" />
            </p>
            <p>
                <label>手机</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo empty($site['mobile']) ? '' : $site['mobile'];?>" />
            </p>
            <p>
                <label>地址</label>
                <textarea name="address" cols=40 rows=5><?php echo empty($site['address']) ? '' : $site['address']; ?></textarea>
            </p>

            <p>
                <label>版权信息</label>
                <textarea name="copy" cols=40 rows=5><?php echo empty($site['copy']) ? '' : $site['copy']; ?></textarea>
            </p>
            <p>
                <label>上传类型</label>
                <input type="text" name="ext" id="ext" value="<?php echo empty($site['ext']) ? '' : $site['ext'];?>" />
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
