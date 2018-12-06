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

// Get the old first name, used for updating patientInfo
$query = "SELECT firstName, lastName FROM generalUsers";
$query .= " WHERE " . "email" . " LIKE '" . $_SESSION["email"] . "' ";
$query_result = mysqli_query($MYSQLI,$query)
or die ("Invalid query: ".mysqli_error($MYSQLI));
$old = mysqli_fetch_array($query_result);
$oldName = $old['firstName'];

// Update variables
$sql2 = "Update patientInfo SET first_name = '".$firstName."', middle_name= '".$middleName."', last_name= '".$lastName."', Gender= '".$gender."', address= '".$street."', city= '".$city."', state= '".$state."', zip= '".$zip."', cellphone= '".$phone."' WHERE first_name='".$oldName."' ";
$sql = "UPDATE generalUsers SET firstName= '".$firstName."' lastName= '".$lastName."' WHERE email='".$_SESSION['email']."' ";
$sql3 = "Update patients SET first_name ='".$firstName."', middle_name= '".$middleName."', last_name= '".$lastName."' WHERE first_name= '".$oldName."' ";

//plug into database, if it breaks, print error
if ((mysqli_query($MYSQLI, $sql)) && (mysqli_query($MYSQLI, $sql2)) &&(mysqli_query($MYSQLI, $sql3))) {

    header('Location: patient.php');

    //close
    mysqli_close($MYSQLI);
    exit;

} else {
    echo $sql;
    echo $sql2;
    echo $sql3;
    //header('Location: patientEdit.php?error=Ymessage='.$sql2);
    exit;
}
?>

