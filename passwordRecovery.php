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
?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <title>EMIS - Password recovery</title>
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

            </div>
        </div>
        <ul>
            <li><a class="active" href="patient.php">Personal Info</a></li>
            <li><a href="medInfo.php">Medical Info</a></li>
            <li><a href="#receipt">Receipts</a></li>
            <li><a href="#message">Messages</a></li>
        </ul>
    </header>

    <!--Info-->
    <p class="p01">Verify your account credentials</p>
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
            echo "<div style='text-align:center'><font color='red'>Email does not match</font></div>";
        }
    ?>
    <div class="main"><form action="passwordUpdate.php" method="post"><table id="t01">
                <div style="text-align: center">
                <tr>
                    <td>First Name: <input type="text" name="fName" required></td>
                    <td>Last Name : <input type="text" name="lName" required></td>
                </tr>
                <tr>
                    <td colspan="2">User Email: <input type="text" name="email" required size="40"></td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="2">Enter a new Password:<input type="password" name="passwordN1" required></td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="2">Reenter new password:<input type="password" name="passwordN2" required></td>
                </tr>
                </div>
            </table></div>
            <div class="button">
                <input type="submit" value="Update" style="color:BLue">
            </div>
</body>
</html>
