<?php
session_start();
	
	// If session variable is NULL, redirect to first page, otherwise continue
	if ($_SESSION["viewIndex"] == NULL){
		header('Location: index.php');
		exit;
	}
	
	//Get connection to database, prints error if one exists
	include("inc_connect.php");
	if (!$MYSQLI)
		echo "problem";
	
	
	$edit=$_REQUEST['edit'];
	if ($edit == "Y"){ 
	
	$first = $_REQUEST['fNameDE'];
	$first = mysqli_real_escape_string($MYSQLI, $first);
	$last = $_REQUEST['lNameDE'];
	$last = mysqli_real_escape_string($MYSQLI, $last);
	$middle = $_REQUEST['mNameDE'];
	$weight = $_REQUEST['weightDE'];
	$age = $_REQUEST['ageDE'];
	$height = $_REQUEST['heightDE'];
	$height = mysqli_real_escape_string($MYSQLI, $height);
	$bloodP = $_REQUEST['bloodPDE'];
	$diag = $_REQUEST['diagnosisDE'];
	$diag = mysqli_real_escape_string($MYSQLI, $diag);
	$meds = $_REQUEST['medicationsDE'];
	$meds = mysqli_real_escape_string($MYSQLI, $meds);
	
	//UPDATE Customers SET ContactName='Alfred Schmidt', City='Frankfurt' WHERE CustomerID=1;
	
	$sql_update = "UPDATE patients SET weight='" . $weight . "',  height='" . $height . "', blood_pressure='" . $bloodP . "', diagnosis='" . $diag . "', medications='" . $meds . "' WHERE first_name='" . $first . "' AND last_name='" . $last . "' ";
	
	$update = mysqli_query($MYSQLI,$sql_update)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
	
	if (mysqli_query($MYSQLI, $update)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
	
	}
	
	//Get last name of doctor who logged in
	$query = "SELECT lastName FROM generalUsers";
	$query .= " WHERE " . "email" . " LIKE '" . $_SESSION["email"] . "' ";
	
	//create query
	$query_result = mysqli_query($MYSQLI,$query)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
	
	//make array out of query results
	$row = mysqli_fetch_array($query_result);
	
	//sql to grab first, middle, last names of patients associated w/ doctor who logged in
	$sql = "SELECT first_name, middle_name, last_name, Date, Time, ReasonForVisit FROM appointments" ;
	$sql .= " WHERE " . "Doctor" . " LIKE '" . $row['lastName'] . "' ";
	
	$_SESSION['doctorName'] = $row['lastName'];
	
	//make query
	$sql_result = mysqli_query($MYSQLI,$sql)or die ("Invalid query: ".mysqli_error($MYSQLI));
	
	$query2 = "SELECT first_name, last_name, weight, age, blood_pressure, diagnosis, medications FROM patients";
	$query2 .= " WHERE " . "Doctor" . " LIKE '" . $row['lastName'] . "' ";
	$query_result2 = mysqli_query($MYSQLI,$query2)
	or die ("Invalid query: ".mysqli_error($MYSQLI));
	//$row2 = mysqli_fetch_array($query_result2);

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>EMIS - Personal Information</title>
	<link rel="stylesheet" href="patient.css"/>
	<meta charset="UTF-8">
	<meta name="description" content="Medical records and Appointment scheduling">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<!-- Main Body-->
<body>
	<header>
        <div class="row">
            <div  class="column1">
                <h1>
                    <img src="redcross.png"
                         alt="EMIS Red Cross" width="50" height="50" title="EMIS" style="text-align:center">
                    <b>EMIS</b>
                </h1></div>
            <div class="column2">
                <?php echo "Welcome, Dr." ." ". $row["lastName"]?>
            </div>
        </div>
		<ul>
			<li><a class="active"  href="doctor.php">Appointments</a></li>
			<li><a href="#Patient_list">Patient List</a></li>
			<li><a href="#message">Messages</a></li>
		</ul>
	</header>
	
	<p class="p01">Upcoming Appointments</p>
	<div class="main" style="height:300px;width:758px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;"><form action="patientEdit.html" method="post"><table id="t01">
	<?php
		//print table of all information from database
		if (mysqli_num_rows($sql_result) > 0){
		?>
		
			<table border="2" align="center">
			<tbody>
			<tr>
			<td>First name</td>
			<td>Middle name</td>
			<td>Last name</td>
			<td>Date</td>
			<td>Time</td>
			<td>ReasonForVisit</td>
			</tr>
		
			<?php
		
			while($row2 = mysqli_fetch_assoc($sql_result)){
				$items[] = $row2;
			}
			
			foreach($items as $item){
			
				?>
				<tr>
				<td><?php echo $item["first_name"]?></td>
				<td><?php echo $item["middle_name"]?></td>
				<td><?php echo $item["last_name"]?></td>
				<td><?php echo $item["Date"]?></td>
				<td><?php echo $item["Time"]?></td>
				<td><?php echo $item["ReasonForVisit"]?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
			</table>
		<?php
		
		}
		else{
			echo "No upcoming appointments on record.";
		}
		
	?>
		
		</div>
		</tr>
	</table>
	</div>
	</form>
<div class="button">
<h4>Search/Filter Patients:</h4>
*Can only view those associated with you<br>
Click on the button to open the dropdown menu.<br>
Use the input field to search for a specific dropdown link.<br>

<div class="dropdown"><form action="doctorEdit.php" method="post"> 
  <select id="mySelect" name="mySelect" value="Selection">
  <option value="" selected disabled hidden>Select Patient</option>
	<?php
		
			while($row3 = mysqli_fetch_assoc($query_result2)){
				$items2[] = $row3;
			}
			//echo("$items1");
			foreach($items2 as $item){
			
				?>
				<option value="<?php echo $item["last_name"]?>"><?php echo $item["first_name"] . " " . $item["last_name"]?>
				<?php
			}
			?>
	</select>
	<input type="submit" value="Edit This Patients Info" style="color:BLue">
	<br><br>
	</form></div>
<br><br><br>

<?php
	if ($edit == "Y"){ ?>
		Patient medical information successfuly updated
	<?php }
?>





</div>
</body>

</html>
