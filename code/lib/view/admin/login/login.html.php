<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
?>
<div id=header>
<div id=header-status style="HEIGHT: 38px"></div>
<div id=header-main>
<div class=container_12>
<div class=grid_12>
<div id=logo></div></div></div>
<div class=clear></div></div><!-- End #header-main --></div><!-- End #header -->
<div class=container_12>
<div class="prefix_3 grid_6 suffix_3">
<div class=module>
<H2><SpAN>登&nbsp; 录</SpAN></H2>
<div class=module-body>
<div class="notification n-error" id="error_msg" 
style="DISpLAY: none"></div><INpUT type=hidden value=1 name=ajax> 
<FIELDSET>
<p><LABEL>用户名：</LABEL> <INpUT class=input-medium id=uname name=uname> </p>
<p><LABEL>密码：</LABEL> <INpUT class=input-medium id=pwd type=password name=pwd> 
</p>
<p><LABEL>验证码：</LABEL> <INpUT class=input-medium id=verify name=verify> </p>
<p><IMG id=verifyImg style="CURSOR: pointer" alt="" 
src="<?php echo $this->_context->url('', array('module' => 'default', 'controller' => 'captword', 'action' => 'codeimg')); ?>" align=absMiddle border=0> <LABEL><A id=changeimg 
style="CURSOR: pointer">看不清，再换一张？</A></LABEL> </p><INpUT class=submit-green id=puton type=submit value="登  录"> </FIELDSET> 
</div><!-- End .module-body --></div><!-- End .module --></div><!-- End .grid_6 -->
<div class=clear></div></div><!-- End .container_12 -->
<script type=text/javascript>
//<![CDATA[
window.addEvent('domready', function () {
    $('verifyImg').addEvent('click', function (e) {
        changeimgs();    
    });
    
    $('changeimg').addEvent('click', function (e) {
        changeimgs();    
    });
    
    $('puton').addEvent('click', function (e) {
        var data = {};
        var username = $('uname').value;
        if (username.trim().length == 0) {
            $('error_msg').set('text', '用户名不能为空!');
            $('error_msg').setStyle('display', '');
            return;
        }
        data['u'] = username;

        var password = $('pwd').value;
        if (password.trim().length == 0) {
            $('error_msg').set('text', '密码不能为空!');
            $('error_msg').setStyle('display', '');
            return;
        }
        data['p'] = password;

        var verify   = $('verify').value;
        if (!verify.test(/^[0-9a-zA-Z]{4}$/)) {
            $('error_msg').set('text', '验证码不正确!');
            $('error_msg').setStyle('display', '');
            return;
        }
        data['v'] = verify;

        var request = new Request({
            url    : '<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'login', 'action' => 'login')); ?>',
            method : 'post',
            data   : data,
            async  : false
        }).send();
        var rs = JSON.decode(request.response.text);
        if (rs.stats) {
            window.location = '<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'index', 'action' => 'index')); ?>';
            return;
        }
        $('error_msg').set('text', rs.info);
        $('error_msg').setStyle('display', '');
    });
});

function changeimgs() {
    var url = '<?php echo $this->_context->url('', array('module' => 'default', 'controller' => 'captword', 'action' => 'codeimg')); ?>';
    $('verifyImg').src = url + '&r=' + Math.random();
}
//]]>
</script>
<?php
include_once ROOT_TEMP_DIR . '/view/admin/foot.html.php';
?>
