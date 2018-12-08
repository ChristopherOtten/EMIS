<?php 
session_start();
include("inc_connect.php");

foreach ($_POST as $key => $value) {
    if (empty($value)) {
       unset($_POST[$key]);
    }
}
if ( empty($_POST)) ){
    
    mysqli_close($MYSQLI);
        
    header('Location: nurse.php?error=Y');
    exit; 
        
     
}

$query2 = "SELECT first_name, middle_name, last_name, weight, height, age, blood_pressure, diagnosis, medications FROM patients";
//$query2 .= " WHERE " . "Doctor" . " LIKE '" . $_SESSION['nurseName']  . "' AND last_name LIKE '" . $_POST['mySelect']  . "'";
$query2 .= " WHERE " . "last_name LIKE '" . $_POST['mySelect']  . "'";
$query_result2 = mysqli_query($MYSQLI,$query2)
or die ("Invalid query: ".mysqli_error($MYSQLI));

$info = mysqli_fetch_array($query_result2);

?>


<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>EMIS - Create your account</title>
	<link rel="stylesheet" href="patient.css"/>
	<meta charset="UTF-8">
	<meta name="description" content="Medical records and Appointment scheduling">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Main Body-->
<body>
	<header>
		<h1>
			<img src="redcross.png" 
			alt="EMIS Red Cross" width="50" height="50" title="EMIS" style="text-align:center">
			<b>EMIS</b>
		</h1>
		<ul>
			<li><a href="">   </a></li>
		</ul>
	</header>
	
	<!--paragraph has a top buffer for spacing-->
	<p class="p01">Editing Medical Information for <?php echo $info['first_name']?> <?php echo $info['last_name']?>:</p>
	<p class="p02">Personal information</p>
	<div class="main"><form action="nurse.php?edit=Y" method="post"><table id="t01">
		<tr>
			<td>First Name: * <input type="text" name="fNameDE" value="<?php echo $info['first_name']?>" readonly required></td>
			<td>Middle Initial: * <input type="mname" name="mNameDE" maxlength="1" value="<?php echo $info['middle_name']?>" readonly ></td> <!---idk if we really need this, but ill leave it here for now -->
			<td>Last Name: * <input type="text" name="lNameDE" value="<?php echo $info['last_name']?>" readonly required></td>
			
		<br>
		</table>
		<br>
		<table id="t02">
		<tr>
			<td>Date of Birth: (YYYY-MM-DD) * <input type="text" name="ageDE" value="<?php echo $info['age']?>"readonly required></td>
			<td>Weight: <input type="mname" name="weightDE" value="<?php echo $info['weight']?>" required></td>
			<td>height: <input type="text" name="heightDE" value="<?php echo $info['height']?>" required></td>
			<td>Blood Pressure: <input type="text" name="bloodPDE" value="<?php echo $info['blood_pressure']?>" required></td>
		</tr>
		</table>
		<br>
		
		<br>
		*Non-editable information
		<br>
		<input type="submit" value="Update Information Entered" style="color:Black">
		<br><br>
	</form></div>
	<br>	
	
	
</body>
	
</html>
