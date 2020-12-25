<?php
	$siteurl= "http://localhost/cedcoss/shoptem";
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="onlineexam";
	
	// Create connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	// Check connection
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	  //echo "error";
	}
	//echo "Connected successfully";
?>
	