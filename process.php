<?php session_start();
include("inc_connect.php");

if (!$MYSQLI)
	echo "problem";
else echo "ok";


$query = "SELECT username, password FROM userInfo"; //change userInfo
$search_field = "username";
$search_value = $_REQUEST['username'];
$query .= " WHERE " . "username" . " LIKE '" . $search_value . "' ";

$query_result = mysqli_query($MYSQLI,$query)
	or die ("Invalid query: ".mysqli_error($MYSQLI));

$row = mysqli_fetch_array($query_result);

$pass=$_REQUEST['password'];

if ($pass == $row['password']){
	header('Location: info.php');//change info.php
	exit;
}else{
	header('Location: index.php?error=Y');
	exit;
	
}
?>