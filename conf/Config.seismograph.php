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
  //--------
  //per MySQL
  const DBHOST='localhost';
  const DBUSER='seismograph';
  const DBPASSWD='Belluzzi';
  const DBSCHEMA='seismograph';
  //--------
  const DATAFOLDER = '/data';
  const SQLITEADMINPASSWD='Belluzzi';
  const SQLITEADMINPATH='lib/phpliteAdmin_v1-9-5/phpliteadmin.php';
  const SAMPLETHRESHOLD=2000;
  const APPLICATIONFOLDER='seismograph';
  const APPLICATIONHOSTURL="http://itis0001.belluzzifioravanti.it";
//  const APPLICATIONHOSTURL="http://localhost";
  const APPLICATIONHEADERH1="SEISMOGRAPH log system";
  
}
