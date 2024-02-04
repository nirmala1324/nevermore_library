<!DOCTYPE html>
<?php 

require('dbconnect.php');

session_start();
    
if (!isset($_SESSION['username'])){
    header("Location: youMustLogin.php");
}else{
    $uname = $_SESSION['username'];
}

$today = date('d-m-Y');

if (isset($_SESSION['data1'])) {
    $data1 = $_SESSION['data1'];
    unset($_SESSION['data1']);

    $bookidphoto = $data1['1'];
    $sql2 = "SELECT book_photo
        FROM book_data 
        WHERE book_id = '$bookidphoto' " ;
    $photo = mysqli_query($connect, $sql2) or die ("not working query");

    $borrowdate = date_create($today);
    $datereturn = date_create($data1['3']);

    $nbDays = $borrowdate->diff($datereturn);
    $dayborrow = $nbDays->days;

    if($dayborrow > 5){
        $fine = $dayborrow * 5000;
    }

    $sql3 = "SELECT book_title, book_photo
         FROM book_data
         WHERE book_id = '$bookidphoto'";
    $result3 = mysqli_query($connect, $sql3) or die ("not working query");
    $row2 = $result3 -> fetch_array();
}

$sql5 = "SELECT book_data.book_photo, book_data.book_title, return_book.book_id, return_book.borrowing_date,
               return_book.returning_date, return_book.date_of_return, return_book.fine, return_book.status
        FROM return_book 
        INNER JOIN book_data ON book_data.book_id = return_book.book_id AND username = '$uname' AND status  = 'confirmed'" ;
$result5 = mysqli_query($connect, $sql5) or die ("not working query");
$no = 1;

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
    <div class="bannerrr">
        <div class="navbar">
            <img src="never.png" class="Logo">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="booklist.php">Book List</a></li>
                <li><a href="borrowbook.php">Borrow Book</a></li>
                <li class="onpage" ><a href="returnbook.php">Return Book</a></li>
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


        <div class="centerrr">
            <h1 style="font-family: serif;">Return Book Form</h1>
            <div class="content_borrow">
                <div class="regist_field">
                    <input type="text" name="bookid" value="<?php if (isset($data1)) {
                                                                        echo $data1['1'];
                                                                    } ?>" required>
                    <label>Book ID</label>
                </div>
                <div class="regist_field">
                    <input type="text" name="username" value="<?php if (isset($data1)) {
                                                                    echo $data1['3'];}?>" required>
                    <label>Borrowing Date</label>
                </div>
                <div class="regist_field">
                    <input type="text" name="username" value="<?php if (isset($data1)) {
                                                                    echo $data1['4'];}?>" required>
                    <label>Returning Date</label>
                </div>
                <div class="regist_field" style="height: 40px; margin-top:25px" >
                    <input class="date" name="date" type="text" value="<?= $today ?>" required>
                    <label>Date of Return</label>
                </div>
                        
                                 <input class="login" name="borrow_next" onclick="openPopup()" type="submit" value="Continue">
                        
            </div>
        </div>

        <div class="borrowdata" >
            <h1 style="font-family: serif;">Return Book List</h1>
            <table class="borrowtable" style="width: 95%; text-align: center" border="1">
                <thead>
                    <th>No</th>
                    <th>Returned Book</th>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Borrowing Date</th>
                    <th>Returning Date</th>
                    <th>Date of Return</th>
                    <th>Fine</th>
                </thead>
                <tr>
                    <?php

                        foreach($result5 as $row){
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo '<td><img src="data:image;base64,'.base64_encode($row['book_photo']).'" width="100" 
                                                                                                         height="150" 
                                                                                                         border="0"/></td>';
                            echo "<td>".$row['book_id']."</td>";
                            echo "<td>".$row['book_title']."</td>";
                            echo "<td>".$row['borrowing_date']."</td>";
                            echo "<td>".$row['returning_date']."</td>";
                            echo "<td>".$row['date_of_return']."</td>";
                            echo "<td>".$row['fine']."</td>";?>
                                <?php
                                echo "</tr>";
                                $no = $no + 1;
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>

        <div class="containerPopup" id="return_form">
            <h1 style="font-family: serif;">Return Book Form</h1>
            <form action="process.php" method="POST">
                <table>
                    <tr>
                        <td style="background-color: #FFDB58;" class="bookphoto" rowspan="8" style="align-items: center;">
                                <img src="data:image;base64,<?php echo base64_encode($row2['book_photo'])?>" width="200" 
                                                                                                      height="300" 
                                                                                                      border="0"/>
                        </td>
                        <td>Book ID</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="bookid" value="<?php echo $data1['1']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class='title'>Book Title</td>
                        <td>:</td>
                        <td><textarea class="databorrow" style="width:97%; height: 30px; " readonly><?php echo $row2['book_title']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Borrowing Date</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="borrowingdate" value="<?php echo $data1['3']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Returning Date</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="returningdate" value="<?php echo $data1['4']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Date of Return</td>
                        <td>:</td>
                        <td><input class="databorrow" type="text" size="60%" name="dateofreturn" value="<?php echo $today; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Fine (rupiah)</td>
                        <td>:</td>
                        <?php
                              if($dayborrow > 5){ ?>
                                 <td><input class="databorrow" type="text" size="60%" name="fine" value="<?php echo $fine; ?>" readonly></td>
                        <?php }else{?>
                                 <td><input class="databorrow" type="text" size="60%" name="fine" value="" readonly></td>
                        <?php } ?>
                    </tr>
                </table>
                        <?php
                              if($dayborrow > 5){ ?>
                                 <p style="text-align: center; padding-top:10px; padding-bottom:10px">
                                    You are late to return the book!!</br>You must pay the fine for <?php echo $fine ?>
                                 </p>
                        <?php }else{?>
                                 <p style="text-align: center; padding-top:10px; padding-bottom:10px">
                                    You need to screenshot this site and show it to the library staff</br>
                                    along with the book you want to return
                                 </p>
                        <?php } ?>
                <input type="text" name="status" value="processed" hidden>
                <input type="number" name="borrowid" value="<?php echo $data1['0'];?>" hidden>
                <input class="login" name="return_db"  type="submit" value="Continue">
            </form>
                <button style="background-color:#FFDB58; left:38%; top:15%; margin-top:0px"class="close" name="close" onclick="closePopup()" value="Back">Back</button>
        </div>

    </div>

    <script>
        let popup = document.getElementById("return_form");

        function openPopup(){
            popup.classList.add("open-popup");
        }
        function closePopup(){
            popup.classList.remove("open-popup");
        }
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active');
        }
    </script>

</body>
</html>