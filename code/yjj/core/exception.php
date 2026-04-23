<?php
/**
 * Core_Exception 核心异常类
 * 
 * @uses Exception
 * @package 
 * @version $id$
 * @copyright 2007-2014 yjj
 * @author YJJ <yjj1112@gmail.com> 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
abstract class Core_Exception extends Exception {
    public function __construct() {
        parent::__construct();
    }
}
