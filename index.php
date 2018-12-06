<?php 
session_start();
//opens session, sets session variable to true (prevents skipping login section)
$_SESSION["viewIndex"] = true;


?>


<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>EMIS - Login</title>
	<link rel="stylesheet" href="base.css"/>
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
	
	<!--Login form-->
	<p class="p01">Welcome to the Electronic Medical Information System</p>
	<div class="main"><form action="process.php" method="post">
		<br>
        <div style="position:center;text-align: right">
            E-mail: <input type="text" name="email" id="email" required><br><br>
		    Password: <input type="password" name="password" id="password" required><br>
        </div>
		<div class="fpassword">
		<a href="error.html">forgot password?</a>
		<a href="create.php">Create an account</a>
		</div>
		<input type="submit" value="Enter" style="color:BLue">
		<br><br>
	</form></div>

<?php
//if information was incorrect, dispays error
$error=$_REQUEST['error'];
if ($error == "Y"){
	//echo "<font color='red'>Incorrect Information Entered</font>";
    echo "<div style='text-align:center'><font color='red'>Incorrect Information Entered</font></div>";
}

?>
	
	<!--Footer and Address, need to fix so it sticks in the bottom middle-->
	<!--<div><footer><address><hr>Happy<sup>3</sup><br>Erwin Herrera<br>Alexander Orsak<br>Maximilian Guzman<br>Christopher Otten<br></address></footer></div>-->
</body>

</html>
