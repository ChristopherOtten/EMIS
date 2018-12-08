<?php 
session_start();
include("inc_connect.php");


	//Get names of all doctors
	$query = "SELECT firstName, lastName FROM generalUsers";
	$query .= " WHERE permissions LIKE 'Doctor' ";
	
	//create query
	$query_result = mysqli_query($MYSQLI,$query)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
	
	//make array out of query results
	$row = mysqli_fetch_array($query_result);

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
	<p class="p01">Enter your information</p>
	<?php
	//if information was incorrect, dispays error
	$error=$_REQUEST['error'];
	if ($error == "Y"){
		echo "<div style='text-align:center'><font color='red'>Invalid Information Entered, Please Try Again</font></div>";
	}

	?>
	<?php
	//if information was incorrect, dispays error
	$error=$_REQUEST['error'];
	if ($error == "EM"){
		echo "<div style='text-align:center'><font color='red'>Email Already Exists In Records, Please Try Another Email</font></div>";
	}

	?>
	<p class="p02">Personal information</p>
	<div class="main"><form action="enterDB.php" method="post"><table id="t01">
		<tr>
			<td>First Name: <input type="text" name="fNameC" required></td>
			<td>Middle Initial: <input type="mname" name="mNameC" maxlength="1"></td> <!---idk if we really need this, but ill leave it here for now -->
			<td>Last Name: <input type="text" name="lNameC" required></td>
			<td>Gender: <br>
				<input type="radio" name="genderC" id="male" value="male"><label for="male">Male</label><br>
				<input type="radio" name="genderC" id="female" value="female"><label for="female">Female</label><br>
				<input type="radio" name="genderC" id="female" value="other"><label for="other">Other</label><br></td>
		</tr>
		<tr>
			<td>Street Address: <input type="text" name="streetC" required></td>
			<td>City: <input type="text" name="cityC" required></td>
			<td>State: <input type="text" name="stateC" required></td>
			<td>Zip Code:  <input type="text" name="zipC" required maxlength="5"></td>
		</tr>
		<tr>
			<td>Cell #: <input type="text" name="phoneC" required maxlength="12"></td>
		</tr>
		<br>
		</table>
		<br>
		<table id="t02">
		<tr>
			<td>Date of Birth: (YYYY-MM-DD) <input type="text" name="ageC" required></td>
			<td>Weight: <input type="mname" name="weightC" required></td>
			<td>height: <input type="text" name="heightC" required></td>
			<td>Blood Pressure: <input type="text" name="bloodPC" required></td>
		</tr>
		<tr>
			<td>Previous Diagnosis: <input type="text" name="diagnosisC" required></td>
			<td>Medications Perscribed: <input type="text" name="medicationsC" required></td>
		</tr>
		</table>
		<br>
		<table id="t03">
		<tr>
			<td>Medical Insurance: <input type="text" name="insuranceNameC" required></td>
			<td>Medical Insurance Number: <input type="text" name="insuranceNumberC" required></td>
		</tr>
		</table>
		<br>
		<table id="t04">
		<tr>
			<td style="text-align:center">Email: <input type="text" name="emailC" required size="40"></td>
		</tr>
		<tr>
			<td style="text-align:center">Password: <input type="password" name="passC" required size="20"></td>
		</tr>
		<tr>
			<td style="text-align:center">Confirm : <input type="password" name="email" required size="20"></td>
		</tr>
		</table>
        <div class="dropdown"><form method="post"> 
  <select id="doctorSelect" name="doctorSelect" value="Selection">
  <option value="" selected disabled hidden>Select Doctor</option>
	<?php
		
			while($row = mysqli_fetch_assoc($query_result)){
				$items[] = $row;
			}
			foreach($items as $item){
			
				?>
				<option value="<?php echo $item["lastName"]?>"><?php echo "Dr. " . $item["firstName"] . " " . $item["lastName"]?>
				<?php
			}
			?>
	</select>
	<br><br>
	</form></div>
<br>
		<br>
		<input type="submit" value="Create Account" style="color:Black">
		<br><br>
	</form></div>
	<br>	
	
	
</body>
	
</html>
