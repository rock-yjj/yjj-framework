<?php
 /************************************************************ 
  * 封装一个PDO的类
  *
  * @filename: Pdo.Class.php 2010-03-23 11:14
  * @copyright: Copyright by 2010 - 2020
  * @author: <yjj1112@gmail.com> yjj
  * @link:
  ***********************************************************/

/**
 * Db_Pdo 
 * 
 * @uses PDO
 * @package 
 * @version $id$
 * @copyright 2007-2011 yjj
 * @author YJJ <yjj1112@gmail.com> 
 * @license PHP Version 5.2.6 {@link http://www.php.net/}
 */
class Db_Pdo extends PDO {

    /**
     * 数据库类型
     * @var string 
     */
    public static $db_type = '';

    /**
     * 一个PDO数据库连接实例
     * @var resource
     */
    public static $db = array();

    /**
     * 构造函数
     * @param string $linkid     指定要连接的数据库实例
     * @param string $dbh_string PDO 服务器信息字符串
     * @param string $user       数据库用户名
     * @param string $password   数据库用户密码
     */
    public function __construct($linkid, $dbh_string = null, $user = null, $password = null) {
        if (null === $dbh_string || null === $user || null === $password) {
            static $dbinfo = null;
            if (null === $dbinfo) {
                $dbinfo = require(ROOT_DIR . '/config/db/database.php');
            }
            if (empty($linkid)) {
                $linkid = 'default';
            }

            if (!empty($dbinfo)) {
                $db_info = $dbinfo[$linkid]; 
            } else {
                throw new Pdo_Db_Exception('没有找到数据库配置信息!');
            }

            if (empty($db_info['db']))     throw new Pdo_Db_Exception('没有指定数据库类型!');
            if (empty($db_info['dbname'])) throw new Pdo_Db_Exception('没有指定数据库名!');
            if (empty($db_info['user']))   throw new Pdo_Db_Exception('没有指定用户名!');
            if (empty($db_info['pwd']))    throw new Pdo_Db_Exception('没有指定密码!');
            if (empty($db_info['host']))   throw new Pdo_Db_Exception('没有指定数据库服务器!');
            self::$db_type = $db_info['db'];
            $charset = empty($db_info['charset']) ? 'gb2312' : $db_info['charset'];
            $dbname = empty($db_info['fix']) ? $db_info['dbname'] : sprintf('%s_%s', $db_info['fix'], $db_info['dbname']);
            $dbh_string = sprintf($db_info['db'] . ':host=%s;dbname=%s', $db_info['host'], $dbname);
            $user = $db_info['user'];
            $password = $db_info['pwd'];
        }
        parent::__construct($dbh_string, $user, $password);
        if ('mysql' === self::$db_type) {
            $this->execute('set names ' . $charset); //设置字符集编码
        }
    }

    /**
     * 获得数据库资源 如果连接没有建立则新创建一个
     * @param string $linkid
     * @return Object_Db_Pdo
     */
    public static function getConn($linkid = 'default') {
        if (empty(self::$db[$linkid])) {
            $pdo_handle = new self($linkid);
            self::$db[$linkid] = $pdo_handle;
        }
        return self::$db[$linkid];
    }

    /**
     * 实例化一个DB_SELECT_OBJECT 封装各种查寻
     * @return Select_Object
     */
    public function select() {
        $select = firstToBig(self::$db_type) . '_Select';
        return new $select($this);
    }

    /**
     * 实例化一组操作 插入 删除 修改
     * @param string $tablename 表名
     * @return Table_Object
     */
    public function table($tablename) {
        $table = firstToBig(self::$db_type) . '_Table';
        return new $table($this, $tablename);
    }
    
    /**
     * 执行SQL语句
     * @param string $sql SQL语句
     * @return mix
     */
    public function execute($sql = null) {
            writeLog($sql);
        $sql_str = strtolower(substr(trim($sql), 0, 4));
        if ($sql_str === 'sele') {
            $pdostam = $this->query($sql);
            $error = $this->errorInfo();
            $this->_error($error, $sql);
            $rs = $pdostam->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $rs = $this->exec($sql);
            $error = $this->errorInfo();
            $this->_error($error, $sql);
        }
        return $rs;
    }

    protected function _error($error, $sql) {
        if (empty($error[2])) {
            return false;
        } else {
            //如果有异常信息 则抛出异常
            throw new Pdo_Db_Exception(sprintf('SQL:%s Error Code:%s CODE:%d Error:%s', $sql, $error[0], $error[1], $error[2]));
            //$this->_log(sprintf('SQL:%s Error Code:%s CODE:%d Error:%s', $sql, $error[0], $error[1], $error[2]));
        }
    }

    /**
     * 启动一个事务
     */
    public function startTrans() {
        $this->beginTransaction();
    }

    /**
     * 结束一个事务
     */
    public function complete($rs = true) {
        return ($rs) ? $this->commit() : $this->rollBack();
    }
}

/**
 * 数据库异常类
 */
class Pdo_Db_Exception extends Exception {
    public function __construct($ex) {
        parent::__construct($ex);
    }
}
