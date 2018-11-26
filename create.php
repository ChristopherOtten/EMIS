<?php 
session_start();
include("inc_connect.php");
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
		</h1><hr>
		<ul>
			<li><a href="">   </a></li>
		</ul>
	</header>
	
	<!--paragraph has a top buffer for spacing-->
	<p class="p01">Enter your information</p>
	<p class="p02">Personal information</p>
	<div class="main"><form action="enterDB.php" method="post"><table id="t01">
		<tr>
			<td>First Name: <input type="text" name="fNameC" required></td>
			<td>Middle Initial: <input type="mname" name="mname" maxlength="1"></td> <!---idk if we really need this, but ill leave it here for now -->
			<td>Last Name: <input type="text" name="lNameC" required></td>
			<td>Gender: <br>
				<input type="radio" name="gender" id="male" value="male"><label for="male">Male</label><br>
				<input type="radio" name="gender" id="female" value="female"><label for="female">Female</label><br>
				<input type="radio" name="gender" id="female" value="female"><label for="other">Other</label><br></td>
		</tr>
		<tr>
			<td>Street Address: <input type="text" name="street" required></td>
			<td>City: <input type="text" name="city" required></td>
			<td>State: <input type="text" name="state" required></td>
			<td>Zip Code:  <input type="text" name="zip" required maxlength="5"></td>
		</tr>
		<tr>
			<td>Cell #: <input type="text" name="phone" required maxlength="10"></td>
		</tr>
		<br>
		</table>
		<br>
		<table id="t02">
		<tr>
			<td>Age: <input type="text" name="age" required></td>
			<td>Weight: <input type="mname" name="weight" required></td>
			<td>height: <input type="text" name="height" required></td>
			<td>Blood Pressure: <input type="text" name="bloodP" required></td>
		</tr>
		<tr>
			<td>Previous Diagnosis: <input type="text" name="diagnosis" required></td>
			<td>Medications Perscribed: <input type="text" name="medications" required></td>
		</tr>
		</table>
		<br>
		<table id="t03">
		<tr>
			<td>Medical Insurance: <input type="text" name="insuranceName" required></td>
			<td>Medical Insurance Number: <input type="text" name="insuranceNumber" required></td>
		</tr>
		</table>
		<br>
		<table id="t04">
		<tr>
			<td style="text-align:center">Email: <input type="text" name="emailC" required size="40"></td>
		</tr>
		<tr>
			<td style="text-align:center">Password: <input type="text" name="passC" required size="20"></td>
		</tr>
		<tr>
			<td style="text-align:center">Confirm : <input type="text" name="email" required size="20"></td>
		</tr>
		</table>
		<br>
		<input type="submit" value="Create Account" style="color:Black">
		<br><br>
	</form></div>
	<br>
	
	
	
</body>
	
</html>
