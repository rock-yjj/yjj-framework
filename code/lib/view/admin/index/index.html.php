<?php
include_once ROOT_TEMP_DIR . '/view/admin/head.html.php';
include_once ROOT_TEMP_DIR . '/view/admin/top.html.php';
?>
<div class="container_12">
            <!-- Dashboard icons -->
            <div class="grid_7">
            <a class="dashboard-module" href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'article', 'action' => 'add')); ?>">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_write.gif">
                	<span>New article</span>
                </a>
                
                <a class="dashboard-module" href="">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_file.gif">
                	<span>Upload file</span>
                </a>
                
                <a class="dashboard-module" href="<?php echo $this->_context->url('', array('module' => 'admin', 'controller' => 'article', 'action' => 'list')); ?>">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_files.gif">
                	<span>Articles</span>
                </a>
                
                <a class="dashboard-module" href="">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_calendar.gif">
                	<span>Calendar</span>
                </a>
                
                <a class="dashboard-module" href="">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_user.gif">
                	<span>My profile</span>
                </a>
                
                <a class="dashboard-module" href="">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_stats.gif">
                	<span>Stats</span>
                </a>
                
                <a class="dashboard-module" href="">
                	<img height="64" width="64" alt="edit" src="/admin/images/Crystal_Clear_settings.gif">
                	<span>Settings</span>
                </a>
                <div style="clear: both;"></div>
            </div> <!-- End .grid_7 -->
            
            <!-- Account overview -->
            <div class="grid_5">
                <div class="module">
                        <h2><span>Account overview</span></h2>
                        
                        <div class="module-body">
                        
                        	<p>
                          <strong>User: </strong><?php echo $_SESSION['userinfo']['username']; ?><br>
                          <strong>Your last visit was on: </strong><?php echo date('Y-m-d H:i:s', time()); ?><br>
                          <strong>From IP: </strong><?php echo $_SERVER['REMOTE_ADDR']; ?></p>
                             <div>
                                 <div class="indicator">
                                     <div style="width: 23%;"></div><!-- change the width value (23%) to dynamically control your indicator -->
                                 </div>
                                 <p>Your storage space: 23 MB out of 100MB</p>
                             </div>
                             
                             <div>
                                 <div class="indicator">
                                     <div style="width: 100%;"></div><!-- change the width value (100%) to dynamically control your indicator -->
                                 </div>
                                 <p>Your bandwidth (January): 1 GB out of 1 GB</p>
                             </div>
                             
                        	<p>
                                Need to switch to a bigger plan?<br>
                                <a href="">click here</a><br>
                            </p>

                        </div>
                </div>
                <div style="clear: both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear: both;"></div>

        </div>
<?php
include_once ROOT_TEMP_DIR . '/view/admin/foot.html.php';
?>
