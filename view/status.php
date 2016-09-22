<?php
/* @var $this HtmlPage */
/* @var $sample Sample */
?>
<script type="text/javascript" src="js/lib/jquery.js"></script>
<script type="text/javascript" src="js/Refresher.js"></script>
<h2><strong>Samples</strong> real time udated</h2>
<?php
/* @var $samples SampleIterator */
$samples=$this->contentObjects['samples'];
if (!$samples->valid()){
    echo "<p>No data available.</p>";
}
else {
?>
<div id="status_table">
  <table>
    <tr><th>id</th><th>node</th><th>date</th><th>value</th><th>alarm</th></tr>
    <?php
    foreach ($samples as $k => $sample){
        echo "<tr><td>".$sample->getSam_id()."</td><td>".$sample->getNod_desc()."</td><td>".$sample->getSam_ts()."</td><td>".$sample->getSam_value()."</td><td>".($sample->getSam_alarm()?'Alarm':'None')."</td></tr>";
    }
    ?>
</table>
</div>
<?php
}
echo "<p>Status detected at <span id=\"data\">".date("d/m/Y H:i:s")."</span></p>";
?>
<!--<div id="ref_enable_div">
    <span id="ref_enable_status"></span>
    <button id="ref_enable_bt">EEE</button>
</div>-->
<script type="text/javascript">
//var button=$("#ref_enable_bt");
//var ref=new Refresher(5*1000,function(){
//    location.reload();
//});
var ref=new Refresher(5*1000,refreshTheTable);
ref.start();

function refreshTheTable() {
//                  alert("Draw the Map");
//                  alert('<?php //echo $url; ?>');
//  aggiornaBottone();
        //var map;
        //drawPolyline(map, getCoordinates());
        //drawSessionPoints($.parseJSON(pointListJson));
        var sendDataJSON = "";
        $.ajax({
//				url: 'http://techiewear.belluzzifioravanti.it/Yii_test/index.php?r=api/trainingApi/getPointList&data={"tsid":"'+trainingId+'"}',
                url: '<?php echo Config::APPLICATIONHOSTURL.'/'.Config::APPLICATIONFOLDER.'/index.php?r=api/status'; ?>',
//                url: 'http://localhost/presences/api/status.php',
                type: 'GET',
                dataType: 'json',
                data: sendDataJSON,
        })
        .done(drawTheTable)
        .fail(function() {
                console.log("error");
        })
        .always(function() {
                console.log("complete");
        });
};

function drawTheTable(t){
  var tb="<table>\n<tr><th>id</th><th>node</th><th>date</th><th>value</th><th>alarm</th></tr>\n";
  for (var i = 0; i < t.length; i++) {
      tb+="<tr>"
      for (var j = 0; j < t[i].length; j++) {
          tb+="<td>"+t[i][j]+"</td>";
      }    
      tb+="</tr>"
  }
  tb+="</table>\n";
  $("#status_table").html(tb);
  $("#data").html(new Date().toString());
}

//button.click(onClickBottone);
//
//function aggiornaBottone(){
//  if (ref.getRunningStatus()){
//    //is running
//    $("#ref_enable_status").html("AutoRefresh status: enabled. ")
//    $("#ref_enable_bt").html("DISABLE AutoRefresh")
//  }
//  else {
//    $("#ref_enable_status").html("AutoRefresh status: disabled. ")
//    $("#ref_enable_bt").html("ENABLE AutoRefresh");
//  }
//}
//
//function onClickBottone(){
//  if (ref.getRunningStatus()){
//    //is running
//    ref.stop();
//  }
//  else {
//    ref.start();
//  }
//  aggiornaBottone();
//}

    
</script>