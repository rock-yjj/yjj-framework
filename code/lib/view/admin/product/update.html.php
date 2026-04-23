<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<script src="/admin/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script>
<script src="/admin/ckfinder/ckfinder.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
//<![CDATA[
function vail() {
    return true;
}
window.addEvent('domready', function() {
    var editor = CKEDITOR.replace('editor1',{
        filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl : '/index.php?module=admin&controller=article&action=upload',
        filebrowserImageUploadUrl : '/index.php?module=admin&controller=article&action=upload&type=Images'
    });
});
//]]>
</script>
<script src="/admin/js/My97DatePicker/WdatePicker.js" type="text/javascript" language="javascript"></script>
<div class="container_12"> 
          <!-- Form elements -->
  <?php echo empty($flashmessage) ? '' : '<div style="text-align:center;"><font color="red">' . $flashmessage . '</font></div>'; ?>
	<div class="grid_12">
		<div class="module">
				<h2><span>修改产品</span></h2>
        <div class="module-body">
            <form action="" method="post" onsubmit="return vail();" enctype="multipart/form-data">
            <p>
                <label>名称</label>
                <input type="text" name="title" id="titles" value="<?php echo empty($article['title']) ? '' : $article['title'];?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>类别</label>
<select name="article_type_sn">
<?php 
    foreach ($article_type as $v) {
        if ($article['type_sn'] == $v['sn']) {
            echo '<option value="' . $v['sn'] . '" selected="selected">' . $v['name'] . '</option>';
        } else {
            echo '<option value="' . $v['sn'] . '">' . $v['name'] . '</option>';
        }
    }
?>
</select>
            </p>
            <p>
                <label>关键字</label>
                <input type="text" name="article_key" value="<?php echo empty($article['keywords']) ? '' : $article['keywords']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>缩略图</label>
                <input type="file" name="upload" value="" class="input-medium" style="width:200px" /><br /><br />
<?php 
if ($img_url = $this->_context->imageIsExist(ROOT_DIR . '/public/upload/product', $article['sn'])) {
    echo '<img src="/upload/product/thumb_' . $img_url . '" width="118" height="84"/>';
}
                ?>
            </p>
            <p>
                <label>简介</label>
                <textarea name="article_info" cols=40 rows=5><?php echo empty($article['introduction']) ? '' : $article['introduction']; ?></textarea>
            </p>
            <p>
                <label>来源</label>
                <input type="text" name="source" value="<?php echo empty($article['source']) ? '' : $article['source']; ?>" class="input-medium" style="width:200px" />
            </p>
            <p>
                <label>编辑</label>
<select name="passport_sn">
<?php 
    foreach ($passport as $v) {
        if ($v['sn'] == $article['passport_sn']) {
            echo '<option value="' . $v['sn'] . '" selected="selected">' . $v['username'] . '</option>';
        } else {
            echo '<option value="' . $v['sn'] . '">' . $v['username'] . '</option>';
        }
    }
?>
</select>
            </p>
            <p>
                <label>内容</label>
                <textarea name="content" cols=40 rows=5 id="editor1"><?php echo empty($article['content']) ? '' : $article['content']; ?></textarea>
            </p>
            <p>
                <label>点击率</label>
                <input type="text" name="click" value="<?php echo empty($article['click']) ? '' : $article['click'];?>" class="input-medium" style="width:50px" />
            </p>
            <p>
                <label>排序</label>
                <input type="text" name="rank" value="<?php echo empty($article['rank']) ? '' : $article['rank'];?>" class="input-medium" style="width:50px" />
            </p>
            <p>
                <label>推荐</label>
                <select id="recommend" name="recommend">
                    <option value="0">否</option>
                    <option value="1" <?php echo empty($article['recommend']) ? '' : 'selected="selected"'?>>是</option>
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
