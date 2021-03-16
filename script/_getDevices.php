<?php
header('Content-type:application/json;charset=windows-1256');
require_once("dbconnection.php");

$sql = "select * from devices";
$result = getData($con,$sql);
echo json_encode(['data'=>$result]);
?>