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
 * Mssql_Select 
 * 
 * @uses Abstract_Select
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-05-12 15:07:07] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Mssql_Select extends Abstract_Select {
    
    /**
     * _escape_left 左侧转义符号 
     * 
     * @var string
     * @access protected
     */
    protected $_escape_left  = '[';
    
    /**
     * _escape_right 右侧转义符号 
     * 
     * @var string
     * @access protected
     */
    protected $_escape_right = '[';
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
        //有待实现
        return $this;
    }
}

class Db_Select_Exception extends Db_Abstract_Select_Exception {
    public function __construct($info) {
        parent::_construct($info);
    }
}
