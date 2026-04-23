<?php
/**
 * Abstract_Mitul_Model 公用模式类 
 * 
 * @uses Abstract
 * @uses _Model
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 12:01:37] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Mitul_Model extends Abstract_Model{

    /**
     * _pk 主键
     * 
     * @var string
     * @access private
     */
    private $_pk = '';

    /**
     * _pop 元素对列
     * 
     * @var array
     * @access protected
     */
    private $_pop = array();

    /**
     * _table_name 元素表名
     * 
     * @var string
     * @access private
     */
    private $_table_name = '';

    /**
     * __construct 构造函数 
     * 
     * @access protected
     * @return void
     */
    protected function __construct($sn, $object_name) {
        $this->_pk = empty($sn) ? uuid() : $sn;
        $this->_pop['sn'] = $this->_pk;
        $object = strtolower(str_replace('Model_', '', $object_name));
        if (empty($object)) throw new Model_Exception('MODEL OBJECT NAME IS ERROR!');
        $this->_table_name = $object;
        $rs = self::_find($this->_table_name)->where(array('sn' => $this->_pk))->query();
        if (false === $rs) throw new Model_Exception('FIND ONE IS FASLE!');
        if (!empty($rs[0])) $this->_pop = $rs[0]; 
        parent::__construct();
    }

    public function __get($k) {
        return empty($this->_pop[$k]) ? NULL : $this->_pop[$k];
    }

    public function __set($k, $v) {
        $this->_pop[$k] = $v;
    }

    public function add() {
        self::_db()->startTrans();
        $rs = self::_meta($this->_table_name)->insert($this->_pop);
        if (false === $rs) {
            self::_db()->complete(false);
            throw new Model_Exception('ADD IS FAIL!');
        }
        $seed = self::_meta('seed')->insert(array('sn' => $this->_pk));
        if (false === $seed) {
            self::_db()->complete(false);
            throw new Model_Exception('SEED ADD IS FAIL!');
        }
        self::_db()->complete(true);
        return true;
    }

    public function update() {
        return self::_meta($this->_table_name)->update($this->_pop, array('sn' => $this->_pk));
    }

    public function del() {
        self::_db()->startTrans();
        $rs = self::_meta($this->_table_name)->delete(array('sn' => $this->_pk));
        if (false === $rs) {
            self::_db()->complete(false);
            throw new Model_Exception('DEL IS FAIL!');
        }
        $del = self::_meta('seed')->delete(array('sn' => $this->_pk));
        if (false === $rs) {
            self::_db()->complete(false);
            throw new Model_Exception('DEL SEED IS FAIL!');
        }
        self::_db()->complete(true);
        return true;
    }

    public function getOne() {
        return $this->_pop;
    }
}
