<?php
header('Content-type:application/json;charset=windows-1256');
session_start();
$username =$_REQUEST['username'];
$password =$_REQUEST['password'];

if(empty($username) || empty($password)){
  $msg = "All Fields are required";
}else{
  require_once("dbconnection.php");
  $sql = "select * from users where username = ? and password = ?";
  $result = getData($con,$sql,[$username,$password]);
  if(count($result) != 1){
    $msg = "Incorrect Password or Uesrname";
  }else{
    $msg = 1;
    $_SESSION['login']=1;
    $_SESSION['username']=$result[0]['username'];
    $_SESSION['userid']=$result[0]['user_id'];
    $_SESSION['periv']=$result[0]['periv'];
  }
}
echo json_encode(['msg'=>$msg,"sql"=>$username]);
?>