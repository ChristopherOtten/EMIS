<?php

include("inc_connect.php");
if (!$MYSQLI)
	echo "problem";


$first = $_REQUEST['firstD'];
$first = mysqli_real_escape_string($MYSQLI, $first);
$last = $_REQUEST['lastD'];
$last = mysqli_real_escape_string($MYSQLI, $last);
$middle = $_REQUEST['middleD'];
$reason = $_REQUEST['visitD'];
$date = $_REQUEST['dateD'];
$time = $_REQUEST['timeD'];


$sql = "INSERT INTO appointments". "(Date, Time, Doctor, ReasonForVisit, first_name, middle_name, last_name)". "
VALUES ('$date', '$time', '$_SESSION['doctorName']', '$reason', '$first', '$middle', '$last')";

if (mysqli_query($MYSQLI, $sql)){
	
	//close
	mysqli_close($MYSQLI);
	exit;
	
} else {
    header('Location: doctor.php?error=Y');
	exit;
}












?>