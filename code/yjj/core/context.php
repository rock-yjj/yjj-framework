<?php
/**
 * context 
 * 
 * @package 
 * @version $id$
 * @copyright 2007-2011 yjj
 * @author YJJ <yjj1112@gmail.com> 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Context {

    protected $_action = 'index';

    public function __construct() {
    }
    
    /**
     * get 封装了$_GET 对GET参数进行验证
     *
     * @param mixed $var
     * @param mixed $default
     * @param mixed $check 是否要对参数进行过滤 默认需要过滤
     *
     * @access protected
     * @return void
     */
    public function get($var = null, $default = null, $check = true) {
        static $get = array();
        return $this->_createParam($_GET, $var, $default, $check, $get);
    }

    /**
     * post 封装了对 $_POST参数进行验证
     * 
     * @param mixed $var 
     * @param mixed $default 
     * @param mixed $check 
     * @access public
     * @return void
     */
    public function post($var = null, $default = null, $check = true) {
        static $post = array();
        return $this->_createParam($_POST, $var, $default, $check, $post);
    }

    /**
     * _createParam 构造参数
     * 
     * @param mixed $param 
     * @param mixed $var 
     * @param mixed $default 
     * @param mixed $check 
     * @access protected
     * @return void
     */
    protected function _createParam($param, $var = null, $default = null, $check = true, &$v) {
        if (empty($v)) {
            if (isset($param['module'])) {
                unset($param['module']);
            }

            if (isset($param['controller'])) {
                unset($param['controller']);
            }

            if (isset($param['action'])) {
                unset($param['action']);
            }

            if (isset($param)) {
                $v = $param;
                array_walk_recursive($v, 'escape');
            } 
        }
        
        if (!empty($var)) {
            if (!empty($default)) {
                if (empty($v[$var])) {
                    $v[$var] = $default;
                }
            }

            return isset($v[$var]) ? (($check == true) ? $v[$var] : (empty($v[$var]) ? $default : $v[$var])) : '';
        }

        return $v;
    }
    
    /**
     * 页面跳转方法
     * @param string $url
     * @param array  $var
     * @return void
     */
    public function redirect($url = '', $var = array(), $delay = 0) {
        $url = $this->url($url, $var);
        echo <<< EOF
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="{$delay}; url={$url}" />
</head>
</html>
EOF;
exit;
    }

    /**
     * 构造URL
     * @param string $url
     * @param array  $var
     * @return string $url
     */
    public function url($url = '', $var = array()) {
        global $is_create_static;
        if ($is_create_static) {
            if (!empty($var['sn']) && empty($var['page'])) {
                $seed = new Model_Seed($var['sn']);
                $seed_info = $seed->getOne();
                return WEB_URL . '/html/' . $var['controller'] . '/' . (int) $seed_info['id'] . '.html';
            }
            
            if (empty($var['sn']) && !empty($var['page'])) {
                return WEB_URL . '/html/' . $var['controller'] . '/page/' . (int) $var['page'] . '.html';
            }

            if (!empty($var['sn']) && !empty($var['page'])) {
                $seed = new Model_Seed($var['sn']);
                $seed_info = $seed->getOne();
                return WEB_URL . '/html/' . $var['controller'] . '/page/' . (int) $seed_info['id'] . '/' . (int) $var['page'] . '.html';
            }
            if (empty($var['sn']) && empty($var['page'])) {
                return WEB_URL . '/html/' . $var['controller'] . '/index.html';
            }
        }

        if (empty($url)) {
            $url = WEB_URL . '/index.php';
        }
        $pm = array();
        $pm['module'] = empty($var['module']) ? 'default' : $var['module'];
        $pm['controller'] = empty($var['controller']) ? 'Index' : $var['controller'];
        $pm['action'] = empty($var['action']) ? $this->_action : $var['action'];
        $vars = array_merge($pm, $var);
        $url .= strpos($url, '?') ? '&' : '?';
        $param = array();
        foreach ($vars as $k => $v) {
            $param[] = sprintf('%s=%s', $k, $v);
        }
        $url .= implode('&', $param);
        return $url;
    }

    /**
     * 构造验证码
     */
    public function setCapt($session_word = 'captcha_word') {
        $with   = $this->get('w', '80'); 
        $height = $this->get('h', '20');
        $img = new Captcha(ROOT_DIR . '/public/default/images/capt/', $with, $height);
        $img->session_word = $session_word;    //验证码的SESSION键值
        @ob_end_clean();
        $img->generate_image(); 
    }

    public function js_redirect($url = '', $var = array()) {
        $url = $this->url($url, $var);
        echo <<< EOF
<script type="text/javascript">
//<![CADTA
    window.location = '{$url}';
//]]>
</script>
EOF;
exit;
    }

    /**
     * imageIsExist判断图片是否存在并返回图片名
     * 
     * @param mixed $dir 
     * @param mixed $name 
     * @return void
     */
    public function imageIsExist($dir, $name) {
        $ext = array('png', 'bmp', 'jpg', 'gif', 'jpeg');
        foreach ($ext as $v) {
            if (file_exists($dir . '/' . $name . '.' . $v)) {
                return $name . '.' . $v;
            }
        }
        return false;
    }
}

class Context_Exception extends Exception {
    public function __construct($info) {
        parent::__construct($info);
    }
}
