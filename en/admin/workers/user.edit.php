<?php
///edit area back end
/*
#INFINI
#By Chatson 
#2019 04 18 
*/
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = json_decode($_POST['data'],true);

//print_r($data);
$userN = $data['userName'];
$type = $data['type'];
$name = $data['name'];
$tp = $data['tp'];
$dob = $data['dob'];
$nic = $data['nic'];
//$s = $data[''];

$getIdArr = $DB->select("user","WHERE username LIKE '$userN'");
//print_r($getIdArr);
$id = $getIdArr[0]['id'];
//echo("<br>");
//validating old pass
$oldPass = $getIdArr[0]['password'];
$inputPass = md5($data['oldPass']);
$newPass = md5($data['password']);
//echo($inputPass);
if($oldPass == $inputPass){
	
	
	///edit 
	
	$conn->query("UPDATE user SET password = '$newPass', type = '2' WHERE user.id = $id;");
	$conn->query("UPDATE userdata SET name = '$name', tp = '$tp', dob = '$dob', status = '0', nic = '$nic' WHERE userdata.id = $id;");
	echo("Done");
}else{
	echo("old password is incorrect");
}
?>