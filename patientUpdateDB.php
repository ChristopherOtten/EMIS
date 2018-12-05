<?php
session_start();
// If session variable is NULL, redirect to first page, otherwise continue
if ($_SESSION["viewIndex"] == NULL){
    header('Location: index.php');
    exit;
}

//open session
include("inc_connect.php");

// Get data from form
$firstName = $_REQUEST['fname'];
$firstName = mysqli_real_escape_string($MYSQLI, $firstName);
$middleName = $_REQUEST['mname'];
$lastName = $_REQUEST['lname'];
$lastName = mysqli_real_escape_string($MYSQLI, $lastName);
$gender = $_REQUEST['gender'];
$street = $_REQUEST['street'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$zip = $_REQUEST['zip'];
$phone = $_REQUEST['phone'];
//$email = $_REQUEST['email'];
//$dob = $_REQUEST['dob'];


// Update variables
$sql = "UPDATE generalUsers SET firstName= '".$firstName."' lastName= '".$lastName."' WHERE email=";
$sql2 = "Update patientInfo SET first_name= '".$firstName."', middle_name= '".$middleName."', last_name= '".$lastName."', Gender= '".$gender."', street= '".$street."', city= '".$city."', state= '".$state."', zip= '".$zip."', phone= '".$phone."' WHERE email= '".$_SESSION["email"]."' ";

//plug into database, if it breaks, print error
if ((mysqli_query($MYSQLI, $sql)) && (mysqli_query($MYSQLI, $sql2))) {
    header('Location: patient.php');

    //close
    mysqli_close($MYSQLI);
    exit;

} else {
    header('Location: patientEdit.php?error=Y');
    exit;
}
?>

