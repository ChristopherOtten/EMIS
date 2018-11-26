<?php
if ($_SESSION["viewIndex"] == NULL){
	header('Location: index.php');
	exit;
}

if (!$MYSQLI) {
		$MYSQLI = mysqli_connect('10.100.118.106', 'root', 'P@$$w0rd', 'EMIS');
}

	if (!$MYSQLI) {
	   die("Connect failed");
	  
	}
	if (mysqli_connect_errno()){
		//die("Connect failed: ".mysqli_connect_errno()." : ".mysqli_connect_error());
	}
	
?>