<?php
 /*********************************************** 
  * 公用配置文件,允许用户自定义配置
  *
  * filename: config.php 2012-06-05 11:32
  * auther: 脚印 <yjj1112@gmail.com>
  ***********************************************/
include_once(ROOT_DIR . '/config/global.php');                    //常用函数
include_once(ROOT_DIR . '/config/function.php');                  //常用函数
include_once(ROOT_DIR . '/assembly/captcha.php');                 //构造验证码

include_once(ROOT_DIR . '/yjj/core.php');                         //核心文件

//模块抽象类可以根据需要定义
include_once(ROOT_DIR . '/lib/module/abstract.php');                  //模块控制器基类
include_once(ROOT_DIR . '/lib/module/default/abstract_default.php');  //默认模块控制器抽象类
include_once(ROOT_DIR . '/lib/module/admin/abstract_admin.php');      //管理模块控制器抽象类
include_once(ROOT_DIR . '/lib/module/install/abstract_install.php');  //管理模块控制器抽象类

include_once(ROOT_DIR . '/lib/model/abstract.php');                   //模块模式基类
include_once(ROOT_DIR . '/assembly/root.php');                   //模块模式基类
