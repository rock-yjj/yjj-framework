<?php

/**
 * Model_Admin_Place 
 * 
 * @uses Abstract
 * @uses _Mitul_Model
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author YJJ <yjj1112@gmail.com>. ADD TIME:2012-11-11 10:22:11 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Model_Admin_Place extends Abstract_Mitul_Model {
    
    /**
     * _province 
     * 
     * @var array
     * @access protected
     */
    protected $_province = array();
    
    /**
     * _city 
     * 
     * @var array
     * @access protected
     */
    protected $_city = array();

    /**
     * _district 
     * 
     * @var array
     * @access protected
     */
    protected $_district = array();
    
    /**
     * __construct 构造函数
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->_province = $this->_db()->select()->from('province')->fetchAssoc('sn');
        $this->_city     = $this->_db()->select()->from('city')->fetchAssoc('sn');
        $this->_district = $this->_db()->select()->from('district')->fetchAssoc('sn');
    }

    /**
     * getProvince 获取省份
     * 
     * @access public
     * @return void
     */
    public function getProvince() {
        return $this->_province;
    }

    /**
     * getCity 获取市
     * 
     * @access public
     * @return void
     */
    public function getCity() {
        return $this->_city;
    }

    /**
     * getDistrict 获取地区
     * 
     * @access public
     * @return void
     */
    public function getDistrict() {
        return $this->_district;
    }

    /**
     * getProvinceCity 获取省连动市
     * 
     * @access public
     * @return void
     */
    public function getProvinceCity() {
        static $citys = array();
        if (empty($citys)) {
            foreach ($this->_province as $k => $v) {
                $citys[$k] = array();
                foreach ($this->_city as $cv) {
                    if ($cv['parent_sn'] == $k) {
                        $citys[$k][$cv['sn']] = $cv['name'];
                    }
                }
            }
        }
        return $citys;
    }

    /**
     * getCityDistrict 获取市/县连动
     * 
     * @access public
     * @return void
     */
    public function getCityDistrict() {
        static $districts = array();
        if (empty($districts)) {
            foreach ($this->_city as $ct) {
                $districts[$ct['sn']] = array();
                foreach ($this->_district as $dt) {
                    if ($ct['sn'] == $dt['parent_sn']) {
                        $districts[$ct['sn']][$dt['sn']] = $dt['name'];
                    }
                }
            }
        }
        return $districts;
    }
}
