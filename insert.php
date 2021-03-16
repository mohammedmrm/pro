<?php
header('Content-type:application/json;charset=windows-1256');
require_once("script/dbconnection.php");
error_reporting(0);
$t1 = $_REQUEST['t1']; //Temperature
$t2 = $_REQUEST['t2']; //Temperature Threashold
$t3 = $_REQUEST['t3']; // High Temperature
$t4 = $_REQUEST['t4'];  // Low Temperature

$h1 = $_REQUEST['h1']; //Humidity
$h2 = $_REQUEST['h2']; //Humidity Threashold
$h3 = $_REQUEST['h3'];  // High Humidity
$h4 = $_REQUEST['h4'];  //Low Humidity

$ss = $_REQUEST['ss'];  //system status
$sc = $_REQUEST['sc'];  // system connection

$b = $_REQUEST['b']; //belt status
$f = $_REQUEST['f'];   // fan status
$d = $_REQUEST['d'];   // door status
$l = $_REQUEST['l'];  // light status

$username = $_REQUEST['u']; //usersname
$password = $_REQUEST['p']; //password

$dev = $_REQUEST['dev']; //device id
$m = $_REQUEST['m'];     //machine 1 or 2
$msg = 'error';
// checking usernsme and password
if(empty($username) || empty($password)){
  $msg = "All Fields are required";
}else{
  $sql = "select * from users where username = ? and password =?";
  $result = getData($con,$sql,[$username,$password]);
  if(count($result) != 1){
    $msg = "Incorrect Password or Uesrname";
  }else{
    $msg = 1;
  }
}
//if login ok continue
if($msg == 1){
   $sql = "insert into measurement (d_id,m_id,t1,h1) values(?,?,?,?)";
   $result = setData($con,$sql,[$dev,$m,$t1,$h1]);
   if($result == 1){
    $msg = "Temperature and Humidity recorded";
   }
   //------------------------------------------------
//   //moving old recorded data to a file
//     date_default_timezone_set('Asia/Baghdad');
//   $cerrntdatetime = date('Y-m-d H:i:s');
//   $sql = "select * from measurement where TIMESTAMPDIFF(HOUR,datetime,?) >= 1";
//   $result = getData($con,$sql,[$cerrntdatetime]);
//   //print_r($result);
//   $file ="oldrecord/".date('Y-m-d').'.txt';
//   $fh = fopen($file, 'a');
//   if($fh && count($result) > 0 ){
//      $content = file_get_contents($file);
//      $array1 = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/','', $content), true);
//      //var_dump($content);
//      //var_dump($array1);
//      //var_dump($result);
//      if(!empty($array1)){
//      $merg = array_merge($array1,$result);
//      }else{
//        $merg = $result;
//      }
//      $newdata = json_encode($merg);
//      if(fwrite($fh,$newdata)){
//        $sql = "delete from measurement where TIMESTAMPDIFF(HOUR,datetime,?) >= 1";
//        $result = setData($con,$sql,[$cerrntdatetime]);
//      }
//   }
   //----------------------------------------------------
   // update diveces status like the fan , belt and etc...
   $sql = "update control set status = ? where name=? and d_id=? and m_id=?";
   if(!empty($h2) && ($h2==0 || $h2>=1)){
    $r1 = setData($con,$sql,[$h2,'h2',$dev,$m]);
   }
   if(!empty($h3) && ($h3==0 || $h3==1)){
     $r2 = setData($con,$sql,[$h3,'h3',$dev,$m]);
   }
   if(!empty($h4) && ($h4==0 || $h4==1)){
    $r3 = setData($con,$sql,[$h4,'h4',$dev,$m]);
   }
   if(!empty($t2) && ($t2==0 || $t2>=1)){
    $r4 = setData($con,$sql,[$t2,'t2',$dev,$m]);
   }
   if(!empty($t3)  && ($t3==0 || $t3==1)){
    $r5 = setData($con,$sql,[$t3,'t3',$dev,$m]);
   }
   if(!empty($t4) && ($t4==0 || $t4==1)){
    $r6 = setData($con,$sql,[$t4,'t4',$dev,$m]);
   }

   if(!empty($f) && ($f==0 || $f==1)){
    $r7 = setData($con,$sql,[$f,'f',$dev,$m]);
   }
   if(!empty($d) && ($d==0 || $d==1)){
    $r8 = setData($con,$sql,[$d,'d',$dev,$m]);
   }
   if(!empty($l) && ($l==0 || $l==1)){
    $r9 = setData($con,$sql,[$l,'l',$dev,$m]);
   }
   if(!empty($b) && ($b==0 || $b==1)){
    $r10 = setData($con,$sql,[$b,'b',$dev,$m]);
   }

   if(!empty($ss) && ($ss==0 || $ss==1)){
    $r11 = setData($con,$sql,[$ss,'ss',$dev,$m]);
   }
   if(!empty($sc) && ($sc==0 || $sc==1)){
    $r12 = setData($con,$sql,[$sc,'sc',$dev,$m]);
   }
   echo json_encode(['msg'=>$msg]);
}else{
  echo json_encode(['msg'=>$msg]);
}

?>