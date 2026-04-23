<?php

/**
 * View 
 * 
 * @package 
 * @version $id$
 * @copyright 2007-2011 yjj
 * @author YJJ <yjj1112@gmail.com> 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class View {
    
    /**
     * _view 视图类
     *
     * @var array
     * @access private
     */
    private $_view = array();
    
    /**
     * _dir 路径
     *
     * @var string
     * @access private
     **/
    private $_dir = '';
    
    /**
     * _context 上下文 
     * 
     * @var mixed
     * @access protected
     */
    protected $_context;
    
    /**
     * __construct 构造函数
     *
     * @param mixed $param
     *
     * @access private
     * @return void
     */
    public function __construct($param, $dir = '') {
        foreach ($param as $k => $v) {
            $this->_view[$k] = $v;
        }
        $this->_dir = $dir;
        $this->_context = new Context();
    }

    /**
     * render 渲染视图
     *
     * @access public
     * @return void
     */
    public function render() {
        if (!empty($this->_dir) && file_exists($this->_dir)) {
            extract($this->_view);
            include $this->_dir;
        }
    }
}
