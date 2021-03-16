<?php include("loginCheck.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Control</title>
  <style>
  body {
    overflow-x: hidden;
  }

  .dev {
    background-color: #006666;
    padding: 10px;

  }
  .dev label {
    color: #EEEEEE;
    font-size: 20px;
  }

  .hr {
    border: 2px solid red;
  }

  #temperature{
    height: 300px;
  }
  #humidity{
    height: 300px;
  }

  .gauge {
    //border-left: 2px #BBBBBB solid;
    //border-right: 2px #BBBBBB solid;
  }
  .onoff {
    margin-bottom: 10px;
  }

  .alarmlabel{
    font-size: 20px;
  }

  .alarmlightg{
    display: inline-block;
    height: 25px;
    width: 25px;
    border-radius: 300px;
    background-color: #339900;
    box-shadow: 0px 0px 10px #33FF00;
  }
@keyframes alarm {
  0%   {box-shadow: 0px 0px 1px #FF3300;background-color: #aa0000;}
  25%  {box-shadow: 0px 0px 5px #FF3300;background-color: #ff0000;}
  50%  {box-shadow: 0px 0px 10px #FF3300;background-color: #aa0000;}
  100% {box-shadow: 0px 0px 15px #FF3300;background-color: #ff0000;}
}
@keyframes spin {
  0%   {transform: rotate(0deg)}
  8.3%  {transform: rotate(30deg)}
  16.6%  {transform: rotate(60deg)}
  24.9% {transform: rotate(90deg)}
  33.2% {transform: rotate(120deg)}
  41.5% {transform: rotate(150deg)}
  49.8% {transform: rotate(180deg)}
  58.1% {transform: rotate(210deg)}
  66.4% {transform: rotate(240deg)}
  74.7% {transform: rotate(270deg)}
  83% {transform: rotate(300deg)}
  91.3% {transform: rotate(330deg)}
  98% {transform: rotate(360deg)}
  100% {transform: rotate(0deg)}
}
    .leftlist {
      border-right:3px #666666  solid;
      position: fixed;
      left: 0px;
      top: 130px;
      width: 25%;
      padding: 15px;
    }

   .alarmlightr{
    display: inline-block;
    height: 25px;
    width: 25px;
    border-radius: 300px;
    background-color: #CC0000;
    animation-name: alarm;
    animation-iteration-count: infinite;
    animation-duration: 0.8s;
  }
  .spin {
    animation-name: spin;
    animation-iteration-count: infinite;
    animation-duration: 0.5s;
    color: #33CC00;
  }

  #thh, #tht{
    display: block;
    height: 40px;
    text-align: center;
    font-size: 25px;
    background-color: #000000;
    color: #FFFFFF;
    padding: 5px;
  }
  #systemconnection {
    display: block;
    height: 40px;
    text-align: center;
    font-size: 25px;
    padding: 5px;
  }

  .thresholds {
    cursor: pointer;
  }
   #linehumi, #linetemp {
     min-height: 350px;
   }

  .sys{
    text-align: center;
    padding-top: 100px;
  }
  .sys button {
    width: 150px;
    border-radius: 10px;
    height: 40px;
  }
   #systemstatus {
     display: block;
     width: 100%;
     height: 50px;
     padding: 8px;
     color: #FFFFFF;
     position: relative;
     font-size: 18px;
     background-color: #FF9900;
     cursor: pointer;
     border-left: 8px solid #888888;
   }
   #fan , #light , #alarm {
     display: block;
     width: 100%;
     height: 50px;
     padding: 10px;
     color: #FFFFFF;
     position: relative;
     font-size: 18px;
     background-color: #FF9900;
     cursor: pointer;
     text-align: center;
   }
  .onoff label {
    font-size: 18px;
     width: 100%;
     height: 50px;
     padding: 8px;
  }
  .lighton {
    color: #F0DF0F;
    text-shadow: 0px 0px 20px #FFFF00;

  }
  .alarmon {
    color: #FF0000;
    text-shadow: 0px 0px 10px #CC0000;

  }
  .adminlist {
    position: relative;
    list-style: none;
    display: block;
    width:100%;
    padding: 0px;
  }
  .adminlist li {
    display: block;
    height: 50px;
    width:100%;
    border-bottom: 2px red solid
  }

  .adminlist li a {
    color: #fff;
    display: block;
    height: 100%;
    font-size: 20px;
    padding: 10px;
    text-decoration: none;
  }
  .adminlist li a:hover {
    color: #123;
  }


  </style>
  </head>

