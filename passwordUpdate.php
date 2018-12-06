<?php
session_start();
// If session variable is NULL, redirect to first page, otherwise continue
if ($_SESSION["viewIndex"] == NULL){
    header('Location: index.php');
    exit;
}

//open session
include("inc_connect.php");

$fNameCheck = $_REQUEST['fNameCheck'];
$lNameCheck = $_REQUEST['fNameCheck'];
$emailCheck = $_REQUEST['emailCheck'];
$new1 = $_REQUEST['passwordN1'];
$new2 = $_REQUEST['passwordN2'];

$query = "SELECT firstName, lastName FROM generalUsers";
$query .= " WHERE " . "email" . " LIKE '" . $emailCheck . "' ";
$query_result = mysqli_query($MYSQLI,$query)
    or die ("Invalid query: ".mysqli_error($MYSQLI));
$nameCheck = mysqli_fetch_array($query_result);

if($nameCheck['firstName'] == $fNameCheck && $nameCheck['lastName'] == $lNameCheck){
    echo "names match";
}else{
    header('Location: passwordRecovery.php');
}

?>