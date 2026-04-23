<?php
/**
 * Abstract_Admin_Controller 
 * 
 * @uses Abstract
 * @uses _Module_Controller
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 10:26:38] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Abstract_Admin_Controller extends Abstract_Module_Controller {

    /**
     * _page_size 分页
     * 
     * @var float
     * @access protected
     */
    protected $_page_size = 20;

    /**
     * _module 模块
     * 
     * @var string
     * @access protected
     */
    protected $_module = 'Admin';

    /**
     * __construct
     *
     *
     * @access protected
     * @return void
     */
    protected function __construct() {
        parent::__construct();
    }

    /**
     * _auth 验证用户是否登陆
     *
     * @access protected
     * @return void
     */
    protected function _auth() {
        if (!empty($_SESSION['userinfo'])) {
            $controller = empty($_GET['controller']) ? 'index' : $_GET['controller'];
            $action     = empty($_GET['action']) ? 'index' : $_GET['action'];
            foreach ((array)$_SESSION['userauth'] AS $v) {
                if ($controller == $v['class_name'] && $action == $v['action_name']) {
                    $this->_view['current_module'] = $v['module_sn'];
                    return;
                }
            }
        }
        $this->_context->redirect('', array('controller' => 'login', 'action' => 'login'));exit;
    }

    /**
     * 在执行控制器之前执行
     */
    public function before_controller() {
        $this->_auth();//权限验证
    }

    /**
     * 在执行控制器之后执行
     */
    public function after_controller() {}

    /**
     * _pagination 分页
     *
     * @param mixed $listcount
     * @param mixed $currentpage
     * @param array $param
     *
     * @access protected
     * @return void
     **/
    protected function _pagination($listcount, $currentpage, $param = array()) {
        $pagecount = ceil($listcount / $this->_page_size);
        $current_url = WEB_URL . '/index.php?r=' . rand();
        foreach ($param as $k => $v) {
            $current_url .= '&' . $k . '=' . $v;
        }

        $first = $current_url . '&page=1';
        $pre_page  = ($currentpage - 1) < 1 ? 1 : $currentpage - 1;
        $pre   = $current_url . '&page=' . $pre_page;
        $next_page = ($currentpage + 1) > $pagecount ? $pagecount : $currentpage + 1;
        $next  = $current_url . '&page=' . $next_page;
        $last  = $current_url . '&page=' . $pagecount;

        $pagelist = array(1,2,3,4,5,6,7);

        if ($currentpage > $pagecount) $currentpage = $pagecount;
        if ($currentpage < 1) {
            $currentpage = 1;
            $pre = $currentpage - 1 > 1 ? $current_url . '&page=' . $currentpage - 1 : '#';
        }

        if ($pagecount < 7) {
            $pagelist = array();
            for ($i = 1; $i < $pagecount + 1; $i++) $pagelist[] = $i;
        }

        if ($pagecount > 7 && $currentpage > 4) {
            $pagelist = array();
            if ($currentpage + 3 > $pagecount) {
                for ($i = $pagecount - 6; $i < $pagecount + 1; $i++) {
                    $pagelist[] = $i;
                }
            } else {
                $page_count_length = $currentpage + 4;
                for ($i = $page_count_length - 7; $i < $page_count_length; $i++) {
                    $pagelist[] = $i;
                }
            }
        }

        $html = <<< EOF
<div class="pagination">           
    <a href="{$first}" class="button" id="first_page"><span>首页 <img width="12" height="9" src="/admin/images/arrow-stop-180-small.gif" title="首页"></span></a> 
    <a href="{$pre}" class="button" id="pre_page"><span>上页 <img width="12" height="9" src="/admin/images/arrow-180-small.gif" title="上一页"></span></a>
    <div class="numbers">
        <span>Page:</span> 
EOF;

        foreach ($pagelist as $k => $v) $html .= ($v == $currentpage) ? sprintf('%d<span>|</span>', $v) : sprintf('<a href="%s">%d</a><span>|</span>', $current_url . '&page=' . $v, $v);

        $html .= <<< EOF
        <span>...</span> 
        <span>|</span> 
        <a href="{$current_url}&page={$pagecount}">{$pagecount}</a>
    </div> 
    <a href="{$next}" class="button" id="next_page"><span>下页 <img width="12" height="9" src="/admin/images/arrow-000-small.gif" title="下页"></span></a> 
    <a href="{$last}" class="button last" id="last_page"><span>末页 <img width="12" height="9" src="/admin/images/arrow-stop-000-small.gif" title="莫页"></span></a>
    <div style="clear: both;"></div> 
</div>
EOF;
        return $html;
    }

    public function getView() {
        return $this->_view;
    }

    public function getViewname() {
        return $this->_viewname;
    }

    protected function _db() {
        return Db_Pdo::getConn();
    }
}
