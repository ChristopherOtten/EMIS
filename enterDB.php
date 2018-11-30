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
$first = mysqli_real_escape_string($MYSQLI, $first);
$last = $_REQUEST['lNameC'];
$last = mysqli_real_escape_string($MYSQLI, $last);
$patient = 'Patient';
$ID = '99';
//$specialization = ' ';

$middle = $_REQUEST['mNameC'];
$weight = $_REQUEST['weightC'];
$age = $_REQUEST['ageC'];
$height = $_REQUEST['heightC'];
$height = mysqli_real_escape_string($MYSQLI, $height);

$bloodP = $_REQUEST['bloodPC'];
$diag = $_REQUEST['diagnosisC'];
$diag = mysqli_real_escape_string($MYSQLI, $diag);
$meds = $_REQUEST['medicationsC'];
$meds = mysqli_real_escape_string($MYSQLI, $meds);
$doctor = ' ';
$gender = $_REQUEST['genderC'];
$street = $_REQUEST['streetC'];
$street = mysqli_real_escape_string($MYSQLI, $street);
$city = $_REQUEST['cityC'];
$city = mysqli_real_escape_string($MYSQLI, $city);
$state = $_REQUEST['stateC'];
$zip = $_REQUEST['zipC'];
$cell = $_REQUEST['phoneC'];
$providerIns = $_REQUEST['insuranceNameC'];//look into php prepared statements
$providerIns = mysqli_real_escape_string($MYSQLI, $providerIns);
$numberIns = $_REQUEST['insuranceNumberC'];

//set up sql statement
$sql = "INSERT INTO generalUsers ". "(firstName, lastName, email, password, permissions, accountID)". "
VALUES ('$first', '$last', '$usrName', '$pPass', '$patient', '$ID')";

$sql2 = "INSERT INTO patients ". "(first_name, middle_name, last_name, Gender, weight, height, age, blood_pressure, diagnosis, medications, Doctor)". "
VALUE ('$first', '$middle', '$last', '$gender', '$weight', '$height', '$age', '$bloodP', '$diag', '$meds', '$doctor')";

$sql3 = "INSERT INTO patientInfo ". "(first_name, middle_name, last_name, Gender, address, city, state, zip, cellphone, insurance_provider, insurance_number)". "
VALUE ('$first', '$middle', '$last', '$gender', '$street', '$city', '$state', '$zip', '$cell', '$providerIns', '$numberIns')";

//plug into databse, if it breaks, print error
if ((mysqli_query($MYSQLI, $sql)) && (mysqli_query($MYSQLI, $sql2))  && (mysqli_query($MYSQLI, $sql3))) {
    header('Location: index.php');
	
	//close
	mysqli_close($MYSQLI);
	exit;
	
} else {
    echo "Error: " . $sql . "<br>" . $MYSQLI->error;
}


?>
