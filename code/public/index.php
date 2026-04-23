<?php
/**********************************
 * 入口文件
 **********************************/
define('ROOT_DIR', dirname(dirname(__FILE__)));
include ROOT_DIR . '/config/config.php';
//error_reporting(E_ALL | E_WARNING | E_PARSE | E_NOTICE);
try {
    Core::handle()->execute();
} catch (Exception $e) {
    echo $e->getMessage();
}
