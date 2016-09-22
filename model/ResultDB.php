<?php
require_once __DIR__.'/ResultDBMySQL.php';
require_once __DIR__.'/ResultDBSQLite.php';

/**
 * Description of DBResult
 *
 * @author ragno
 */
abstract class ResultDB {
    protected $res;
    function __construct($res) {
        $this->res = $res;
    }

    abstract function fetch_assoc();
    abstract function reset();
    
  static function factory($res=null){
      if ($res===null || $res===true || $res===false){
          return $res;
      }
      if (Config::DBMS==Config::DBMSMYSQL){
          //MySQL
          return new ResultDBMySQL($res);
      }
      if (Config::DBMS==Config::DBMSSQLITE){
          //SQLite
          return new ResultDBSQLite($res);
      }
      return null;
  }
    
}
