<?php

include('dbconnect.php');

$borrow_id=$_GET['id1'];
$username=$_GET['id2'];

$sql="UPDATE `return_book` SET `status`='confirmed' WHERE borrow_id = '$borrow_id'"; 
$result=$connect->query($sql);

header("Location: adm_returnbook.php");
?>
