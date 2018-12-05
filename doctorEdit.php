<?php 
session_start();
include("inc_connect.php");



$query2 = "SELECT first_name, middle_name, last_name, weight, height, age, blood_pressure, diagnosis, medications FROM patients";
$query2 .= " WHERE " . "Doctor" . " LIKE '" . $_SESSION['doctorName']  . "' AND last_name LIKE '" . $_POST['mySelect']  . "'";
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
	<div class="main"><form action="doctor.php" method="post"><table id="t01">
		<tr>
			<td>First Name: <input type="text" name="fNameC" value="<?php echo $info['first_name']?>" readonly required></td>
			<td>Middle Initial: <input type="mname" name="mNameC" maxlength="1" value="<?php echo $info['middle_name']?>" readonly ></td> <!---idk if we really need this, but ill leave it here for now -->
			<td>Last Name: <input type="text" name="lNameC" value="<?php echo $info['last_name']?>" readonly required></td>
			<td>Gender: <br>
				<input type="radio" name="genderC" id="male" value="male"><label for="male">Male</label><br>
				<input type="radio" name="genderC" id="female" value="female"><label for="female">Female</label><br>
				<input type="radio" name="genderC" id="female" value="other"><label for="other">Other</label><br></td>
		</tr>

		<br>
		</table>
		<br>
		<table id="t02">
		<tr>
			<td>Date of Birth: (YYYY-MM-DD) <input type="text" name="ageC" value="<?php echo $info['age']?>"readonly required></td>
			<td>Weight: <input type="mname" name="weightC" value="<?php echo $info['weight']?>" required></td>
			<td>height: <input type="text" name="heightC" value="<?php echo $info['height']?>" required></td>
			<td>Blood Pressure: <input type="text" name="bloodPC" value="<?php echo $info['blood_pressure']?>" required></td>
		</tr>
		<tr>
			<td>Previous Diagnosis: <input type="text" name="diagnosisC" value="<?php echo $info['diagnosis']?>" required></td>
			<td>Medications Perscribed: <input type="text" name="medicationsC" value="<?php echo $info['medications']?>" required></td>
		</tr>
		</table>
		<br>
		
		<br>
		
		<br>
		<input type="submit" value="Update Information Entered" style="color:Black">
		<br><br>
	</form></div>
	<br>	
	
	
</body>
	
</html>
