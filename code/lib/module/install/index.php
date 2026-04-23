<?php
/**
 * Install_Index 安装程序 
 * 
 * @uses Abstract
 * @uses _Install_Controller
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 13:24:32] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Install_Index extends Abstract_Install_Controller {
    public function __construct() {
        parent::__construct();
    }

    /**
     * acIndex 版权信息展示 
     * 
     * @access public
     * @return void
     */
    public function acIndex() {
    }

    /**
     * acCheck 检测服务器环境 
     * 
     * @access public
     * @return void
     */
    public function acCheck() {
        $this->_view['php_version']    = PHP_VERSION;
        $this->_view['cache_is_write'] = is_writeable(ROOT_DIR . '/cache');
    }

    /**
     * acSetinfo 填写数据库信息 
     * 
     * @access public
     * @return void
     */
    public function acSetinfo() {
    }

    /**
     * acCreate 创建数据库 
     * 
     * @access public
     * @return void
     */
    public function acCreate() {
        $create = new Model_Install_Create();
        $create->zyflycom     = ROOT_DIR . '/install/1/zyflycom_index.sql';
        //$create->zyflycomdata = ROOT_DIR . '/install/zyflycom_index_data.sql';
        $create->execute();
    }

    /**
     * acSuccess 成功信息
     * 
     * @access public
     * @return void
     */
    public function acSuccess() {
    }
}
