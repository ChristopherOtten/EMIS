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

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>EMIS - Medical Information</title>
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
        <li><a href="patient.php">Personal Info</a></li>
        <li><a class="active" href="medInfo.php">Medical Info</a></li>
        <li><a href="#receipt">Receipts</a></li>
        <li><a href="#message">Messages</a></li>
    </ul>
</header>

<!--Info-->
<p class="p01">Update your medical information</p>
<?php
//if information was incorrect, dispays error
$error=$_REQUEST['error'];
$message = $_REQUEST['message'];
if ($error == "Y"){
    echo "<div style='text-align:center'><font color='red'>Invalid Information Entered, Please Try Again</font></div>";
    echo $message;
}

?>

<div class="main"><form action="medUpdateDB.php" method="post"><table id="t01">
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
            $query2 = "SELECT middle_name, Gender FROM patientInfo";
            $query2 .= " WHERE " . "first_name" . " LIKE '" . $row["firstName"] . "' ";
            $query_result2 = mysqli_query($MYSQLI,$query2)
            or die ("Invalid query: ".mysqli_error($MYSQLI));
            $row2 = mysqli_fetch_array($query_result2);

            //  Using the name pulled, get their age from the medical information
            $query3 = "SELECT age, weight, height, blood_pressure, diagnosis, medications, Doctor FROM patients";
            $query3 .= " WHERE " . "first_name" . " LIKE '" . $row["firstName"] . "' ";
            $query_result3 = mysqli_query($MYSQLI,$query3)
            or die ("Invalid query: ".mysqli_error($MYSQLI));
            $row3 = mysqli_fetch_array($query_result3);
            echo "<tr><td>First Name: <input type='text' name='fnameM' value='".$row["firstName"]."' disabled></td>";
            echo "<td>Middle Initial: <input maxlength=1 type='text' name='mnameM' value='".$row2["middle_name"]."' disabled> </td>";
            echo "<td>Last Name: <input type='text' name='lnameM' value=".$row["lastName"]." disabled></td>";
            echo "<td>Gender: <br>
                    <input type='radio' name='gender' id='male' value='male' disabled><label for='male'>Male</label><br>
                    <input type='radio' name='gender' id='female' value='female' disabled><label for='female'>Female</label><br>
                    <input type='radio' name='gender' id='other' value='other' disabled><label for='other'>Other</label><br></td>
            </tr>";
            echo "<tr>
                <td>Age: <input type='date' name='ageM' value='".$row3["age"]."' disabled></td>
                <td>Weight<input type='text' name='weightM' value='".$row3["weight"]."'required></td>
                <td>Height: <input type='text' name='heightM' value='".$row3["height"]."' required></td>
                <td>Blood Pressure: <input type='text' name='bpM' value='".$row3["blood_pressure"]."' required></td></tr>";
            echo "<tr>
                <td>Recent Diagnosis: <input type='text' name='diadM' value='".$row3["diagnosis"]."' required></td>
                <td>Treatment/Medications: <input type='text' name='medM' value='".$row3["medications"]."' required></td>
                <td>Doctor: <input type='text' name='docM' value='".$row3["Doctor"]."' required></td>
            </tr>";
            ?>
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