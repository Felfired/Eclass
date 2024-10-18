<?php
	//Create connection variable.
	error_reporting(0);
	$conn = new mysqli('localhost', 'root', '');

	//Check connection.
	if ($conn->connect_error) 
	{
		die ("Connection failed: " . $conn->connect_error);
	}

	//Select database.
	mysqli_select_db($conn, 'eclass_db');
?>