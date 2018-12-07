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
                <?php echo "<div id=\"demo\">  </div>";
                    echo "Welcome," ." ". $row["firstName"];?> <button onclick='myFunction()'>Logout</button>
            </div>

            <script>
                function myFunction() {
                    var txt;
                    if (confirm("Do you wish to logout?")) {
                        window.location.assign("index.php");
                        txt = "You wish to logout!";
                    } else {
                        txt = "  ";
                    }
                    document.getElementById("demo").innerHTML = txt;
                }
            </script>
        </div>
		<ul>
			<li><a class="active"  href="receptionist.php">Appointments</a></li>
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
<!--<div class="button">
<h4>Search/Filter Patients:</h4>
*Can only view those associated with you<br>
Click on the button to open the dropdown menu.<br>
Use the input field to search for a specific dropdown link.<br>

<div class="dropdown"><form action="doctorEdit.php" method="post"> 
  <select id="mySelect" name="mySelect" value="Selection">
  <option value="" selected disabled hidden>Select Patient</option>
	<?php/*
		
			while($row3 = mysqli_fetch_assoc($query_result2)){
				$items2[] = $row3;
			}
			//echo("$items1");
			foreach($items2 as $item){
			
				?>
				<option value="<?php echo $item["last_name"]?>"><?php echo $item["first_name"] . " " . $item["last_name"]?>
				<?php
			}*/
			?>
	</select>
	<input type="submit" value="Edit This Patients Info" style="color:BLue">
	<br><br>
	</form></div>
<br>

<div class="appointments"><form action="appMaker.php" method="post">
	Date: <input type="date" name="dateD" id="dateD" required>
	Time: <input type="time" name="timeD" id="timeD" required><br>
	Reason For Visit: <input type="text" name="visitD" id="visitD" required><br>
	Patients Name:<br>
	First Name: <input type="text" name="firstD" id="firstD" required><br>
	Middle Initial: <input type="text" name="middleD" id="middleD" maxlength="1" required><br>
	Last Name: <input type="text" name="lastD" id="lastD" required><br>
	<input type="submit" value="Create Appointment" style="color:BLue">
		<br><br>
</form></div>
-->






</div>
</body>

</html>
