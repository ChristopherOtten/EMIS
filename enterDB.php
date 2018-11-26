<?php 
session_start();
// If session variable is NULL, redirect to first page, otherwise continue
if ($_SESSION["viewIndex"] == NULL){
	header('Location: index.php');
	exit;
}

//open session
include("inc_connect.php");

//grab stuff from create.php
$usrName = $_REQUEST['emailC'];
$pPass = $_REQUEST['passC'];
$first = $_REQUEST['fNameC'];
$last = $_REQUEST['lNameC'];
$patient = 'Patient';
$ID = '99';
//$specialization = ' ';

//set up sql statement
$sql = "INSERT INTO generalUsers ". "(firstName, lastName, email, password, permissions, accountID)". "
VALUES ('$first', '$last', '$usrName', '$pPass', '$patient', '$ID')";

//plug into databse, if it breaks, print error
if (mysqli_query($MYSQLI, $sql)) {
    header('Location: index.php');
	
	//close
	mysqli_close($MYSQLI);
	exit;
	
} else {
    echo "Error: " . $sql . "<br>" . $MYSQLI->error;
}


?>
