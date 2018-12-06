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

if($nameCheck['firstName'] == $fNameCheck){
    if ($nameCheck['lastName'] == $lNameCheck){
        if($new1 == $new2) {
            $sql = "Update generalUsers SET password='" . $new1 . "'";
        } else{
            header('Location: passwordRecovery.php?error=P?message='.$query);
        }
    }else{
        header('Location: passwordRecovery.php?error=E?message='.$query);
    }
}else{
    header('Location: passwordRecovery.php?error=E?message='.$query);
}

?>