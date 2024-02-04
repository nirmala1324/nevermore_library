<?php
    session_start();
    include('dbconnect.php');
    $username = $_POST["username"];
    $password = $_POST["password"];

    session_start();
    
if (!isset($_SESSION['username'])){
    header("Location: youMustLogin.php");
}else{
    $uname = $_SESSION['username'];
}
/*
$regex = '/[A-Z]/';
if (!preg_match($regex, $pass)) {
echo " must contain at least one capital letter";
}else{ 
*/
if($_GET['mod']=='login_admin'){
    $Q=mysqli_query($connect,"SELECT * FROM admin WHERE username='$username' AND password ='$password'");
    $r=mysqli_fetch_array($Q);
//check data
if(mysqli_num_rows($Q)){
    $_SESSION['username']=$r['username'];
    $_SESSION['password']=$r['password'];
    header('location:Admin.php');
}
else {
    header('location:wrongPassword.php');
}
}
// if regex }

?>