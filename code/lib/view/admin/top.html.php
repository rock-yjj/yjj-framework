    	<!-- Header -->
        <div id="header">
            <!-- Header. Status part -->
            <div id="header-status">
                <div class="container_12">
                    <div class="grid_8">
                    <span id="text-invitation">Welcome <font color="#FF0000">管理员</font> <?php echo $_SESSION['userinfo']['realname']; ?><font color="#FF0000"> &nbsp;( 注:请谨慎使用后台管理系统！)</font></span>
                    </div>
                    <div class="grid_4">
                    <a href="<?php echo WEB_URL; ?>/index.php?controller=logout&action=logout" id="logout">
                        退&nbsp; 出
                        </a>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End #header-status -->
            
            <!-- Header. Main part -->
            <div id="header-main">
                <div class="container_12">
                    <div class="grid_12">
                        <div id="logo">
                            <ul id="nav">

                              <!-- 循环导航 -->
<?php 
foreach ($_SESSION['usermodule'] as $k => $v) {
        echo sprintf('<li id="%s"><a href="%s">%s</a></li>', ($k == $current_module) ? 'current' : $k, $v['url'], $v['name']);
    }
?>
                            </ul>
                        </div><!-- End. #Logo -->
                    </div><!-- End. .grid_12-->
                    <div style="clear: both;"></div>
                </div><!-- End. .container_12 -->
            </div> <!-- End #header-main -->
            <div style="clear: both;"></div>
            <!-- Sub navigation -->
            <div id="subnav">
                <div class="container_12">
                    <div class="grid_12">
                        <ul>
<?php
    foreach ($_SESSION['userauth'] as $k => $v) {
        if (($current_module == $v['module_sn']) && (1 == $v['is_display'])) {
            echo sprintf('<li><a href="%s">%s</a></li>', $this->_context->url('', array('module' => 'admin', 'controller' => $v['class_name'], 'action' => $v['action_name'])), $v['name']);
        }
    }
?>
                        </ul>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div> <!-- End #subnav -->
        </div> 
        <!-- End #header -->
