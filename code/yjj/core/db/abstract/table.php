<?php
/**
 * Abstract_Table 抽象出数据库表操作方法 
 * 
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-05-12 15:34:57] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Abstract_Table {
    /**
     * 需要操作的表名
     * @var string
     */
    protected $_tablename = null;

    /**
     * 数据库资源
     * @var db_resource
     */
    protected $_db = null;

    /**
     * SQL 语句
     * @var string
     */
    protected $_sql = '';

    /**
     * WHERE 子句
     * @var string
     */
    protected $_where = '';

    /**
     * _escape_left 转义符号，默认为MYSQL转义符号
     *
     * @var string
     * @access protected
     */
    protected $_escape_left  = '`';

    /**
     * _escape_right 转义符号，默认为MYSQL转义符号
     *
     * @var string
     * @access protected
     */
    protected $_escape_right = '`';

    /**
     * 构造函数
     * @param db_resource $db_object
     * @param string      $tablename
     */
    public function __construct($db_object, $tablename) {
        if (!empty($db_object)) {
            $this->_db = $db_object;
        } else {
            throw new Db_Table_Exception('数据库资源不存在!');
        }
        if (!empty($tablename)) {
            $this->_tablename = $tablename;
        } else {
            throw new Db_Table_Exception('没有指定表!');
        }
    }

    /**
     * 构造一个插入语句
     * [CODE]
     * $db->table('test1')->insert(
     *      array(
     *          'filed1' => value1,
     *          'filed2' => value2,
     *          ... ...  
     *      );
     * );
     * [/CODE]
     * @param array $fileds
     * @return mix
     */
    public function insert($fileds = array()) {
        if (empty($fileds)) return false;
        if (is_array($fileds)) {
            $this->_sql = sprintf('INSERT INTO ' . $this->_escape_left . '%s' . $this->_escape_right, $this->_tablename);
            $key = array();
            $value = array();
            foreach ($fileds as $k => $v) {
                $key[]   = sprintf($this->_escape_left . '%s' . $this->_escape_right, $k);
                $value[] = sprintf('\'%s\'', $v);
            }
            $this->_sql .= sprintf(' (%s)VALUES(%s)', implode(',', $key), implode(',', $value));
            writeLog($this->_sql);
            try {
                $this->_db->execute($this->_sql);
                return $this->_db->lastInsertId();
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

    /**
     * 构造UPDATE 语句
     * [CODE]
     * $db->table('test1')->update(
     *      array(
     *          'fileds1' => filed1,
     *          'fileds2' => filed2,
     *          ... ...
     *      ),
     *      array(
     *          'fileds1' => condition1,
     *          'fileds2' => condition2,
     *          ... ...
     *      )
     * );
     * [/CODE]
     * [CODE]
     * $db->table('test1')->update(
     *      array(
     *          'fileds1' => filed1,
     *          'fileds2' => filed2,
     *          ... ...
     *      ),
     *          'fileds1 > condition1 or
     *          fileds2 < condition2 AND
     *          ... ...'
     * );
     * [/CODE]
     *
     * @param array|string $fileds
     * @param string|array $where
     * @return bool
     */
    public function update($fileds, $where = null) {
        if (empty($fileds)) return false;
        if (is_array($fileds)) {
            $this->_sql = sprintf('UPDATE ' . $this->_escape_left . '%s' . $this->_escape_right . ' SET ', $this->_tablename);
            $set = array();
            foreach ($fileds as $k => $v) {
                $set[] = sprintf($this->_escape_left . '%s' . $this->_escape_right . ' = \'%s\'', $k, $v);
            }
            $this->_sql .= implode(',', $set);
            $this->_sql .= ' ' . $this->_where($where);
            return $this->_db->execute($this->_sql);
        } else {
            $this->_sql = sprintf('UPDATE ' . $this->_escape_left . '%s' . $this->_escape_right . ' SET ', $this->_tablename);
            $this->_sql .= $fileds . ' ' . $this->_where($where);

            return $this->_db->execute($this->_sql);
        }
        return false;
    }

    /**
     * 构造删除语句
     * [CODE]
     * $db->table('test1')->delete(
     *      array(
     *          'fileds1' => conition1,
     *          'fileds2' => conition2,
     *          ... ... 
     *      ),
     *      array(
     *          'fileds1' => conition1,
     *          'fileds2' => conition2,
     *          ... ...
     *      )
     * );
     * [/CODE]
     * @param string|array $where
     * @return bool
     */
    public function delete($where = null) {
            $this->_sql = sprintf('DELETE FROM ' . $this->_escape_left . '%s' . $this->_escape_right, $this->_tablename);
            $this->_sql .= $this->_where($where);
            return $this->_db->execute($this->_sql);
    }

    /**
     * 构造WHERE 子句
     * @param string|array $where
     * @return string
     */
    protected function _where($where) {
        if (empty($where)) return;
        if (empty($this->_where)) $this->_where = 'WHERE ';
        if (is_array($where)) {
            $where_link = array();
            foreach ($where as $k => $v) {
                $where_link[] = sprintf($this->_escape_left . '%s' . $this->_escape_right . ' = \'%s\'', $k, $v);
            }
            $this->_where .= implode(' AND ', $where_link);
        } else {
            $this->_where .= $where;
        }
        return $this->_where;
    }
}

abstract class Db_Abstract_Table_Exception extends Exception {
    public function __construct($info) {
        parent::__construct($info);
    }
}
