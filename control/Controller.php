<?php
require_once __dir__.'/../view/HtmlPage.php';
require_once __dir__.'/../view/ApiPage.php';
require_once __dir__.'/../conf/Config.php';
require_once __dir__.'/../model/DB.php';
require_once __dir__.'/../model/Sample.php';

/**
 * Description of Controller
 *
 * @author Gianni
 */
class Controller {
  private $page;
  private $conf;
  function __construct($html=TRUE) {
    $this->conf=new Config();
    if ($html) {
      $this->page=new HtmlPage();
    }
    else {
      $this->page=new ApiPage();
    }
    
  }
  
  function route(){
      if (isset($_GET['r'])){
          $parts=  explode('/',$_GET['r']);
          if (count($parts)==1){
              $action=$parts[0];
              $method='action'.strtoupper(substr($action, 0, 1)).substr($action, 1);
          }
          else{
             //api 
              $control=$parts[0];
              $action=$parts[1];
              $method='action'.strtoupper(substr($control, 0, 1)).substr($control, 1).strtoupper(substr($action, 0, 1)).substr($action, 1);
              $this->page=new ApiPage();//output non html
          }
//          $method='action'.strtoupper(substr($_GET['r'], 0, 1)).substr($_GET['r'], 1);
          if(method_exists($this,$method)){
              $this->$method();
          }
          else {
              $this->page->addData('errore', "Azione non riconosciuta: {$_GET['r']}");
              $this->page->show('Routing error','error.php');    
          }
      }
      else {
          $this->actionIndex();
      }
  }

/*-------------------------------------------------------------------*/	
  
  function actionIndex(){
    $this->page->show('Control system','index.php');    
  }
  function actionStatus(){
      $samples = Sample::findAll();
      $this->page->addObject('samples',$samples);
      $this->page->show('Status','status.php');        
  }
  
    function actionPhpliteadmin(){
//        include __DIR__.'/../lib/phpliteAdmin_v1-9-5/phpliteadmin.php';
        header("location: ".Config::SQLITEADMINPATH);

    }
    function actionTest(){
      $this->page->show('Simulate system','test.php');    
    }
  
  /**********************************************************************
   * APIS
   */
  function actionApiPing(){
    $this->page->show('{ apiresult : 1 }');    
  }
  
  function actionApiSend(){
    $error=true;
    $sample=null;
    if (array_key_exists('id', $_GET)) {
        $nod_id=$_GET['id'];
        if (array_key_exists('value', $_GET)) {
            $sam_value=$_GET['value'];
            if (array_key_exists('timestamp', $_GET)) {
                $ts=$_GET['timestamp'];
                $sam_ts=date("Y-m-d H:i:s", hexdec($ts));
                $sample=new Sample(NULL, $sam_value, $sam_ts, $nod_id, NULL);  
                if (($r=$sample->save())===false){
                    $error=true;
                }
                else {
                    $error=false;
                }
            }
        }
    }  
    $this->page->show('{ apiresult : '.($error?0:1).' }'/*.print_r($sample,TRUE).print_r($r,TRUE)*/);    
  }

    function actionApiStatus(){
        /* @var $sample Sample */
        $samples = Sample::findAll();
        $data=array();
        foreach ($samples as $k => $sample){
            $p[0]=$sample->getSam_id();
            $p[1]=$sample->getNod_desc();
            $p[2]=$sample->getSam_ts();
            $p[3]=$sample->getSam_value();
            $p[4]=($sample->getSam_alarm()?'Alarm':'None');
            $data[]=$p;
        }
        $this->page->show(json_encode($data));
    }

/*-------------------------------------------------------------------*/	
  /*
    function actionApiUpdate(){
        if (array_key_exists('id', $_GET)) {
            $pres=  Presence::findByPk($_GET['id']);
            if ($pres){
                $pres->togglePre_in();
                $pres->update();
                if($pres->getPre_in()){
                    $msg='INCOMING';
                }
                else {
                    $msg='OUTGOING';
                }
            }
            else {
              $msg="ERROR";
            }
        }
        else {
            $msg="ERROR";
        }
        $this->page->show($msg);   
    }
  */

//    function actionApiEnhancedUpdate(){
//        if (array_key_exists('id', $_GET)) {
//            $pres=  Presence::findByPk($_GET['id']);
//            if ($pres){
//                $pres->togglePre_in();
//                $pres->update();
//                if($pres->getPre_in()){
//                    $msg='INCOMING '.$pres->getPre_name();
//                }
//                else {
//                    $msg='OUTGOING '.$pres->getPre_name();
//                }
//            }
//            else {
//              $msg="ERROR";
//            }
//        }
//        else {
//            $msg="ERROR";
//        }
//        $this->page->show($msg);   
//    }
  
//  function actionApiCreate(){
//    $db=new DB();
//    $db->create();
//    $result = $db->query('SELECT * FROM presenze');
//    $out='';
//    while ($row=$result->fetchArray()){
//      $out.=print_r($row,TRUE); 
//    }
//    $this->page->show("<pre>$out</pre>");
//  }

}
