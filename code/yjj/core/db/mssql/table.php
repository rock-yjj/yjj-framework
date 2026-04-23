<?php
 /************************************************************ 
  * 
  * @filename: Table.Class.php 2010-03-23 16:17
  * @copyright: Copyright by 2010 - 2020
  * @author: <yjj1112@gmail.com> yjj
  * @link:
  ***********************************************************/

class Mssql_Table extends Abstract_Table {

    /**
     * _escape_left 转义符号，默认为MYSQL转义符号
     *
     * @var string
     * @access protected
     */
    protected $_escape_left  = '[';

    /**
     * _escape_right 转义符号，默认为MYSQL转义符号
     *
     * @var string
     * @access protected
     */
    protected $_escape_right = ']';

    /**
     * 构造函数
     * @param db_resource $db_object
     * @param string      $tablename
     */
    public function __construct($db_object = null, $tablename = null) {
        parent::__construct($db_object, $tablename);
    }
}

class Db_Table_Exception extends Db_Abstract_Table_Exception {
    public function __construct($info) {
        parent::__construct($info);
    }
}
