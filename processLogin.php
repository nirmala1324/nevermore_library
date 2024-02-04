<form method="post" name="processLogin" action="wrongPassword.php?mod=processLogin">
<?php
session_start();
	include('dbconnect.php');
	$username = $_POST["username"];
	$password = $_POST["password"];

	$regex = '/[A-Z]/';
	if (!preg_match($regex, $password)) {
		echo " must contain at least one capital letter";
	}else{ 
		if($_GET['mod']=='login'){
			$Q=mysqli_query($connect,"SELECT * FROM user WHERE username='$username' AND password='$password'");
			$r=mysqli_fetch_array($Q);
			//check data
			if(mysqli_num_rows($Q)){
			$_SESSION['username']=$r['username'];
				$_SESSION['password']=$r['password'];
				header('location:homepage.php');	
			}
			else {
			header('location:wrongPassword.php');	
			}
		}}
			// if regex }
?>
</form>	