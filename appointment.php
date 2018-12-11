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
$query = "SELECT * FROM generalUsers";
//$search_value2 = $GLOBALS['search_value']; //from index.php
$query .= " WHERE email LIKE '" . $_SESSION["email"] . "' ";
$query_result = mysqli_query($MYSQLI,$query)
or die ("Invalid query: ".mysqli_error($MYSQLI));
//make array out of query results
$row = mysqli_fetch_array($query_result);

$query7 = "SELECT * FROM appointments";
//$search_value2 = $GLOBALS['search_value']; //from index.php
$query7 .= " WHERE first_name LIKE '" . $row['firstName'] . "' AND last_name LIKE '" . $row['lastName'] . "' ";
$query_result7 = mysqli_query($MYSQLI,$query7)
or die ("Invalid query: ".mysqli_error($MYSQLI));


//echo ($row["lastName"]);
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
    <div class="row">
        <div  class="column1">
            <h1>
                <img src="redcross.png"
                     alt="EMIS Red Cross" width="50" height="50" title="EMIS" style="text-align:center">
                <b>EMIS</b>
            </h1></div>
        <div class="column2">
            <?php echo "<div id=\"demo\">  </div>";
            echo "Welcome, ".$row["firstName"];?> <button onclick='myFunction()'>Logout</button>
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
        <li><a  href="patient.php">Personal Info</a></li>
        <li><a href="medInfo.php">Medical Info</a></li>
        <li><a class="active" href="appointment.php">Appointments</a></li>
        <li><a href="#receipt">Receipts</a></li>
        <li><a href="#message">Messages</a></li>
    </ul>
</header>
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