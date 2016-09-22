<?php
require_once __DIR__.'/DB.php';
/**
 * Description of DBMySQL
 *
 * @author ragno
 */
class DBMySQL extends DB {
  public function __construct() {
    $this->db=new MySQLi(Config::DBHOST,Config::DBUSER,Config::DBPASSWD,Config::DBSCHEMA);
  }
  public function query($query){
    return ResultDB::factory($this->db->query($query));
  }

  public function exec($query){
    return ResultDB::factory($this->db->query($query));
  }
}
