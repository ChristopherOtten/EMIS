<?php
session_start();

    // If session variable is NULL, redirect to first page, otherwise continue
    if ($_SESSION["viewIndex"] == NULL){
        header('Location: index.php');
        exit;
    }

include("inc_connect.php");
if (!$MYSQLI)
	echo "problem";

$query = "SELECT permissions FROM generalUsers";

$query .= " WHERE " . "email" . " LIKE '" . $_SESSION['email'] . "' ";

//create query, die if error
$query_result = mysqli_query($MYSQLI,$query)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
//make array out of query results
$row = mysqli_fetch_array($query_result);

$first = $_REQUEST['firstD'];
$first = mysqli_real_escape_string($MYSQLI, $first);
$last = $_REQUEST['lastD'];
$last = mysqli_real_escape_string($MYSQLI, $last);
$middle = $_REQUEST['middleD'];
$reason = $_REQUEST['visitD'];
$date = $_REQUEST['dateD'];
$time = $_REQUEST['timeD'];

$query2 = "SELECT Doctor FROM patients";
$query2 .= " WHERE first_name LIKE '" . $first . "' AND middle_name LIKE '" . $middle . "' AND last_name LIKE '" . $last . "' ";
$query_result2 = mysqli_query($MYSQLI,$query2)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
$row2 = mysqli_fetch_array($query_result2);

$thisDoctor = $_SESSION['doctorName'];

if ($row['permissions'] == 'Receptionist'){
    
    $thisDoctor = $row2['Doctor'];
    
}

foreach ($row2 as $key => $value) {
    if (empty($value)) {
       unset($row2[$key]);
    }
}
if ( empty($row2) ){
    
    mysqli_close($MYSQLI);
    if ($row['permissions'] == 'Receptionist'){
        
        header('Location: receptionist.php?error=Y');
        exit; 
        
    } else if ( $row['permissions'] == 'Doctor' ){
        
        header('Location: doctor.php?error=Y');
        exit; 
        
    } else {
        
        //close
        header('Location: index.php?error=Y');
        exit;
        
    }
     
}

if ( empty( $thisDoctor ) ){
    
    mysqli_close($MYSQLI);
    if ($row['permissions'] == 'Receptionist'){
        
        header('Location: receptionist.php?error=Y');
        exit; 
        
    } else if ( $row['permissions'] == 'Doctor' ){
        
        header('Location: doctor.php?error=Y');
        exit; 
        
    } else {
        
        //close
        header('Location: index.php?error=Y');
        exit;
        
    }  
    
}

$sql = "INSERT INTO appointments". "(Date, Time, Doctor, ReasonForVisit, first_name, middle_name, last_name)". "
VALUES ('$date', '$time', '" . $thisDoctor . "', '$reason', '$first', '$middle', '$last')";

if (mysqli_query($MYSQLI, $sql)){
    
    mysqli_close($MYSQLI);
    
    if ($row['permissions'] == 'Receptionist'){
        //close
        header('Location: receptionist.php');
        exit;
	
    } else if ( $row['permissions'] == 'Doctor' ){
        //close
        header('Location: doctor.php');
        exit;
    
    } else{
        //close
        header('Location: index.php?error=Y');
        exit;    
    }
	
} else {
    
    if ($row['permissions'] == 'Receptionist'){
        //close
        header('Location: receptionist.php?error=Y');
        exit;
	
    } else if ( $row['permissions'] == 'Doctor' ){
        //close
        header('Location: doctor.php?error=Y');
        exit;
    
    } else{
        //close
        header('Location: index.php?error=Y');
        exit;
        
    }
}












?>