<body>
<?php include("header.php"); ?>
<div class="col-md-12">
  <div class="row">
  <div class="col-md-3">
  <div class="leftlist">
   <div class="col-md-12 dev">
     <div class="form-group">
       <label class="col-sm-4"> Device </label>
       <select class="col-sm-8 input-md btn form-control selectpicker" data-live-search="true" id="devices">
          <option>-- select Device --</option>
       </select>
     </div>
   </div>
   <div class="col-md-12 dev">
     <div class="form-group">
       <label class="col-sm-4" > Machine </label>
       <select class="col-sm-8 input-md btn form-control selectpicker" name="machine" id="machine">
          <option value="1" class="btn"> Machine 1</option>
          <option value="2" class="btn"> Machine 2</option>
       </select>
     </div>
   </div>
   <div class="col-md-12">
   <hr class="hr"/>
   </div>
   <?php
   if($_SESSION['login'] == 1 && $_SESSION['periv'] == 1){
   ?>
   <div class="col-md-12 dev">
     <ul class="adminlist">
        <li><a href="adddevice.php">Add new Device</a></li>
     </ul>
   </div>

   <?php
      echo "<input type='hidden' id='userperiv' value='1'/>";
   }else{
     echo "<input type='hidden' id='userperiv' value='2'/>";
     require_once("script/dbconnection.php");
     $sql = "select * from devices where user_id =? ";
     $res = getData($con,$sql,[$_SESSION['userid']]);
     echo "<input type='hidden' id='d_id' value='".$res['0']['d_id']."'/>";
   } ?>
  </div>
  </div>
  <div class="col-md-9">
    <div class="row">
        <div class="col-sm-4">
            <label id="tht"></label>
        </div>
        <div class="col-sm-4">
            <label id="systemconnection">Samart Hatchry System</label>
        </div>
        <div class="col-sm-4">
            <label id="thh"></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 gauge">
         <div id="temperature"></div>
         <div id="tempthr">
          <div class="input-group">
              <input id="tempthreashold" type="text" class="form-control" name="tempthreashold" placeholder="Threashold">
              <span onclick="changeTheTemp()" class="input-group-addon thresholds"><i class="glyphicon glyphicon-upload"></i></span>
            </div>
         </div>
        </div>

        <div class="col-md-4 sys">
            <label id="systemstatus">Loading...</label>
            <input type="hidden" value="0" id="currentsystemstatus" />
        </div>

        <div class="col-md-4 gauge">
         <div id="humidity"></div>
         <div id="humithr">
            <div class="input-group">
              <input id="humithreashold" type="text" class="form-control" name="humithreashold" placeholder="Threashold">
              <span onclick="changeTheHumi()" class="input-group-addon thresholds"><i class="glyphicon glyphicon-upload"></i></span>
            </div>
         </div>
        </div>
    </div>
    <div class="row"><hr class="hr"/></div>
    <div class="row">
       <div class="col-md-5 col-sm-4">
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                High Temperature Alarm <i class="fas fa-temperature-high"></i></label>
                <label class="alarmlightg" id="highttempalarm"></label>
            </div>
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                Low Temperature Alarm <i class="fas fa-temperature-low"></i></label>
                <label class="alarmlightg" id="lowtempalarm"></label>
            </div>
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                High Humidity alarm <i class="fas fa-tint"></i></label>
                <label class="alarmlightg" id="highhumialarm"></label>
            </div>
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                Low Humidity alarm <i class="fas fa-tint"></i></label>
                <label class="alarmlightg" id="lowhumialarm"></label>
            </div>
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                Belt Status <i class="fas fa-bacon"></i></label>
                <label class="alarmlightg" id="beltalarm"></label>
            </div>
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                Light Status <i class="far fa-lightbulb"></i></label>
                <label class="alarmlightr" id="lightalarm"></label>
            </div>
            <div class="col-md-12 alarm">
                <label class="col-xs-10 alarmlabel">
                Door Status <i class="fas fa-door-closed"></i></label>
                <label class="alarmlightr" id="dooralarm"></label>
            </div>
       </div>
       <div class="col-md-2 col-sm-4"></div>
       <div class="col-md-5 col-sm-4">
            <div class="col-md-5 onoff">
                <label> Fan Status <i id="fanicon" class="fas  fa-lg fa-star-of-life"></i></label>
            </div>
            <div class="col-md-7 onoff">
                <div id="fans">
                    <label id="fan">Loading...</label>
                    <input type="hidden" value="0" id="currentfanstatus" />
                </div>
            </div>
            <div class="col-md-5 onoff">
                <label >Light Status <i id="lighticon" class="fas fa-lightbulb fa-lg"></i></label>
            </div>
            <div class="col-md-7 onoff">
                <div id="lights">
                    <label id="light">Loading...</label>
                    <input type="hidden" value="0" id="currentlightstatus" />
                </div>
            </div>
            <div class="col-md-5 onoff">
                <label >Alarm Status <i id="alarmicon" class="fas fa-bell fa-lg"></i></label>
            </div>
            <div class="col-md-7 onoff">
                <div id="alarms">
                    <label id="alarm">Loading...</label>
                    <input type="hidden" value="0" id="currentalarmstatus" />
                </div>
            </div>
       </div>
    </div>
    <div class="row"><hr class="hr"/></div>
    <div class="row">
      <div class="col-md-6">
        <div id="linetemp"></div>
      </div>
      <div class="col-md-6">
        <div id="linehumi"></div>
      </div>
    </div>
  </div>
  </div>
