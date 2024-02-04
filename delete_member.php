<?php
include ("dbconnect.php");
session_start();

	$username = $_GET['id'];

	// script for delete
	$deleted = "Delete from user WHERE username = '$username'";

	$result = mysqli_query($conn,$deleted);

	if ($result){
		header('location:adm_memberlist.php');
	}
	// if fail
	else {
		die ("Query is failed to run: " .mysqli_errno($conn). " - " .mysqli_error($conn));
	}

?>




