<?php
include ("dbconnect.php");

	$borrow_id = $_GET['id'];

	// script for delete
	$delete = "Delete from borrow_book WHERE borrow_id = '$borrow_id'";

	$result = mysqli_query($connect,$delete);

	if ($result){
		header('location:adm_borrowbook.php');
	}
	// if fail
	else {
		die ("Query is failed to run: " .mysqli_errno($connect). " - " .mysqli_error($connect));
	}

?>




