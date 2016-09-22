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
  const DBUSER='root';
  const DBPASSWD='';
  const DBSCHEMA='logger';
  //--------
  const SAMPLETHRESHOLD=2000;
  const APPLICATIONFOLDER='logger';
//  const APPLICATIONHOSTURL="http://itis0001.belluzzifioravanti.it";
  const APPLICATIONHOSTURL="http://localhost";
  const APPLICATIONHEADERH1="LOG system";
}
