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
if ((mysqli_query($MYSQLI, $query))) {
    header('Location: index.php');
    //close
    mysqli_close($MYSQLI);
    exit;

} else {
    header('Location: passwordRecovery.php');
    exit;
}

?>