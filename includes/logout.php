<?php
	//Destroy session variables and redirect to Login Page.
	session_start();
	$_SESSION = array();
	session_destroy();
	header('location:../index.php');
?>