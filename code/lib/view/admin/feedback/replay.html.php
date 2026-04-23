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
				<h2><span>留言回复编辑</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();">
            <p>
                <label>用户名</label>
                <?php echo empty($feedback['customer']) ? '' : $feedback['customer']; ?>
                <input type="hidden" name="sn" id="sn" value="<?php echo empty($feedback['sn']) ? '' : $feedback['sn'];?>" />
            </p>
            <p>
                <label>性别</label>
                <?php echo empty($feedback['gender']) ? '' : $feedback['gender']; ?>
            </p>
            <p>
                <label>电话</label>
                <?php echo empty($feedback['tel']) ? '' : $feedback['tel']; ?>
            </p>
            <p>
                <label>Email</label>
                <?php echo empty($feedback['email']) ? '' : $feedback['email']; ?>
            </p>
            <p>
                <label>留言内容</label>
                <textarea name="content" cols=40 rows=5><?php echo empty($feedback['content']) ? '' : $feedback['content']; ?></textarea>
            </p>
            <p>
                <label>回复</label>
                <textarea name="replay" cols=40 rows=5><?php echo empty($feedback['replay']) ? '' : $feedback['replay']; ?></textarea>
            </p>
            <p>
                <label>审核</label>
<select name="examine">
<?php 
        echo '<option value="0">否</option>';
        if (1 == $feedback['is_examine']) {
            echo '<option value="1" selected="selected">是</option>';
        } else {
            echo '<option value="1">是</option>';
        }
?>
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
