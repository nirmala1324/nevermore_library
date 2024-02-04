<!DOCTYPE html>

<?php require('dbconnect.php');

session_start();
    
if (!isset($_SESSION['username'])){
    header("Location: youMustLogin.php");
}else{
    $uname = $_SESSION['username'];
}

$sqlacc = "SELECT * FROM user WHERE username = '$uname'" ;
$resultacc = mysqli_query($connect, $sqlacc) or die ("not working query");
$rowacc = $resultacc -> fetch_assoc();

?>

<html>
<head>
    <title>Nevermore Library</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <img src="never.png" class="Logo">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="booklist.php">Book List</a></li>
                <li class="onpage" ><a href="borrowbook.php">Borrow Book</a></li>
                <li><a href="returnbook.php">Return Book</a></li>
            </ul>
            <div class="action">
                <div class="profile" onclick="menuToggle()">
                    <img src="data:image;base64,<?php echo base64_encode($rowacc['profpic'])?>">
                </div>
                <div class="menu">
                    <h3><?php echo $rowacc['username']?></br></h3>
                    <form action="process.php" method="POST">
                    <ul><li><img src="exit.png"><button type="submit" style="height: 20px; background:#F75D59; padding-bottom: 30px"  name="logout">Logout</button></li></ul></form>
                </div>
            </div>
        </div>
    
      <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active');
        }
      </script>
</body>
</html>