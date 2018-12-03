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


    $query = "SELECT lastName FROM generalUsers";
    //$search_value2 = $GLOBALS['search_value']; //from index.php
    $query .= " WHERE " . "email" . " LIKE '" . $_SESSION["email"] . "' ";
    $query_result = mysqli_query($MYSQLI,$query)
    or die ("Invalid query: ".mysqli_error($MYSQLI));
    //make array out of query results
    $row = mysqli_fetch_array($query_result);

    echo ($row["firstName"]);
    //sql to grab info from database 'dateTime'
    //$sql = "SELECT first_name, middle_name, last_name FROM patients" ;
    //$sql .= " WHERE Doctor LIKE 'Star'";
    //echo "$sql";
    //$sql_result = mysqli_query($MYSQLI,$sql)or die ("Invalid query: ".mysqli_error($MYSQLI));
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
			<li><a href="medInfo.html">Medical Info</a></li>
			<li><a href="#receipt">Receipts</a></li>
			<li><a href="#message">Messages</a></li>
		</ul>
	</header>
	
	<!--Info--><!--  need a way to display variables here -->
	<p class="p01">Personal Information</p>
	<div class="main"><form action="patientEdit.html" method="post"><table id="t01">
		<?php
            $search_value = $_REQUEST['email']; //from index.php
            $sql = "SELECT firstName, lastName FROM generalUsers WHERE email=" .$search_value."''";
            $result = mysqli_query($MYSQLI, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>First Name:" .$row["firstName"]."</td><td>Middle Initial: </td><td>Last Name:".$row["lastName"]."</td><td>Gender: <br></td></tr>";
                }
        }
        ?>
		<tr>
			<td>Street Address: </td>
			<td>City: </td>
			<td>State: </td>
			<td>Zip Code:  </td>
		</tr>
		<tr>
			<td>Cell #: </td>
			<td>Email: </td>
			<td>DOB: </td>
			<td></td>
		</tr>
	</table>
	</div>
	<div class="button">
	<input type="submit" value="Update" style="color:BLue;margin:auto">
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