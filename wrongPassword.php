<?php
echo"<script>alert('WRONG PASSWORD OR USERNAME! input correctly.')</script>";

?>

<!DOCTYPE html>
<?php
    require('dbconnect.php');

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
        </div>

        <div class="content">
            <h1>WRONG PASSWORD OR USERNAME</h1>
            <p>
                Welcome to web version of Nevermore Library! We have a lot of books<br/>
                that you can borrow, but don't forget to return it back, unless you want to get fines<br/>
                Nevermore Library located in west side of building B of Nevermore collage <br/>
            </p>
        </div>
    </div>
      <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active');
        }
      </script>
            <div>
                <button type="button" onclick="window.location.href='index.html'"><span></span>GO TO INDEX</button>
            </div>
</body>
</html>