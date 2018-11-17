<?php 
session_start();
// If session variable is NULL, redirect to first page, otherwise continue
if ($_SESSION["viewIndex"] == NULL){
	header('Location: index.php');
	exit;
}

// Call inc_connect.php to estable connection to database
include("inc_connect.php");

//Checks if error in database connection
if (!$MYSQLI)
	echo "problem";
else echo "ok";

// Establish query, search field, and search value
$query = "SELECT email, password, permissions FROM generalUsers";
$search_field = "email";
$search_value = $_REQUEST['email']; //from index.php
$query .= " WHERE " . "email" . " LIKE '" . strtolower($search_value) . "' ";

//create query, die if error
$query_result = mysqli_query($MYSQLI,$query)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
//make array out of query results
$row = mysqli_fetch_array($query_result);

// grab users password from index.php
$pass=$_REQUEST['password'];

// if password is correct redirect to specified php based on permissions
//Doctor
if (($row['permissions'] == 'Doctor') && (strtoupper($pass) == strtoupper($row['password']))){
	header('Location: doctor.php');
}

//nurse
if (($row['permissions'] == 'Nurse') && (strtoupper($pass) == strtoupper($row['password']))){
	header('Location: nurse.php');
}

//patient
if (($row['permissions'] == 'Patient') && (strtoupper($pass) == strtoupper($row['password']))){
	header('Location: patient.php');
}

//receptionist
if (($row['permissions'] == 'Receptionist') && (strtoupper($pass) == strtoupper($row['password']))){
	header('Location: receptionist.php');
}

//empty password redirect to index.php
else if (empty($pass) || empty($search_field)){
	header('Location: index.php?error=Y');
	exit;
}

//else, redirect to index.php with errors
else{
	header('Location: index.php?error=Y');
	exit;
}
?>