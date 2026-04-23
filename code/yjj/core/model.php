<?php
/**
 * Model 
 * 
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2011 yjj
 * @author YJJ <yjj1112@gmail.com> 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Model {

    protected $_context;

    protected function __construct() {
        $this->_context = new Context();
    }

    /**
     * 一个数据库的select实例
     * @return object_select
     */
    protected static function _select() {
        return Db_Pdo::getConn()->select();
    }

    /**
     * _db 实例一个数据库类
     *
     * @access protected
     * @return void
     */
    protected static function _db() {
        return Db_Pdo::getConn();
    }

    /**
     * _find 进一步封装数据库业务逻辑，构造查询
     * 
     * @param object $object_name 
     * @access protected
     * @return void
     */
    protected static function _find($object_name) {
        try {
            return self::_select()->from(strtolower($object_name));
        } catch (Model_Exception $e) {
            throw new Model_Exception('Model:SELECT ' . $object_name . '[' . $e->getMessage() . ']');
        }
    }

    /**
     * _meta 进一步封装数据库逻辑，构造增删改
     * 
     * @param mixed $object_name 
     * @access protected
     * @return void
     */
    protected static function _meta($object_name) {
        try {
            return self::_db()->table($object_name);
        } catch (Model_Exception $e) {
            throw new Model_Exception('Model:CRUD ' . $object_name . '[' . $e->getMessage() . ']');
        }
    }

    /**
     * pagination 分页逻辑 
     * 
     * @param mixed $page_count 
     * @param mixed $current_page 
     * @param int $num 
     * @access public
     * @return void
     */
    public static function pagination($page_count, $current_page, $num = 10) {
        if (2 > $num) throw new Model_Exception('PARAM $num IS ERROR!');

        $start = 1;
        $end   = $num;
        if ($page_count <= $num) {
            $start = 1;
            $end   = $page_count < 1 ? 1 : $page_count;
        } else {
            $step = (int) ($num / 2);
            if (0 === $num % 2) {
                if ($current_page + $step - 1 > $page_count) {
                    $start = $page_count - $num + 1;
                    $end   = $page_count;
                } else {
                    $start = $current_page - $step;
                    $end   = $current_page + $step - 1;
                }
            } else {
                if ($current_page + $step > $page_count) {
                    $start = $page_count - $num + 1;
                    $end = $page_count;
                } else {
                    if ($current_page - $step < 1) {
                        $start = 1;
                        $end = $num;
                    } else {
                        $start = $current_page - $step;
                        $end   = $current_page + $step;
                    }
                }
            }
        }

        return array('start' => $start, 'end' => $end);
    }
}

class Model_Exception extends Core_Exception {
    public function __construct() {
        parent::__construct();
    }
}
