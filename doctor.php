<?php
session_start();
	
	// If session variable is NULL, redirect to first page, otherwise continue
	if ($_SESSION["viewIndex"] == NULL){
		header('Location: index.php');
		exit;
	}
	
	//Get connection to database, prints error if one exists
	include("inc_connect.php");
	include("index.php");
	if (!$MYSQLI)
		echo "problem";
	
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
	
	//make query
	$sql_result = mysqli_query($MYSQLI,$sql)or die ("Invalid query: ".mysqli_error($MYSQLI));

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>EMIS - Personal Information</title>
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
			<li><a class="active" href="#pinfo">Personal Info</a></li>
			<li><a href="doctor.php">Appointments</a></li>
			<li><a href="#receipt">Patient List</a></li>
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
		
			while($row = mysqli_fetch_assoc($sql_result)){
				$items[] = $row;
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
			echo "Error, zero or fewer results found in database";
		}
		
	?>
		
		</div>
		</tr>
	</table>
	</div>
	<div class="button">
	<input type="submit" value="Update" style="color:BLue;margin:auto">
	</div>
	</form>
</body>

</html>