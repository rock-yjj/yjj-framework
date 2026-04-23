<?php

/**
 * Abstract_Default 
 * 
 * @uses Model
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2003-2010 The PHP Group
 * @author yjj <yjj1112@gmail.com> 
 * @license PHP Version 5.2 {@link http://www.php.net/license/5_2.txt}
 */
/**
 * Abstract_Default 
 * 
 * @uses Abstract
 * @uses _Controller
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author YJJ <yjj1112@gmail.com>. ADD TIME:2012-05-13 02:58:37 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Default_Controller extends Abstract_Module_Controller {

    protected $_current_channel = '';

    /**
     * __construct 
     * 
     * @access protected
     * @return void
     */
    protected function __construct() {
        parent::__construct();
    }
    
    /**
     * 在执行控制器之前执行
     */
    public function before_controller() {
        $this->_getFriendList();
        $this->_view['left_news'] = Model_Article::findAll(null, array('edb59af6-631d-4402-894c-f8971fdb9f76', '4b93fe9e-b986-419b-b89c-48c4889ad1a5'), 1, 8);
        $this->_view['left_product'] = Model_Article::getRecommendAll(null, array('f7fc1ab7-8266-4b79-a4ec-65014f10edfb', 'f7fc1ab7-8266-4b79-a4ec-65014f10edfb','93317fa2-8a1e-4999-bb32-2b6ee1806f63', '2d3b89f4-443e-45d1-a708-9b283949e119'), 1, 3);
    }

    /**
     * 在执行控制器之后执行
     */
    public function after_controller() {}

    
    public function getView() {
        return $this->_view;
    }

    public function getViewname() {
        return $this->_viewname;
    }

    protected function _db() {
        return Db_Pdo::getConn();
    }

    /**
     * _getSiteInfo 网站信息
     * 
     * @access protected
     * @return void
     */
    protected function _getSiteInfo() {
        $site = new Model_Site('f741e926-6c67-4861-89f2-9890eb9d6d83');
        $this->_view['site'] = $site->getOne();
        $this->_view['friend'] = Model_Friend::findAlls();
        $this->_view['channel'] = Model_Channel::getAll();
        $types = Model_Type::getAll();
        $type_assocc = array();
        foreach ($types AS $k => $v) {
            if (!isset($type_assocc[$v['parent_sn']])) $type_assocc[$v['parent_sn']] = array();
            $type_assocc[$v['parent_sn']][$v['sn']] = $v;
        }
        $this->_view['type_assocc'] = $type_assocc;
    }

    /**
     * _getArticleByType 根据类别获取文章
     *
     * @param mixed $type_sn
     * @param int $limit
     * @param int $title_len
     *
     * @access protected
     * @return void
     */
    /*
    protected function _getArticleByType($type_sn, $limit = 10, $title_len = 20) {
        $rs = $this->_db()->select()->from('article')->where(array('type_sn' => $type_sn))->order('create_time DESC')->limit(0, $limit)->query();
        $article_list = array();
        foreach ($rs as $k => $v) {
            $article_list[$k] = $v;
            $article_list[$k]['cut_title'] = mb_substr($v['title'], 0, $title_len, 'utf-8'); 
        }
        return $article_list;
    }*/

    /**
     * _getFriendList 获取友情连接列表
     *
     * @access protected
     * @return void
     */
    protected function _getFriendList() {
        $this->_view['friend'] = Model_Friend::findAlls();
    }
}
