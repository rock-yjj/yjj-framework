# yjj-framework – The Lightweight PHP MVC Framework for Freelancers

> **14 core files, no template engine, pure PHP views – fast to learn, faster to ship.**

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-brightgreen)]()
[![Code Size](https://img.shields.io/badge/size-<100KB-blue)]()

**yjj-framework** is a ultra‑lightweight MVC framework I built for one reason: **get projects done quickly without the bloat of Laravel or Symfony**.  
It’s perfect for small APIs, MVPs, admin panels, and any project where you want clean, understandable code that your client (or the next developer) can maintain without a 3‑day training course.

> 中文简介：yjj-framework 是一个超轻量级 PHP MVC 框架，核心仅 14 个文件。没有模板引擎，直接用 PHP 做视图（只允许循环和显示）。自带 MySQL 和 SqlServer 数据库类，支持 pathinfo 路由和类方法调用。代码注释详细，MIT 协议，专为快速交付和自由职业者设计。

---

## ✨ Features

- **Tiny core** – Only 14 files in `/yjj`, total size < 100KB.
- **MVC structure** – Clear separation: `Controllers`, `Models`, `Views`.
- **Simple routing** – Class‑method based, supports PATHINFO out of the box.
- **Database ready** – Built‑in MySQL and SQL Server (PDO) wrapper classes.
- **No template engine** – Use plain PHP in views (loops, `echo`, `if` only). Keeps learning cost zero and performance high.
- **One‑click scaffold** – Generate static files and directory structure with a single command.
- **Fully commented** – Every core file has detailed comments in English/Chinese.
- **MIT licensed** – Free for personal and commercial projects.

---

## 📋 Requirements

- PHP 7.4 or higher (8.x recommended)
- PDO extensions: `pdo_mysql` and/or `pdo_sqlsrv`
- Apache / Nginx with PATHINFO support (`.htaccess` included for Apache)

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/rock-yjj/yjj-framework.git
cd yjj-framework
2. Set up your web server
Point the document root to the public/ folder.

Apache: the included .htaccess already handles PATHINFO routing.
Nginx: add this to your server block:
location / {
    try_files $uri $uri/ /index.php?$args;
}
3. Configure database
Copy config/db/database.php to config/config.php and fill in your credentials:
// Choose driver: 'mysql' or 'sqlsrv'
<?php return array('default' => 
array( 'db'   => 'mysql', //driver
       'host' => '', //host
       'dbname' => '', 
       'user' => '', 
       'pwd'  => '', 
       'charset' => 'utf8'
));
 Quick Start
Routing (auto‑discovered)
Routes are mapped to controller classes and methods via URL.
Example: http://your-project.com/user/profile/123 will call UserController::profile(123).

No separate route file needed – but you can easily add your own router if desired.

Create a controller
Put this in lib/module/admin/UserController.php:
<?php
/**
 * Admin_Article 
 * 
 * @uses Abstract
 * @uses _Admin_Controller
 * @package 
 * @version $id$
 * @copyright 2007-2012 yjj
 * @author  BY YJJ <yjj1112@gmail.com>. ADD TIME:[2012-06-05 10:26:38] 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Admin_Article extends Abstract_Admin_Controller {
   
    /**
     * __construct
     *
     *
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->_view['title'] = '文章列表';
        
        if (!empty($_SESSION['flashmessage'])) {
            $this->_view['flashmessage'] = $_SESSION['flashmessage'];
            unset($_SESSION['flashmessage']);
        }
    }
    
    public function acIndex() {
    }

    /**
     * acList 文章列表页控制器
     *
     *
     * @access public
     * @return void
     */
    public function acList() {
        $page  = $this->_context->get('page', 1);
        $param = array();
        $type  = array();
        
        $keywords = '';
        if ($keywords = $this->_context->get('article_title')) {
            $param['article_title'] = $keywords;
        }

        if ($type_sn = $this->_context->get('type_sn')) {
            $type[] = $type_sn;
        }
        $type_list = Model_Type::getCurrentTypeNoStyles('9f709ef3-a790-4cdc-80cb-8b1c32ee996c');
        if (empty($type)) {
            $type = array_keys($type_list);
        }

        $count = Model_Article::count($keywords, $type);
        $rs = Model_Article::findAll($keywords, $type, $page, $this->_page_size);
        $this->_view['article'] = $rs;
        $this->_view['types'] = $type_list;
        $this->_view['users'] = Model_Passport::getAll();
        if (empty($rs)) {
            $this->_view['pagination'] = '';
        } else {
            $this->_view['pagination'] = $this->_pagination($count, $page, array_merge(array('module' => 'admin', 'controller' => 'article', 'action' => 'list'), $param));
        }
    }

    /**
     * acAdd 添加文章
     *
     *
     * @access public
     * @return void
     */
    public function acAdd() {
        $this->_view['title'] = '添加文章';
        $this->_view['article_type'] = Model_Type::getCurrentType('9f709ef3-a790-4cdc-80cb-8b1c32ee996c');
        $this->_view['passport'] = Model_Passport::getAll();
        if ($post = $this->_context->post()) {

            $article_info = array(
                'title'           => $post['title'],
                'source'          => $post['source'],
                'content'         => $_POST['content'],
                'type_sn'         => $post['article_type_sn'],
                'introduction'    => $post['article_info'],
                'passport_sn'     => $post['passport_sn'],
                'keywords'        => $post['article_key'],
                'click'           => (int) $post['click'],
                'rank'            => (int) $post['rank'],
                'recommend'       => (int) $post['recommend']
            );
            $article = new Model_Article();
            $rs = $article->insertAll($article_info);
            if (false === $rs) {
                $_SESSION['flashmessage'] = '添加失败!';
                $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'add'));
            }
            if (!empty($_FILES['upload']['name'])) {
                $current = $article->getOne();
                $this->_uploadFile($current['sn']);
            }

            $_SESSION['flashmessage'] = '添加成功!';
            $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'add'));
        }
    }

    /**
     * acUpdate 修改文章
     *
     * @access public
     * @return void
     */
    public function acUpdate() {
        $this->_view['title'] = '修改文章';
        if (!($sn = $this->_context->get('sn'))) {
            $_SESSION['flashmessage'] = '编号不正确!';
            $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'list'));
        }
        $this->_view['passport']     = Model_Passport::getAll();
        $this->_view['article_sn']   = $sn;
        $articles = new Model_Article($this->_view['article_sn']);
        $article  = $articles->getOne();
        $this->_view['article_type'] = Model_Type::getCurrentType('9f709ef3-a790-4cdc-80cb-8b1c32ee996c');
        $this->_view['article']      = $article;
        if ($post = $this->_context->post()) {
            if (!empty($_FILES['upload']['name'])) {
                $this->_uploadFile($sn);
            }

            $article_info = array(
                'title'           => $post['title'],
                'source'          => $post['source'],
                'content'         => $_POST['content'],
                'type_sn'         => $post['article_type_sn'],
                'introduction'    => $post['article_info'],
                'passport_sn'     => $post['passport_sn'],
                'keywords'        => $post['article_key'],
                'click'           => (int) $post['click'],
                'rank'            => (int) $post['rank'],
                'recommend'       => (int) $post['recommend']
            );
            $rs = $articles->updateAll($article_info);
            if (false === $rs) {
                $_SESSION['flashmessage'] = '修改成功!';
                $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'update', 'sn' => $sn));
            }
            $_SESSION['flashmessage'] = '修改成功!';
            $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'update', 'sn' => $sn));
        }
    }
    
    /**
     * acDel 删除文章
     *
     *
     * @access public
     * @return void
     */
    public function acDel() {
        $this->_view['title'] = '删除文章';
        if ($sn = $this->_context->get('sn')) {
            $article = new Model_Article($sn);
            $rs = $article->del();
            if (false === $rs) {
                $_SESSION['flashmessage'] = '删除失败!';
                $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'list'));
            }
            $_SESSION['flashmessage'] = '删除成功!';
            $this->_context->redirect('', array('module' => 'admin', 'controller' => 'article', 'action' => 'list'));
        }
    }

    /**
     * acUpload CKEDITOR上传图片
     *
     *
     * @access public
     * @return void
     */
    public function acUpload() {
        $file = $_FILES['upload'];
        $fn = $_GET['CKEditorFuncNum'];
        $dir  = ROOT_DIR . '/public/upload';
        $savename = uuid();
        $dir = uploadFile($file, $dir, $savename);
        $message = '上传失败!';
        if ($dir) {
            $message = '上传成功!';
        }
        echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$fn.', \'/upload/'.$dir.'\', \''.$message.'\');</script>';
    }

    protected function _uploadFile($sn, $file_destination = 'article') {
        $file = $_FILES['upload'];
        $dir  = ROOT_DIR . '/public/upload';
        $savename = $sn;
        return uploadFile($file, $dir, $savename, $file_destination);
    }
}
