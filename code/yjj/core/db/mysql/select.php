<?php
 /************************************************************ 
  * 封装数据库查询语句
  *
  * @filename: Select.Class.php 2010-03-23 13:22
  * @copyright: Copyright by 2010 - 2020
  * @author: <yjj1112@gmail.com> yjj
  * @link:
  ***********************************************************/
/**
 * Mysql_Select 
 * 
 * @uses Abstract_Select
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-05-12 15:07:07] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Mysql_Select extends Abstract_Select {
    /**
     * 构造函数
     * @param array $filed //需要查询的字段
     * @return void
     */
    public function __construct($db_object = null) {
        parent::__construct($db_object);
    }

    /**
     * 封装LIMIT子句
     * @param int $start
     * @param int $end
     * @return Object_Select
     */
    public function limit($start = 0, $end = 30) {
        $this->_limit = sprintf('LIMIT %d,%d', $start, $end);
        return $this;
    }

    /**
     * 封装 ORDER 子句
     * [CODE]
     * $db->select()->from()->order(
     *      array('fields1 desc', 'fields2 ASC', ... ...)
     * )->query();
     * [/CODE]
     *
     * [CODE]
     * $db->select()->from()->order(
     *      'fields desc'
     * )->query();
     * [/CODE]
     * 
     * @param string|array $order
     * @return Object_Select
     */
    public function order($order = null) {
        if (!empty($order)) {
            $this->_order = 'ORDER BY ';
            if (is_array($order)) {
                $this->_order .= implode(',', $order);
            } else {
                $this->_order .= $order;
            }
        }
        return $this;
    }
}

class Db_Select_Exception extends Db_Abstract_Select_Exception {
    public function __construct($info) {
        parent::__construct($info);
    }
}
