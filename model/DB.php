<?php
require_once __DIR__."/ResultDB.php";
require_once __DIR__.'/DBMySQL.php';
require_once __DIR__.'/DBSQLite.php';

/**
 * Description of DB
 *
 * @author Gianni
 */
abstract class DB {
  protected $db;
  public abstract function query($query);

  public abstract function exec($query);
  
  /**
   * 
   * @return \DB
   */
  static function factory(){
      if (Config::DBMS==Config::DBMSMYSQL){
          //MySQL
          return new DBMySQL();
      }
      if (Config::DBMS==Config::DBMSSQLITE){
          //SQLite
          return new DBSQLite();
      }
      return null;
  }
  
}
