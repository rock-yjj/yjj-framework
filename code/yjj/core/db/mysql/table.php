<?php
 /************************************************************ 
  * 
  * @filename: Table.Class.php 2010-03-23 16:17
  * @copyright: Copyright by 2010 - 2020
  * @author: <yjj1112@gmail.com> yjj
  * @link:
  ***********************************************************/

/**
 * Mysql_Table 
 * 
 * @uses Abstract
 * @uses _Table
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-05-12 15:34:57] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Mysql_Table extends Abstract_Table {

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
