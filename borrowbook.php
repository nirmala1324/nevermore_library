<!DOCTYPE html>

<?php require('dbconnect.php');

session_start();
    
if (!isset($_SESSION['username'])){
    header("Location: youMustLogin.php");
}else{
    $uname = $_SESSION['username'];
}

if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
    unset($_SESSION['data']);
}

if (isset($_POST['borrow_next'])){
    $search = $_POST['date'];
}else{
    $search = '';
}

$sql2 = "SELECT borrow_book.borrow_id, borrow_book.book_id, book_data.book_photo, book_data.book_title, borrow_book.borrowing_date, borrow_book.returning_date 
         FROM borrow_book 
         INNER JOIN book_data ON book_data.book_id = borrow_book.book_id AND username = '$uname';" ;
$result = mysqli_query($connect, $sql2) or die ("not working query");
$no = 1;

$totalData = mysqli_num_rows($result);

$today = date('d-m-Y');
$returningdate = date('d-m-Y', strtotime($today.'+5 days'));

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
        </div>
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
    
    <div class="cont">

        <div class="centerrr">
            <h1 style="font-family: serif;">Borrow Book Form</h1>
            <div class="content_borrow">
                <div class="regist_field">
                    <input type="text" name="bookid" value="<?php if (isset($data)) {
                                                                        echo $data['0'];
                                                                    } ?>" required>
                    <label>Book ID</label>
                </div>
                <div class="regist_field">
                    <input type="text" name="username" value="<?php if (isset($data)) {
                                                                    echo $uname;}?>" required>
                    <label>Username</label>
                </div>
                <div class="regist_field" style="height: 40px; margin-top:25px" >
                    <input class="date" name="date" type="text" value="<?= $today ?>" required>
                    <label>Borrowing Book Date</label>
                </div>
                <?php 
                    if(!($totalData >= 2)){?>
                        <input class="login" name="borrow_next" onclick="openPopup()" type="submit" value="Continue">
                <?php 
                    }
                    else{?>
                        <input class="login" name="borrow_next" onclick="openMaximum()" type="submit" value="Continue">
                <?php    
                    }
                ?>
                
            </div>
        </div> 

        <div class="borrowdata" >
            <h1 style="font-family: serif;">Your Borrowed Book List</h1>
            <table class="borrowtable" style="width: 95%; text-align: center" border="1">
                <thead>
                    <th>No</th>
                    <th>Borrowed Book</th>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Borrowing Date</th>
                    <th>Returning Date</th>
                    <th></th>
                </thead>
                <tr>
                    <?php

                        foreach($result as $row){
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo '<td><img src="data:image;base64,'.base64_encode($row['book_photo']).'" width="100" 
                                                                                                         height="150" 
                                                                                                         border="0"/></td>';
                            echo "<td>".$row['book_id']."</td>";
                            echo "<td>".$row['book_title']."</td>";
                            echo "<td>".$row['borrowing_date']."</td>";
                            echo "<td>".$row['returning_date']."</td>";?>
                            <form action="process.php" method="POST">
                                <td>
                                    <?php 
                                        $sqlborrow = "SELECT `book_id` FROM `return_book` WHERE `book_id` = '".$row['book_id']."'";
                                            $sql3 = mysqli_query($connect,$sqlborrow);
                                            if (mysqli_num_rows($sql3)){
                                    ?>
                                                <input type="text" name="borrowid" value="<?= $row['borrow_id']?>" hidden>
                                                <button class="borrow" style="background-color: grey;" name="return"  type="submit" disabled>Processed</button>
                                    <?php }else{?>
                                                <input type="text" name="borrowid" value="<?= $row['borrow_id']?>" hidden>
                                                <button class="borrow" name="return"  type="submit" >Return</button>
                                    <?php }?>
                                </td>
                            </form>
                                <?php
                                echo "</tr>";
                                $no = $no + 1;
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>

        <div class="containerPopup" id="popup">
            <h1 style="font-family: serif;">Borrowing Book Detail</h1>
            <form action="process.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td style="background-color: #FFDB58;" class="bookphoto" rowspan="5" style="align-items: center;"><img src="data:image;base64,<?php echo base64_encode($data['6'])?>" width="200" 
                                                                                                            height="300" 
                                                                                                            border="0"/></td>
                        <td>Book ID</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="bookid" value="<?php echo $data['0']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class='title'>Book Title</td>
                        <td>:</td>
                        <td><textarea class="databorrow" style="width:97%; height: 30px; " readonly><?php echo $data['2']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="user_name" value="<?php echo $uname; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Borrowing Date</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="borrowingdate" value="<?php echo $today; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Returning Date</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="returningdate" value="<?php echo $returningdate; ?>" readonly></td>
                    </tr>
                </table>
                <p style="text-align: center; padding-top:10px; padding-bottom:10px">
                                You need to return the book in time, unless you are fine of getting FiNes~
                </p>
                <input class="login" name="borrow_db"  type="submit" value="Continue">
            </form>
                <button style="background-color:#FFDB58; left:38%; top:15%; margin-top:0px"class="close" name="close" onclick="closePopup()" value="Back">Back</button>
            
        </div>

        <div class="containerPopup" id="return_form">
            <h1 style="font-family: serif;">Return Book Form</h1>
            <form action="process.php" method="POST">
                <table>
                    <tr>
                        <td style="background-color: #FFDB58;" class="bookphoto" rowspan="5" style="align-items: center;">
                                <img src="data:image;base64,<?php echo base64_encode($data['6'])?>" width="200" 
                                                                                                    height="300" 
                                                                                                    border="0"/>
                        </td>
                        <td>Book ID</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="bookid" value="<?php echo $data['0']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class='title'>Book Title</td>
                        <td>:</td>
                        <td><textarea class="databorrow" style="width:97%; height: 30px; " readonly><?php echo $data['2']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="user_name" value="<?php echo $uname; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Borrowing Date</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="borrowingdate" value="<?php echo $today; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Returning Date</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="returningdate" value="<?php echo $returningdate; ?>" readonly></td>
                    </tr>
                </table>
                <p style="text-align: center; padding-top:10px; padding-bottom:10px">
                                You need to return the book in time, unless you are fine of getting FiNes~
                </p>
                <input class="login" name="return_db"  type="submit" value="Continue">
            </form>
                <button style="background-color:#FFDB58; left:38%; top:15%; margin-top:0px"class="close" name="close" onclick="closePopup()" value="Back">Back</button>
            
        </div>

        <div class="containerPopup" id="maximum" style="width: 500px;">
            <h1 style="font-family: serif;">Caution</h1>
   
                <p style="text-align: center; padding-top:10px; padding-bottom:10px">
                        You reach your borrowing book limit</br>
                        You should return one of the borrowed books first :)
                </p>

                <input style="margin: 20px; width:100px; margin-left:203px; margin-top:4px" class="login" name="closeMax" onclick="closeMaximum()" type="submit" value="OK">
        </div>

    </div>

    <script>
        let popup = document.getElementById("popup");
        let maximum = document.getElementById("maximum");

        function openPopup(){
            popup.classList.add("open-popup");
        }
        function closePopup(){
            popup.classList.remove("open-popup");
        }
        function openMaximum(){
            maximum.classList.add("open-maximum");
        }
        function closeMaximum(){
            maximum.classList.remove("open-maximum");
        }
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active');
        }
    </script>

</body>
</html>