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
<form method="post" action="/index.php?module=install&controller=index&action=create">
<div style="width:990px;border:5px solid #58A0F0;height:500px;margin:0 auto;background-color:#ffffff;">
数据库地址:<input value="localhost" type="text" name="db_url" /><br />
数据库名:<input value="" type="text" name="db_name"/><br />
数据库用户名:<input value="" type="text" name="db_root"/><br />
用户密码:<input value="" type="text" name="db_password"/><br />
管理员用户名:<input value="" type="text" name="admin_name"/><br />
管理员密码:<input value="" type="text" name="admin_password"/><br />
</div>
<div style="height:10px;"></div>
<div style="width:990px; margin:0 auto;">
    <input type="submit" id="button" value="确定" style="border:5px solid #58A0F0; width:200px; height:50px;background-color:#1C5DD4;font-size:16px;font-weight:bold;color:#ffffff;" />
</div>
</form>
<script type="text/javascript">
//<[!CDATA[
//document.getElementById('button').onclick = function () {
//    window.location = '/index.php?module=install&controller=index&action=create';
//}
//]]>
</script>
</body>
</html>
