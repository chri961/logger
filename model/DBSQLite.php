<?php
require_once __DIR__.'/DB.php';

/**
 * Description of DBSQLite
 *
 * @author ragno
 */
class DBSQLite extends DB {
  public function __construct() {
    $this->db=new SQLite3(__DIR__."/../data/".Config::DBFILE);
  }
  public function query($query){
    return ResultDB::factory($this->db->query($query));
  }

  public function exec($query){
    return ResultDB::factory($this->db->exec($query));
  }
}
