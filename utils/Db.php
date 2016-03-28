<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-3-17
 * Time: 下午3:56
 */

/**
 *用单例模式封装数据库连接方法
 */
class Db {
    private static $_instance;
    private static $_connectSource;
    private $_dbConfig = array(
        'host' => '127.0.0.1' ,
        'user' => 'root' ,
        'password' => '' ,
        'database' => 'news' ,
    );

    private function __construct() {
    }

    static public function getInstance() {
        if(!(self ::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance ;
    }

    public function connect() {
        if(!self ::$_connectSource) {
            self::$_connectSource = @mysql_connect($this ->_dbConfig[ 'host'], $this ->_dbConfig[ 'user'], $this->_dbConfig ['password' ]);

            if(!self ::$_connectSource) {
                throw new Exception('mysql connect error ' . mysql_error());
                //die('mysql connect error' . mysql_error());
            }

            if(!@mysql_select_db($this->_dbConfig[ 'database'], self::$_connectSource )){
                throw new Exception('mysql connect error ' . mysql_error());
            }
            mysql_query( "set names 'utf8'", self::$_connectSource );
        }
        return self::$_connectSource ;
    }
}
