<?php
/**
 * Abstract_Install_Controller 
 * 
 * @uses Abstract
 * @uses _Module_Controller
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 13:12:51] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Install_Controller extends Abstract_Module_Controller {

    /**
     * __construct 
     * 
     * @access protected
     * @return void
     */
    protected function __construct() {
        parent::__construct();
    }
    
    /**
     * 在执行控制器之前执行
     */
    public function before_controller() {
    }

    /**
     * 在执行控制器之后执行
     */
    public function after_controller() {}

    
    public function getView() {
        return $this->_view;
    }

    public function getViewname() {
        return $this->_viewname;
    }

    protected function _db() {
        return Db_Pdo::getConn();
    }
}
