<?php
/**
 * 自动加载类
 * @param string $class_name
 */
function __autoload($class_name) {
    $dirs = array(
        ROOT_DIR . '/lib/',
        ROOT_DIR . '/yjj/core/db/'
    );

    foreach( $dirs as $dir ) {
        $class_name_dir = strtolower(str_replace('_', '/', $class_name));
        $file_dir = $dir . $class_name_dir . '.php';
        if(file_exists($file_dir)) {
            require_once($file_dir);break; //名字一般不允许重复，如果存在重名类，这里将面临重构
        }
    }
}

/**
 * 核心配置文件，框架主核心，一般情况下比_config.php更新比较慢，因此单独配置  
 */
include ROOT_DIR . '/yjj/core/config/_config.php';

/**
 * Core 
 * 
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 11:02:16] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Core {
    
    /**
     * _module_name 模块名 
     * 
     * @var string 默认为default
     * @access private
     */
    private $_module_name = 'Default';
    
    /**
     * _controller_name 控制器  
     * 
     * @var string 默认为index
     * @access private
     */
    private $_controller_name = 'Index';
    
    /**
     * _controller_object_name 目标控制器对象名 
     * 
     * @var string 默认为default_index
     * @access private
     */
    private $_controller_object_name = 'Default_Index';

    /**
     * _action 当前控制器动作
     * 
     * @var string
     * @access private
     */
    private $_action = 'index';
    
    /**
     * _controller 当前控制器对象实例 
     * 
     * @var object
     * @access private
     */
    private $_controller;

    /**
     * _view 视图参数
     * 
     * @var array
     * @access protected
     */
    protected $_view = array();
    
    /**
     * _viewname 视图文件名 
     * 
     * @var string
     * @access protected
     */
    protected $_viewname = '';
    
    /**
     * __construct 构造函数
     *
     * 确定当前模块、控制器、动作等
     * 确定是否开启session 
     * 
     * @access private
     * @return void
     */
    private function __construct() {
        if (IS_SESSION_START) {
            if (!isset($_SESSION)) {
                $this->_session_start();
            }
        }

        date_default_timezone_set('Asia/Chongqing');

        $this->_module_name     = empty($_GET['module']) ? $this->_module_name : (string) firstToBig(escape($_GET['module']));
        $this->_controller_name = empty($_GET['controller']) ? $this->_controller_name : (string) firstToBig(escape($_GET['controller']));
        $this->_action = empty($_GET['action']) ? $this->_action : (string) firstToBig(escape($_GET['action']));
    }

    private function __init() {
        $this->_controller_object_name = $this->_module_name . '_' . $this->_controller_name;
        $dir = ROOT_DIR . '/lib/module/' . strtolower($this->_module_name . '/' . $this->_controller_name) . '.php';
        if (file_exists($dir)) {
            require_once($dir);
        } else {
            throw new Exception(sprintf('文件: [%s] 不存在', $dir));
        }
        $this->_controller = new $this->_controller_object_name($this->_module_name);
    }

    public function execute() {
        $this->__init();
        $this->_controller->before_controller();   //执行完之前
        $action = 'ac' . ucfirst(strtolower($this->_action));
        $this->_controller->$action();
        $this->_viewname = $this->_controller->getViewname();
        $viewname = empty($this->_viewname) ? $this->_action : $this->_viewname;
        $view_dir = ROOT_VIEW_DIR . '/' . strtolower($this->_module_name . '/' . $this->_controller_name . '/' . $viewname) . '.html.php';
        $view = new View($this->_controller->getView(), $view_dir); //获取参数
        $view->render(); //加载视图
        $this->_controller->after_controller();    //执行完以后
    }

    /**
     * 实例化一个 controller 的句柄 单例模式
     *
     */
    public static function handle() {
        return new self();
    }

    /**
     * 打开session
     */
    protected function _session_start() {
        session_start();
    }

    public function createStatic($module = 'default', $controller = 'index', $action = 'index', $viewname = 'index') {
        global $is_create_static;
        $is_create_static = true; 
        $this->_controller_name = $controller;
        $this->_module_name     = $module;
        $this->_action          = $action;
        $this->execute();
    }
}
