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

$middle = $_REQUEST['mNameC'];
$weight = $_REQUEST['weightC'];
$age = $_REQUEST['ageC'];
$height = $_REQUEST['heightC'];
$bloodP = $_REQUEST['bloodPC'];
$diag = $_REQUEST['diagnosisC'];
$meds = $_REQUEST['medicationsC'];
$doctor = ' ';

//set up sql statement
$sql = "INSERT INTO generalUsers ". "(firstName, lastName, email, password, permissions, accountID)". "
VALUES ('$first', '$last', '$usrName', '$pPass', '$patient', '$ID')";

$sql2 = "INSERT INTO patients ". "(first_name, middle_name, last_name, weight, height, age, blood_pressure, diagnosis, medications, Doctor)". "
VALUE ('$first', '$middle', '$last', '$weight', '$height', '$weight', '$age', '$bloodP', '$diag', '$meds', '$doctor')";

//plug into databse, if it breaks, print error
if (mysqli_query($MYSQLI, $sql) && mysqli_query($MYSQLI, $sql2)) {
    header('Location: index.php');
	
	//close
	mysqli_close($MYSQLI);
	exit;
	
} else {
    echo "Error: " . $sql . "<br>" . $MYSQLI->error;
}


?>
