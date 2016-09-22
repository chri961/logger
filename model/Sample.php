4<?php
require_once __DIR__."/DB.php";
require_once __DIR__."/SampleIterator.php";

/**
 * Description of Sample
 *
 * @author Gianni
 */
class Sample {
    /** @var int PRIMARY KEY */
    private $sam_id;
    /** @var int */
    private $sam_value;
    /** @var string */
    private $sam_ts;
    /** @var string */
    private $nod_id;
    /** @var string */
    private $nod_desc;
    /** @var boolean */
    private $sam_alarm;
    
    /**
     * 
     * @param int $sam_id
     * @param int $sam_value
     * @param string $sam_ts
     * @param string $nod_id
     * @param string $nod_desc
     * @param int $sam_alarm
     */
    function __construct($sam_id, $sam_value, $sam_ts, $nod_id, $nod_desc, $sam_alarm=null) {
        $this->sam_id = $sam_id;
        $this->sam_value = $sam_value;
        $this->sam_ts = $sam_ts;
        $this->nod_id = $nod_id;
        $this->nod_desc = $nod_desc;
        $this->setSam_alarm($sam_alarm);
    }


    /**
     * return a new Sample object with $row data
     * @param mixed[] $row: array with a value for each field
     * @return \Sample
     */
    static function factoryByRow($row) {
        return new Sample($row['sam_id'],$row['sam_value'],$row['sam_ts'],$row['nod_id'],$row['nod_desc'],(isset($row['sam_alarm'])?($row['sam_alarm']==1):null));
    }

    /**
     * Find all data
     * @return \PresenceIterator the iterator
     */
    static function findAll($oredeby='sam_id',$ascending=false){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM sample s JOIN node n on s.nod_id=n.nod_id ORDER BY $oredeby ".($ascending?'ASC':'DESC'));
//        $rows=[];
//        while ($row=$result->fetchArray()){
//          $rows[]=$row; 
//        }
        return new SampleIterator($result);
    }
    
    /**
     * Find the object looking for $pk
     * @param string $pk primary key value you are looking for
     * @return \Presence
     */
    static function findByPk($pk){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM sample s JOIN node n on s.nod_id=n.nod_id WHERE sam_id='$pk'");
        $iter=new PresenceIterator($result);
        return $iter->current();
    }
    function save(){
        if ($this->sam_id===null){
            return $this->insert();
        }
        else {
            return $this->update();
        }
    }
    private function update(){
        $db=DB::factory();
        $query="UPDATE sample 
    SET 
      sam_value={$this->sam_value},
      sam_ts='{$this->sam_ts}',
      nod_id='{$this->nod_id}',
      sam_alarm=".($this->sam_alarm?1:0)."
    WHERE sam_id='{$this->sam_id}'";
        $status = $db->exec($query);
        return $status;
    }
    
    private function insert(){
        $db=DB::factory();
        $query="INSERT INTO sample (sam_value,sam_ts,nod_id,sam_alarm) 
                 VALUES (
                    {$this->sam_value},
                    '{$this->sam_ts}',
                    '{$this->nod_id}',
                    ".($this->sam_alarm?1:0)."
                 )";
        $status = $db->exec($query);
        return $status;
    }
    
    function getSam_id() {
        return $this->sam_id;
    }

    function getSam_value() {
        return $this->sam_value;
    }

    function getSam_ts() {
        return $this->sam_ts;
    }

    function getNod_id() {
        return $this->nod_id;
    }

    function getNod_desc() {
        return $this->nod_desc;
    }

    function getSam_alarm() {
        return $this->sam_alarm;
    }

    function setSam_id($sam_id) {
        $this->sam_id = $sam_id;
    }

    function setSam_value($sam_value) {
        $this->sam_value = $sam_value;
    }

    function setSam_ts($sam_ts) {
        $this->sam_ts = $sam_ts;
    }

    function setNod_id($nod_id) {
        $this->nod_id = $nod_id;
    }

    function setNod_desc($nod_desc) {
        $this->nod_desc = $nod_desc;
    }

    function setSam_alarm($sam_alarm=null) {
        $this->sam_alarm = ($sam_alarm===null?$this->sam_value>Config::SAMPLETHRESHOLD:$sam_alarm);
    }


}
