<?php
/**
 * Abstract_Controller 抽象出controller
 * 
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author YJJ <yjj1112@gmail.com>. ADD TIME:2012-05-13 02:38:16 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Controller {

    /**
     * _context 上下文处理
     * 
     * @var object
     * @access protected
     */
    protected $_context;

    /**
     * __construct 构造函数
     * 
     * @access protected
     * @return void
     */
    protected function __construct() {
        $this->_context = new Context();
    }

    /**
     * _after_controller 执行控制器之后
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract public function after_controller();
    
    /**
     * _before_controller 执行控制器之前
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract public function before_controller();
}

abstract class Abstract_Controller_Exception extends Exception{
    public function __construct($info) {
        parent::__construct($info);
    }
}
