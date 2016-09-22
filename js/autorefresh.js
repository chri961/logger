

function drawTheMap() {
//                  alert("Draw the Map");
//                  alert('<?php echo $url; ?>');
  aggiornaBottone();
        //var map;
        //drawPolyline(map, getCoordinates());
        //drawSessionPoints($.parseJSON(pointListJson));
        var sendDataJSON = "data={\"token\": \""+token+"\"}"
        $.ajax({
//				url: 'http://techiewear.belluzzifioravanti.it/Yii_test/index.php?r=api/trainingApi/getPointList&data={"tsid":"'+trainingId+'"}',
                url: '<?php echo $url; ?>',
                type: 'POST',
                dataType: 'json',
                data: sendDataJSON,
        })
        .done(drawSessionPoints)
        .fail(function() {
                console.log("error");
        })
        .always(function() {
                console.log("complete");
        });
};


//enable,msec,refreshedFunction
$("#ref_enable_bt").click(onClickBottone);
var ref = new Refresher(10*1000,drawTheMap);
//ref.start();

function aggiornaBottone(){
  if (ref.getRunningStatus()){
    //is running
    $("#ref_enable_status").html("AutoRefresh status: enabled. ")
    $("#ref_enable_bt").html("DISABLE AutoRefresh")
  }
  else {
    $("#ref_enable_status").html("AutoRefresh status: disabled. ")
    $("#ref_enable_bt").html("ENABLE AutoRefresh");
  }
}

function onClickBottone(){
  if (ref.getRunningStatus()){
    //is running
    ref.stop();
  }
  else {
    ref.start();
  }
  aggiornaBottone();
}

