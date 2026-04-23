<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>程序安装系统</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="Bookmark" href="/jw.ico" >
</head>
<body style="padding:0px 0px 0px 0px; margin:0 auto;background-color:#337AFB;">
<div style="width:990px;height:100px;border:5px solid #58A0F0;margin:0 auto;"></div>
<div style="height:10px;"></div>
<div style="width:990px;border:5px solid #58A0F0;height:500px;margin:0 auto;background-color:#ffffff;">
PHP版本:<?php echo $php_version; ?>
日志目录CACHE:<?php echo $cache_is_write ? '可写' : '不可写'; ?>
</div>
<div style="height:10px;"></div>
<div style="width:990px; margin:0 auto;">
    <button id="button" style="border:5px solid #58A0F0; width:200px; height:50px;background-color:#1C5DD4;font-size:16px;font-weight:bold;color:#ffffff;">确定</button>
</div>
<script type="text/javascript">
//<[!CDATA[
document.getElementById('button').onclick = function () {
    window.location = '/index.php?module=install&controller=index&action=setinfo';
}
//]]>
</script>
</body>
</html>
