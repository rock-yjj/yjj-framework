<?php
/**
 * Abstract_Select
 * 抽象出 SQL SELECT 查询 封装公用方法
 * @abstract
 * @package
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-05-12 14:47:02]
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Select {

    /**
     * 当前数据库连接实例
     * @var db_resurce
     */

    protected $_db = null;

    /**
     * SQL 语句
     * @var string
     */
    protected $_sql   = 'SELECT';

    /**
     * 所要查询的字段
     * @var string
     */
    protected $_filed = '*';

    /**
     * 所要查询的表
     * @var string
     */
    protected $_select_str  = '';

    /**
     * 查询条件 WHERE 子句
     * @var string
     */
    protected $_where = '';

    /**
     * LIMIT 子句
     * @var string
     */
    protected $_limit = '';

    /**
     * ORDER 子句
     * @var string
     */
    protected $_order = '';

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
     * @param array $filed //需要查询的字段
     * @return void
     */
    public function __construct($db_object = null) {
        if (!empty($db_object)) {
            $this->_db = $db_object;
        }
    }

    /**
     * SQL FROM 语句 支持多表查询
     *
     * EXAMPLE:
     * [CODE]
     * $db->select()->from(
     *     array('alias' => table1, //数组的KEY为表的别名
     *           'alias1' => table2,
     *           ... ...
     *     ),
     *     array('alias' => fileds,
     *           'alias1' => fileds1
     *           ... ...
     *     )
     * )->query();
     * [/CODE]
     * [CODE1]
     * $db->select()->from(
     *     array(table1,
     *           table2,
     *           ... ...
     *     ),
     *     array('feild',
     *           'feild1',
     *           ... ...
     *     )
     * )->query();
     * [/CODE]
     * [CODE1]
     * $db->select()->from(
     *     'table1,
     *           table2,
     *           ... ...
     *     ',
     *     'feild,
     *           feild1,
     *           ... ...'
     *     )
     * )->query();
     * [/CODE]
     *
     * @param string|array $tablename //表名
     * @param array|string $fileds    //字段
     * @return Object_Select
     */
    public function from($tablename = null, $fileds = null) {
        if ($tablename === null) throw new Db_Select_Exception('This DB tablename is null');

        //支持多表联合查询
        if (is_array($tablename)) {
            $ar_table_name = array();
            foreach ($tablename as $k => $v) {
                if (is_int($k)) {
                    $ar_table_name[] = sprintf($this->_escape_left . '%s' . $this->_escape_right, $v);
                } else {
                    $ar_table_name[] = sprintf($this->_escape_left . '%s' . $this->_escape_right . ' AS ' . $this->_escape_left . '%s' . $this->_escape_right, $v, $k);
                }
            }
            $this->_select_str = sprintf('FROM %s', implode(',', $ar_table_name));
        } else {
            $this->_select_str = sprintf('FROM ' . $this->_escape_left . '%s' . $this->_escape_right, $tablename);
        }

        //支持自定义多字段查询
        if (!empty($fileds)) {
            if (is_array($fileds)) {
                $ar_fileds_name = array();
                foreach ($fileds as $k => $v) {
                    if (is_int($k)) {
                        $ar_fileds_name[] = sprintf($this->_escape_left . '%s' . $this->_escape_right, $v);
                    } else {
                        $ar_fileds_name[] = sprintf($this->_escape_left . '%s' . $this->_escape_right . ' AS ' . $this->_escape_left . '%s' . $this->_escape_right, $v, $k);
                    }
                }
                $this->_filed = implode(',', $ar_fileds_name);
            } else {
                $this->_filed = $fileds;
            }
        }
        return $this;
    }

    /**
     * join 联接查询语句
     *
     * EXAMPLE:
     * [CODE1]
     * $db->select()->from(
     *      array('alias1' => 'table1')
     * )->join(
     *      array(
     *          'alias2' => 'table2',
     *          'alias3' => 'table3')
     *          )
     * ).... // SELECT ... FROM `table1` AS alias1 LEFT JOIN (`table2` AS alias2, `table3` AS alias3) ....
     * [/CODE1]
     *
     * [CODE2]
     * $db->select()->from(
     *      array('alias1' => 'table1')
     * )->join(
     *          '(`table2` AS alias2, `table3` AS alias3)'
     *    )
     * ).... // SELECT ... FROM `table1` AS alias1 LEFT JOIN (`table2` AS alias2, `table3` AS alias3) ....
     * [/CODE2]
     *
     * @param array|srting $tablename //表名
     * @param string $oper //动作
     * @access public
     * @return current_object
     */
    public function join($tablename, $oper = 'LEFT') {
        if ($tablename === null) throw new Db_Select_Exception('This DB tablename is null');
        if (empty($this->_select_str)) throw new Db_Select_Exception('This SQL FROM tablename is null');

        $join = array();
        if (is_array($tablename)) {
            foreach ($tablename as $k => $v) {
                $join[] = sprintf($this->_escape_left . '%s' . $this->_escape_right . ' AS ' . $this->_escape_left . '%s' . $this->_escape_right, $v, $k);
            }
            $this->_select_str .= ' ' . $oper . ' JOIN (' . implode(',', $join) . ')';
        } else {
            $this->_select_str .= ' ' . $oper . ' JOIN ' .$tablename;
        }
        return $this;
    }

    /**
     * left 外左联接查询
     *
     * @param mixed $tablename
     * @access public
     * @return void
     */
    public function left($tablename = null) {
        return $this->join($tablename);
    }

    /**
     * right 外右联接查询
     *
     * @param mixed $tablename
     * @access public
     * @return void
     */
    public function right($tablename = null) {
        return $this->join($tablename, 'RIGHT');
    }

    /**
     * inner 内联接查询
     *
     * @param mixed $tablename
     * @access public
     * @return void
     */
    public function inner($tablename = null) {
        return $this->join($tablename, 'INNER');
    }

    /**
     * on 联结查询的条件语句
     *
     * EXAMPLE:
     * [CODE1]
     * ...->on(
     *  array('alias1' => 'fields1', 'alias2' => 'fields2')
     * ) // ... ON (`alias1`.fields1 = `alias2`.fields2)
     * [/CODE1]
     * [CODE2]
     * ...->on(
     *  array('`alias1`.fields1 = `alias2`.fields2')
     * ) // ... ON (`alias1`.fields1 = `alias2`.fields2)
     * [/CODE2]
     *
     * @param mixed $on
     * @access public
     * @return void
     */
    public function on($on = null) {
        if (empty($on)) throw new Db_Select_Exception('This SQL [ON] is null');
        if (empty($this->_select_str)) throw new Db_Select_Exception('This SQL FROM tablename is null');
        if (is_array($on)) {
            $on_array = array();
            foreach ($on as $k => $v) {
                $on_array[] = sprintf($this->_escape_left . '%s' . $this->_escape_right . '.' . $this->_escape_left . '%s' . $this->_escape_right, $k, $v);
            }
            $this->_select_str .= ' ' . implode(' = ', $on_array);
        } else {
            $this->_select_str .= ' ' . $on;
        }
        return $this;
    }

    /**
     * 封装 条件 子句
     * [CODE]
     * $db->select()->from('table1')->where(
     *      array(
     *          'field' => condition,
     *          'field1' => condition,
     *          'field2' => condition
     *      )
     * )->query();
     * [/CODE]
     *
     * [CODE1]
     * $db->select()->from('table1')->where(
     *      'a > b and c < d'
     * )->query();
     * [/CODE1]
     *
     * @param array|string $where
     * @return Object_Select
     */
    public function where($where = null) {
        if (!empty($where)) {
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
        }
        return $this;
    }

    /**
     * 封装LIMIT子句
     * @param int $start
     * @param int $end
     * @return Object_Select
     */
    abstract public function limit($start = 0, $end = 30);

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

    /**
     * 封装 SQL COUNT()
     *
     * @param string $filed
     * @return Object_Select
     */
    public function count($filed = '*', $row = 'row_result') {
        if ('*' === $filed) {
            $this->_filed = sprintf('COUNT(%s) AS %s', $filed, $row);
        } else {
            $this->_filed = sprintf('COUNT(' . $this->_escape_left . '%s' . $this->_escape_right . ') AS %s', $filed, $row);
        }
        return $this;
    }

    /**
     * 封装 SQL SUM()
     *
     * @param string $filed
     * @return Object_Select
     */
    public function sum($filed = null, $row = 'sum_result') {
        if (!empty($filed)) {
            $this->_filed = sprintf('SUM(' . $this->_escape_left . '%s' . $this->_escape_right . ') AS ' . $this->_escape_left . '%s' . $this->_escape_right, $filed, $row);
        }
        return $this;
    }

    /**
     * 构造SQL 语句
     */
    protected function _setSqlString() {
        $sql_array = array();
        $sql_array[] = $this->_filed;
        if (!empty($this->_select_str)) {
            $sql_array[] = $this->_select_str;
        }
        if (!empty($this->_where)) {
            $sql_array[] = $this->_where;
        }
        if (!empty($this->_order)) {
            $sql_array[] = $this->_order;
        }
        if (!empty($this->_limit)) {
            $sql_array[] = $this->_limit;
        }
        $this->_sql .= ' ' . implode(' ', $sql_array);
    }

    /**
     * 获得当前SQL语句
     * @return string
     */
    public function __toString() {
        $this->_setSqlString();
        return $this->_sql;
    }

    /**
     * 返回查询结果
     * @return array
     */
    public function query() {
        $this->_setSqlString();
        return $this->_db->execute($this->_sql);
    }

    /**
     * 重新聚合 查询结果
     * @param string $fileds
     * @return array
     */
    public function fetchAssoc($fileds = null) {
        $result = array();
        $rs = $this->query();
        foreach($rs as $v) {
            if (null === $fileds) {
                if (isset($v['id'])) {
                    $fileds = 'id';
                }
            }
            $result[$v[$fileds]] = $v;
        }
        return $result;
    }
}

abstract class Db_Abstract_Select_Exception extends Exception {
    public function __construct($info) {
        parent::__construct($info);
    }
}
