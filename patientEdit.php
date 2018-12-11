<?php
session_start();
// If session variable is NULL, redirect to first page, otherwise continue
if ($_SESSION["viewIndex"] == NULL){
    header('Location: index.php');
    exit;
}

//Get connection to database, prints error if one exists
include("inc_connect.php");
//include("index.php");
if (!$MYSQLI)
    echo "problem";

//  Using username/email, find the user's name
$query = "SELECT firstName, lastName FROM generalUsers";
//$search_value2 = $GLOBALS['search_value']; //from index.php
$query .= " WHERE " . "email" . " LIKE '" . $_SESSION["email"] . "' ";
$query_result = mysqli_query($MYSQLI,$query)
or die ("Invalid query: ".mysqli_error($MYSQLI));
//make array out of query results
$row = mysqli_fetch_array($query_result);

    $query7 = "SELECT * FROM appointments";
    //$search_value2 = $GLOBALS['search_value']; //from index.php
    $query7 .= " WHERE first_name LIKE '" . $row['firstName'] . "' AND last_name LIKE '" . $row['lastName'] . "' ";
    $query_result7 = mysqli_query($MYSQLI,$query7)
        or die ("Invalid query: ".mysqli_error($MYSQLI));

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
    <div class="row">
        <div  class="column1">
            <h1>
                <img src="redcross.png"
                     alt="EMIS Red Cross" width="50" height="50" title="EMIS" style="text-align:center">
                <b>EMIS</b>
            </h1></div>
        <div class="column2">
            <?php echo "Welcome, ".$row["firstName"];?>
        </div>
    </div>
    <ul>
        <li><a class="active" href="patient.php">Personal Info</a></li>
        <li><a href="medInfo.php">Medical Info</a></li>
        <li><a href="appointment.php">Appointments</a></li>
        <li><a href="#receipt">Receipts</a></li>
        <li><a href="#message">Messages</a></li>
    </ul>
</header>

<!--Info-->
<p class="p01">Update your personal information</p>
<?php
//if information was incorrect, dispays error
$error=$_REQUEST['error'];
$message = $_REQUEST['message'];
if ($error == "Y"){
    echo "<div style='text-align:center'><font color='red'>Invalid Information Entered, Please Try Again</font></div>";
    echo $message;
}

?>
<?php
//if information was incorrect, dispays error
$error=$_REQUEST['error'];
if ($error == "EM"){
    echo "<div style='text-align:center'><font color='red'>Email Already Exists In Records, Please Try Another Email</font></div>";
}

?>
<div class="main"><form action="patientUpdateDB.php" method="post"><table id="t01">
            <?php
            //  Using username/email, find the user's name
            $query = "SELECT firstName, lastName FROM generalUsers";
            //$search_value2 = $GLOBALS['search_value']; //from index.php
            $query .= " WHERE " . "email" . " LIKE '" . $_SESSION["email"] . "' ";
            $query_result = mysqli_query($MYSQLI,$query)
                or die ("Invalid query: ".mysqli_error($MYSQLI));
            //make array out of query results
            $row = mysqli_fetch_array($query_result);

            //  Using the name pulled, find the other personal information
            $query2 = "SELECT middle_name, Gender, address, city, state, zip, cellphone  FROM patientInfo";
            $query2 .= " WHERE " . "first_name" . " LIKE '" . $row["firstName"] . "' ";
            $query_result2 = mysqli_query($MYSQLI,$query2)
                or die ("Invalid query: ".mysqli_error($MYSQLI));
            $row2 = mysqli_fetch_array($query_result2);

            //  Using the name pulled, get their age from the medical information
            $query3 = "SELECT age FROM patients";
            $query3 .= " WHERE " . "first_name" . " LIKE '" . $row["firstName"] . "' ";
            $query_result3 = mysqli_query($MYSQLI,$query3)
                or die ("Invalid query: ".mysqli_error($MYSQLI));
            $row3 = mysqli_fetch_array($query_result3);
            echo "<tr><td>First Name: <input type='text' name='fname' value='".$row["firstName"]."' disabled></td>";
            echo "<td>Middle Initial: <input maxlength=1 type='text' name='mname' value='".$row2["middle_name"]."' disabled> </td>";
            echo "<td>Last Name: <input type='text' name='lname' value=".$row["lastName"]." disabled></td>";
            echo "<td>Gender: <br>
                    <input type='radio' name='gender' id='male' value='male'><label for='male'>Male</label><br>
                    <input type='radio' name='gender' id='female' value='female'><label for='female'>Female</label><br>
                    <input type='radio' name='gender' id='other' value='other'><label for='other'>Other</label><br></td>
            </tr>";
            $city = $row2["city"];
            echo "<tr>
                <td>Street Address: <input type='text' name='street' value='".$row2["address"]."'required></td>
                <td>City: <input type='text' name='city' value='".$city."' required></td>
                <td>State: <input type='text' name='state' value='".$row2["state"]."' required></td>
                <td>Zip Code:  <input type='text' name='zip' maxlength=5 value='".$row2["zip"]."' required></td>
            </tr>";
            echo "<tr>
                <td>Cell #: <input type='text' name='phone' maxlength=10 value='".$row2["cellphone"]."' required></td>
                <td>Email: <input type='email' name='email' value='".$_SESSION["email"]."' disabled></td>
                <td>DOB: <input type='date' name='dob' value='".$row3["age"]."' disabled></td>
                <td></td>
            </tr>";
            ?>
        </table>
</div>
<div class="button">
    <input type="submit" value="Update" style="color:BLue;margin:auto">
</div>
</form>

    <p class="p01">Upcoming Appointments</p>
	<div class="main" style="height:300px;width:758px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;"><form action="patientEdit.html" method="post"><table id="t01">
	<?php
		//print table of all information from database
		if (mysqli_num_rows($query_result7) > 0){
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
		
			while($row7 = mysqli_fetch_assoc($query_result7)){
				$items[] = $row7;
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

<!--Footer and Address-->
<!--<div><footer><address>
    <hr>
    Happy<sup>3</sup><br>
    Erwin Herrera<br>
    Alexander Orsak<br>
    Maximilian Guzman<br>
    Christopher Otten<br>
</address></footer></div>-->
</body>

</html>