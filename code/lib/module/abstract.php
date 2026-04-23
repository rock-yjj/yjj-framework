<?php
/**
 * Abstract_Module_Controller 
 * 
 * @uses Abstract
 * @uses _Controller
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 10:55:25] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Module_Controller extends Abstract_Controller {

    /**
     * _page_size 默认分页 
     * 
     * @var float
     * @access protected
     */
    protected $_page_size = 20;

    /**
     * _view 视图变量 
     * 
     * @var array
     * @access protected
     */
    protected $_view = array();

    /**
     * _viewname 视图名称 
     * 
     * @var string
     * @access protected
     */
    protected $_viewname = '';

    /**
     * _module 模块 
     * 
     * @var string
     * @access protected
     */
    protected $_module = 'Default';

    protected function __construct() {
        parent::__construct();
    }

        
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
