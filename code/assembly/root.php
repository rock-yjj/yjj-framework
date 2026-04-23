<?php

/**
 * Root 
 * 
 * @package 
 * @version $id$
 * @copyright 2007-2014 yjj
 * @author YJJ <yjj1112@gmail.com> 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Root {

    /**
     * _type 类别
     * 
     * @var array
     * @access protected
     */
    protected $_root       = array();

    /**
     * _after_root 最终列表
     * 
     * @var array
     * @access protected
     */
    protected $_after_root = array();

    /**
     * _list_root 显示列表
     * 
     * @var array
     * @access protected
     */
    protected $_view_root  = array();

    /**
     * __construct 构造函数
     * 
     * @access public
     * @return void
     */
    public function __construct($root, $sn = '10000000-0000-0000-0000-00000000') {
        $this->_root = $root;
        $this->_setTypeList($sn);
        $this->_setLastRoot($sn);
    }

    /**
     * setTypeList 设置类别列表
     * 
     * @access protected
     * @return void
     */
    protected function _setTypeList($root_sn = '10000000-0000-0000-0000-00000000', $level = 1) {
        foreach ($this->_root as $k => $v) {
            if ($v['parent_sn'] == $root_sn) {
                $this->_after_root[$v['sn']] = $v;
                $this->_after_root[$v['sn']]['level'] = $level;
                $son_level = $level + 1;
                $this->_setTypeList($v['sn'], $son_level);
                unset($this->_root[$k]);
            }
        }
    }

    /**
     * getList 获取分类列表
     * 
     * @access public
     * @return void
     */
    public function getList() {
        return $this->_after_root;
    }

    /**
     * getRootList 获得类别列表
     * 
     * @access public
     * @return void
     */
    public function getRootList() {
        $tmp = array();
        $sgin = array();
        foreach ($this->_after_root as $k => $v) {
            $str = '';
            $sgin[$v['level']] = (bool) $v['last'];
            for ($i = 1; $i < (int) $v['level']; $i++) {
                $str .= $sgin[$i] ? '　　' : '︳　';
            }
            $tmp[$v['sn']] = $v;
            $tmp[$v['sn']]['name'] = $str . '﹂' . $v['name'];
        }
        return $tmp;
    }

    /**
     * _setLastRoot 设置分类标实
     * 
     * @param string $root_sn 
     * @access protected
     * @return void
     */
    protected function _setLastRoot($root_sn = '10000000-0000-0000-0000-00000000') {
        $tmp_sn = '';
        foreach ($this->_after_root as $k => $v) {
            if ($v['parent_sn'] == $root_sn) {
                $tmp_sn = $v['sn'];
                $this->_after_root[$k]['last'] = false;
                $this->_setLastRoot($v['sn']);
            }
        }
        if (!empty($this->_after_root[$tmp_sn])) {
            $this->_after_root[$tmp_sn]['last'] = true;
        }
    }
}
