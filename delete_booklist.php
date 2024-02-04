<?php
include ("dbconnect.php");

	$book_id = $_GET['id'];

	// script for delete
	$delete = "Delete from book_data WHERE book_id = '$book_id'";

	$result = mysqli_query($connect,$delete);

	if ($result){
		header('location:adm_booklist.php');
	}
	// if fail
	else {
		die ("Query is failed to run: " .mysqli_errno($connect). " - " .mysqli_error($connect));
	}

?>




