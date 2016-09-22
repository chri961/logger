<?php
/**
 * Description of Config
 *
 * @author Gianni
 */
class Config {
  const DBMSMYSQL='MySQL';
  const DBMSSQLITE='SQLite';
  const DBMS=self::DBMSMYSQL;
//  const DBMS=self::DBMSSQLITE;
  // per SQLite
  const DBFILE='log.sqlite';
  const DATAFOLDER = '/data';
  const SQLITEADMINPASSWD='Belluzzi';
  const SQLITEADMINPATH='lib/phpliteAdmin_v1-9-5/phpliteadmin.php';
  //--------
  //per MySQL
  const DBHOST='localhost';
  const DBUSER='healthcare';
  const DBPASSWD='Belluzzi';
  const DBSCHEMA='healthcare';
  //--------
  const SAMPLETHRESHOLD=2000;
  const APPLICATIONFOLDER='healthcare';
  const APPLICATIONHOSTURL="http://itis0001.belluzzifioravanti.it";
//  const APPLICATIONHOSTURL="http://localhost";
  const APPLICATIONHEADERH1="HEALTHCARE log system";
  
}
