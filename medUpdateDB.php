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
$weight = $_REQUEST['weightM'];
$height = $_REQUEST['heightM'];
$height = mysqli_real_escape_string($MYSQLI, $height);
$bp = $_REQUEST['bpM'];
$dia = $_REQUEST['diaM'];
$med = $_REQUEST['medM'];

// Get the old first name, used for updating patientInfo
$query = "SELECT firstName, lastName FROM generalUsers";
$query .= " WHERE " . "email" . " LIKE '" . $_SESSION["email"] . "' ";
$query_result = mysqli_query($MYSQLI,$query)
or die ("Invalid query: ".mysqli_error($MYSQLI));
$old = mysqli_fetch_array($query_result);
$oldName = $old['firstName'];
$oldLastName = $old['lastName'];

// Update variables
$sql = "Update patients SET weight= '".$weight."', height= '".$height."', blood_pressure= '".$bp."', diagnosis= '".$dia."', medications= '".$med."' WHERE first_name='".$oldName."' ";

//plug into database, if it breaks, print error
if ((mysqli_query($MYSQLI, $sql))) {
    header('Location: medInfo.php');
    //close
    mysqli_close($MYSQLI);
    exit;

} else {
    header('Location: medInfoEdit.php?error=Y');
    exit;
}
?>