</div>
<?php include("footer.php"); ?>
 <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
 <script type="text/javascript" src="bootstrap-3.3.7-dist/js/charts.js"></script>
 <script type="text/javascript">

      google.charts.load('current', {'packages':['gauge']});
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(temperature);
      google.charts.setOnLoadCallback(humidity);

      var gaugeOptions = {
           height: 300,
          redFrom: 70, redTo: 120,
          yellowFrom:40, yellowTo: 70,
          greenFrom:30,greenTo:40,
          minorTicks: 5 , max :120
        };
      function temperature() {
      gaugeData = new google.visualization.DataTable();
      gaugeData.addColumn('number', 'Temperture');
      gaugeData.addRows(1);
      gaugeData.setCell(0, 0,0);

      gauge = new google.visualization.Gauge(document.getElementById('temperature'));
      gauge.draw(gaugeData, gaugeOptions);

      }
      var gaugeOptions2 = {
          height: 300,
          redFrom: 70, redTo: 100,
          yellowFrom:40, yellowTo: 70,
          greenFrom:30,greenTo:40,
          minorTicks: 5 , max :100
        };
      function humidity() {
      gaugeData2 = new google.visualization.DataTable();
      gaugeData2.addColumn('number', 'Humidity');
      gaugeData2.addRows(1);
      gaugeData2.setCell(0, 0,0);

      gauge2 = new google.visualization.Gauge(document.getElementById('humidity'));
      gauge2.draw(gaugeData2, gaugeOptions2);

      }
      function changeReads(d,m) {
        $.ajax({
          url:"script/_getCurrentReads.php",
          data:{d_id:d,m_id:m},
          success:function(res){
           $.each(res.data,function(){
            gaugeData.setValue(0, 0, this.t1);
            gauge.draw(gaugeData, gaugeOptions);
            gaugeData2.setValue(0, 0, this.h1);
            gauge2.draw(gaugeData2, gaugeOptions2);

           });
          },
          error:function(e){

          }
        });
     }
     google.charts.setOnLoadCallback(linetemp);

      function linetemp(d,m) {
        var jsonData = $.ajax({
            url: "script/_gettemp.php",
            dataType: "json",
            data:{d_id:d,m_id:m},
            async: false,
            success:function(res){console.log(res);},
            error:function(res){console.log(res);}
            }).responseText;

        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);
         var Tempoptions = {
         title:'Latest Temperature Reads',
         legend:{position:'bottom'},
         chartArea:{width:'80%'},
          explorer: { axis: 'horizontal',maxZoomIn: 0.5, maxZoomOut: 8,
          actions: ['dragToZoom', 'rightClickToReset'],zoomDelta:1.5  },
          hAxis: {
            title:"Time",
            showTextEvery:60
          },
          vAxis: {
            minValue: 0,
            gridlines: {count: 12},title:"Temperature"
          }
         };        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('linetemp'));
        chart.draw(data,Tempoptions);
      }
      google.charts.setOnLoadCallback(linehumi);
      function linehumi(d,m) {
        var jsonData = $.ajax({
            url: "script/_gethumi.php",
            dataType: "json",
            data:{d_id:d,m_id:m},
            async: false,
            success:function(res){console.log(res);},
            error:function(res){console.log(res);}
            }).responseText;

        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);
         var Humioptions = {
         title:'Latest Humidity Reads',
         legend:{position:'bottom'},
         chartArea:{width:'80%'},
          hAxis: {
            title:"Time",
            showTextEvery:60
          },
          vAxis: {
            minValue: 0,
            gridlines: {count: 10},title:"Humidity"
          }
         };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('linehumi'));
        chart.draw(data,Humioptions);
      }
      function setstatuses(d,m){
        $.ajax({
           url:"script/_getstatuses.php",
           type:"post",
           data:{d_id:d,m_id:m},
           beforeSend:function(){
           },
           success:function(res){
            console.log(res);
            $.each(res.data,function(){
             if(this.name == 'h3' && this.status == 0){
               $("#highttempalarm").removeClass("alarmlightr");
               $("#highttempalarm").addClass("alarmlightg");
             }else if (this.name == 'h3' && this.status == 1){
               $("#highttempalarm").removeClass("alarmlightg");
               $("#highttempalarm").addClass("alarmlightr");
             }

             if(this.name == 'h4' && this.status == 0){
               $("#lowtempalarm").removeClass("alarmlightr");
               $("#lowtempalarm").addClass("alarmlightg");
             }else if (this.name == 'h4' && this.status == 1){
               $("#lowtempalarm").removeClass("alarmlightg");
               $("#lowtempalarm").addClass("alarmlightr");
             }
             if(this.name == 't3' && this.status == 0){
               $("#highhumialarm").removeClass("alarmlightr");
               $("#highhumialarm").addClass("alarmlightg");
             }else if (this.name == 't3' && this.status == 1){
               $("#highhumialarm").removeClass("alarmlightg");
               $("#highhumialarm").addClass("alarmlightr");
             }
             if(this.name == 't4' && this.status == 0){
               $("#lowhumialarm").removeClass("alarmlightr");
               $("#lowhumialarm").addClass("alarmlightg");
             }else if (this.name == 't4' && this.status == 1){
               $("#lowhumialarm").removeClass("alarmlightg");
               $("#lowhumialarm").addClass("alarmlightr");
             }
             if(this.name == 'b' && this.status == 1){
               $("#beltalarm").removeClass("alarmlightr");
               $("#beltalarm").addClass("alarmlightg");
             }else if (this.name == 'b' && this.status == 0){
               $("#beltalarm").removeClass("alarmlightg");
               $("#beltalarm").addClass("alarmlightr");
             }
             if(this.name == 'd' && this.status == 1){
               $("#dooralarm").removeClass("alarmlightr");
               $("#dooralarm").addClass("alarmlightg");
             }else if (this.name == 'd' && this.status == 0){
               $("#dooralarm").removeClass("alarmlightg");
               $("#dooralarm").addClass("alarmlightr");
             }
             if(this.name == 'l' && this.status == 1){
               $("#lightalarm").removeClass("alarmlightr");
               $("#lightalarm").addClass("alarmlightg");
             }else if (this.name == 'l' && this.status == 0){
               $("#lightalarm").removeClass("alarmlightg");
               $("#lightalarm").addClass("alarmlightr");
             }


             if(this.name == 't2'){
              //$("#tempthreashold").val(this.status);
              $("#tht").text(this.status);
             }
             if(this.name == 'h2'){
              //$("#humithreashold").val(this.status);
              $("#thh").text(this.status);
             }

             if(this.name == 'f' && this.status == 1){
              	$('#currentfanstatus').val(1);
              	$('#fan').text("ON");
                $('#fanicon').addClass("spin");
                $('#fan').css("border-right","8px solid #888888");
                $('#fan').css("border-left","none");
                $('#fan').css("background-color","#66CC00");
             }else if(this.name == 'f' && this.status == 0){
                $('#currentfanstatus').val(0);
                $('#fanicon').removeClass("spin");
                $('#fan').text("OFF");
                $('#fan').css("border-left","8px solid #888888");
                $('#fan').css("border-right","none");
                $('#fan').css("background-color","#CC0000");
             }

             if(this.name == 'l' && this.status == 1){
              	$('#currentlightstatus').val(1);
                $('#light').text("ON");
                $('#lighticon').addClass("lighton");
                $('#light').css("border-right","8px solid #888888");
                $('#light').css("border-left","none");
                $('#light').css("background-color","#66CC00");
             }else if(this.name == 'l' && this.status == 0){
                $('#currentlightstatus').val(0);
                $('#light').text("OFF");
                $('#lighticon').removeClass("lighton");
                $('#light').css("border-left","8px solid #888888");
                $('#light').css("border-right","none");
                $('#light').css("background-color","#CC0000");
             }

             if(this.name == 'ss' && this.status == 1){
              	$('#currentsystemstatus').val(1);
              	$('#systemstatus').text("Automatic");
              $('#systemstatus').css("border-right","8px solid #888888");
              $('#systemstatus').css("border-left","none");
              $('#systemstatus').css("background-color","#66CC00");

             }else if(this.name == 'ss' && this.status == 0){
              $('#currentsystemstatus').val(0);
              $('#systemstatus').text("Manual");
              $('#systemstatus').css("border-left","8px solid #888888");
              $('#systemstatus').css("border-right","none");
              $('#systemstatus').css("background-color","#111111");

             }
             if(this.name == 'sc' && this.status == 1){
              	$('#currentalarmstatus').val(1);
                $('#alarm').text("Activated");
                $('#alarmicon').addClass("alarmon");
                $('#alarm').css("border-right","8px solid #888888");
                $('#alarm').css("border-left","none");
                $('#alarm').css("background-color","#66CC00");
             }else if(this.name == 'sc' && this.status == 0){
                $('#currentalarmstatus').val(0);
                $('#alarm').text("Muted");
                $('#alarmicon').removeClass("alarmon");
                $('#alarm').css("border-left","8px solid #888888");
                $('#alarm').css("border-right","none");
                $('#alarm').css("background-color","#CC0000");
             }
            });

           },
           error:function(e){
            console.log(e);
           }
        });
      }
      setstatuses($("#devices").val(),$("#machine").val()); //need to specify the device and machine number
      function switchdevice(d,m){
        fan = $('#currentfanstatus').val();
        light = $('#currentlightstatus').val()
        systemstatus = $('#currentsystemstatus').val() ; //auto
        alarmstatus = $('#currentalarmstatus').val() ; //auto

        $.ajax({
          url:"script/_onoff.php",
          type:"POST",
          beforeSend:function(){
            $('#systemstatus').css("border-bottom","8px solid #FF9900");
            $('#ligh').css("border-bottom","8px solid #FF9900");
            $('#fan').css("border-bottom","8px solid #FF9900");
            $('#alarm').css("border-bottom","8px solid #FF9900");
          },
          data:{f:fan,l:light,d_id:d,m_id:m,ss:systemstatus,sc:alarmstatus},
          success:function(res){
           console.log(res);
           $('#systemstatus').css("border-bottom","none");
           $('#light').css("border-bottom","none");
           $('#fan').css("border-bottom","none");
           $('#alarm').css("border-bottom","none");
           setstatuses($("#devices").val(),$("#machine").val());
          },
          error:function(e){
           console.log(e);
           $('#systemstatus').css("border-bottom","none");
           $('#light').css("border-bottom","none");
           $('#fan').css("border-bottom","none");
           $('#alarm').css("border-bottom","none");
          }
        });

      }
      $("#fans").click(function(){
        if($('#currentfanstatus').val() == 1){
          $('#currentfanstatus').val(0);
          $('#fanicon').removeClass("spin");
        }else{
          $('#currentfanstatus').val(1);
          $('#fanicon').addClass("spin");
        }
        switchdevice($("#devices").val(),$("#machine").val());
        setstatuses($("#devices").val(),$("#machine").val());
      });
      $("#lights").click(function(){
        if($('#currentlightstatus').val() == 1){
          $('#currentlightstatus').val(0)
          $('#lighticon').removeClass("lighton");
        }else{
          $('#currentlightstatus').val(1)
          $('#lighticon').addClass("lighton");
        }
        switchdevice($("#devices").val(),$("#machine").val());
        setstatuses($("#devices").val(),$("#machine").val());
      });
      $("#alarms").click(function(){
        if($('#currentalarmstatus').val() == 1){
          $('#currentalarmstatus').val(0)
          $('#alarmicon').removeClass("alarmon");
        }else{
          $('#currentalarmstatus').val(1)
          $('#alarmicon').addClass("alarmon");
        }
        switchdevice($("#devices").val(),$("#machine").val());
        setstatuses($("#devices").val(),$("#machine").val());
      });
      $("#systemstatus").click(function(){
        if($('#currentsystemstatus').val() == 1){
          $('#currentsystemstatus').val(0)
        }else{
          $('#currentsystemstatus').val(1)
        }
        switchdevice($("#devices").val(),$("#machine").val());
        setstatuses($("#devices").val(),$("#machine").val());
      });

      function getDevices(){
        $.ajax({
          url:"script/_getDevices.php",
          type:"POST",
          success:function(res){
           console.log(res);
           $.each(res.data,function(){
             $("#devices").append(
             '<option value="'+this.d_id+'">'+this.name+'</option>'
             );
           });
           if($("#userperiv").val() == 2){
             $("#devices").val($("#d_id").val());
             $("#devices").addClass('disabled');
             $("#devices").attr('disabled','disabled');
             setstatuses($("#devices").val(),$("#machine").val());
             changeReads($("#devices").val(),$("#machine").val());
             linetemp($("#devices").val(),$("#machine").val());
             linehumi($("#devices").val(),$("#machine").val());
           }
          },
          error:function(e){
           console.log(e);
          }
        });
      }
      getDevices();

      function changeTheTemp(){
        $.ajax({
          url:"script/_changeTheTemp.php",
          type:"POST",
          data:{threshold:$("#tempthreashold").val(),d_id:$("#devices").val(),m_id:$("#machine").val()},
          success:function(res){
           console.log(res);
          },
          error:function(e){
           console.log(e);
          }
        });
      }
      function changeTheHumi(){
        $.ajax({
          url:"script/_changeTheHumi.php",
          type:"POST",
          data:{threshold:$("#humithreashold").val(),d_id:$("#devices").val(),m_id:$("#machine").val()},
          success:function(res){
           console.log(res);
          },
          error:function(e){
           console.log(e);
          }
        });
      }
      $("#devices").change(function(){
        setstatuses($("#devices").val(),$("#machine").val());
        changeReads($("#devices").val(),$("#machine").val());
        linetemp($("#devices").val(),$("#machine").val());
        linehumi($("#devices").val(),$("#machine").val());
       });
      $("#machine").change(function(){
        setstatuses($("#devices").val(),$("#machine").val());
        changeReads($("#devices").val(),$("#machine").val());
        linetemp($("#devices").val(),$("#machine").val());
        linehumi($("#devices").val(),$("#machine").val());
      });
      setInterval(function() {
        //randomreads();
        setstatuses($("#devices").val(),$("#machine").val());
        changeReads($("#devices").val(),$("#machine").val());
        linetemp($("#devices").val(),$("#machine").val());
        linehumi($("#devices").val(),$("#machine").val());
        //randomreads();
      }, 1000);
      function randomreads(){ ///------testing function adds random reads
        $.ajax({
          url:"script/randomreads.php",
          success:function(res){
           console.log(res);
          },
          error:function(e){
           console.log(e);
          }
        });
      }
    </script>
</body>

</html>
