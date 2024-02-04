<!DOCTYPE html>

<?php 

require('dbconnect.php');

session_start();
    
if (!isset($_SESSION['username'])){
    header("Location: youMustLogin.php");
}else{
    $uname = $_SESSION['username'];
}

if (isset($_POST['searchButton'])){
    $search = $_POST['search'];
}else{
    $search = '';
}

$sql = "SELECT * FROM book_data WHERE book_id LIKE '%$search%' OR book_title LIKE '%$search%' ORDER BY book_title";
$resultt = mysqli_query($connect, $sql) or die ("not working query");

$sqlAcaa = "SELECT * FROM academic WHERE book_id LIKE '%$search%' OR book_title LIKE '%$search%' ORDER BY book_title";
$resulttAca = mysqli_query($connect, $sqlAcaa) or die ("not working query");

//Configuring Pagination

$jumlahData = 5;                                    
$totalData = mysqli_num_rows($resultt);
$totalPagination = ceil($totalData / $jumlahData);  //Ceil = hasil dibulatkan ke atas

$totalDataAca = mysqli_num_rows($resulttAca);
$totalPaginationAca = ceil($totalDataAca / $jumlahData);  //Ceil = hasil dibulatkan ke atas

if(isset($_GET['page'])){
    $activePage = $_GET['page'];
}else{
    $activePage = 1;
}

    if(isset($_GET['category'])){
        $category = $_GET['category'];
    }else{
        $category = 1;
    }



$dataStartAll = ($activePage * $jumlahData) - $jumlahData;
$dataStartAca = ($category * $jumlahData) - $jumlahData;

//end

$sql2 = "SELECT * FROM book_data WHERE book_id LIKE '%$search%' OR book_title LIKE '%$search%' ORDER BY book_title LIMIT $dataStartAll,$jumlahData " ;
$result = mysqli_query($connect, $sql2) or die ("not working query");

$sqlAca = "SELECT * FROM academic WHERE book_id LIKE '%$search%' OR book_title LIKE '%$search%' ORDER BY book_title LIMIT $dataStartAca,$jumlahData" ;
$resultAca = mysqli_query($connect, $sqlAca) or die ("not working query");

$sqlEnter = "SELECT * FROM entertaining WHERE book_id LIKE '%$search%' OR book_title LIKE '%$search%' ORDER BY book_title " ;
$resultEnter = mysqli_query($connect, $sqlEnter) or die ("not working query");

$sqlNov = "SELECT * FROM novel WHERE book_id LIKE '%$search%' OR book_title LIKE '%$search%' ORDER BY book_title" ;
$resultNov = mysqli_query($connect, $sqlNov) or die ("not working query");

$noAll = 1 + $dataStartAll;
$noAca = 1 + $dataStartAca;

$sqlacc = "SELECT * FROM user WHERE username = '$uname'" ;
$resultacc = mysqli_query($connect, $sqlacc) or die ("not working query");
$rowacc = $resultacc -> fetch_assoc();

?>


<html>

<head>
    <title>Nevermore Library</title>
    <link rel="stylesheet" href="styling.css">
</head>

<body style="align-items: center;">

    <div class="bannerr">
        <div class="navbar">
            <img src="never.png" class="Logo">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li class="onpage" ><a href="booklist.php">Book List</a></li>
                <li><a href="borrowbook.php">Borrow Book</a></li>
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
            <main class="table">
                <section class="theHeader">
                    <h1>Nevermore Library Book List</h1>
                    <form  method="POST" action="booklist.php">
                       <div class="input-group">
                         <input name="search" type="search" placeholder="Search" autofocus value="<?php echo $search ?>">
                         <input type="submit" name="searchButton" class="search" value="Search">
                       </div>
                    </form>
                </section>
                <section class="pagination" style="padding-top: 0px;">
                <form action="booklist.php" method="POST">
                    <ul class="page" style="padding-top: 0px; padding-bottom:0px">
                        <button type="submit" style="width: 80px; background:#F6BE00" name="all">All</button>
                        <button type="submit" style="width: 90px; background:#F6BE00" name="academic">Academic</button>
                        <button type="submit" style="width: 100px; background:#F6BE00" name="entertaining">Entertaining</button>
                        <button type="submit" style="width: 80px; background:#F6BE00" name="novel">Novel</button>
                    </ul>
                </form>
                </section>
                <section class="theBody">
                    <table style="text-align: center; font-size:15px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Book ID</th>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Released Year</th>
                                <th>Book Synopsis</th>
                                <th>Book Cover</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_POST['academic'])){
                                foreach($resultAca as $row2){
                                    echo "<tr>";
                                    echo "<td>".$noAca."</td>";
                                    echo "<td>".$row2['book_id']."</td>";
                                    echo "<td><b>".$row2['book_title']."</b></td>";
                                    echo "<td>".$row2['book_author']."</td>";
                                    echo "<td>".$row2['released_year']."</td>";
                                    echo "<td>".$row2['book_synopsis']."</td>";
                                    echo '<td><img src="data:image;base64,'.base64_encode($row2['book_photo']).'" width="200" 
                                                                                                                 height="300" 
                                                                                                                 border="0"/></td>';?>
                                    <form action="process.php" method="POST">
                                          <td>
                                            <?php
                                                $sqlborrow = "SELECT `book_id` FROM `borrow_book` WHERE `book_id` = '".$row2['book_id']."'";
                                                $sql3 = mysqli_query($connect,$sqlborrow);
                                                if (mysqli_num_rows($sql3)){?>
                                                        <button class="borrow" name="borrow" style="background-color:red"  type="submit" disabled>Borrowed</button>
                                            <?php }else{ ?>
                                                <input type="text" name="bookid" value="<?= $row['book_id'];?>" hidden>
                                                <button class="borrow" name="borrow"  type="submit" >Borrow</button>
                                            <?php } ?>  
                                          </td>
                                    </form>
                                    <?php
                                    echo "</tr>";
                                    $noAca = $noAca + 1;
                                }?>
                                </tbody>
                                </table>
                                </section>
                                <section class="pagination">
                    <ul class="page">
                        <?php
                            if($category > 1){?>
                               <a href='?page=<?php echo $category - 1?>'>
                                   <li>Previous</li>
                               </a>
                        <?php }
                            for($c = 1; $c <= $totalPaginationAca; $c++):?>
                            <?php if($category == $c):?>
                                <a href="?category=<?php echo $c?>" >
                                    <li style="color:white; background-color: #F6BE00;
                                                                       border-color: #F6BE00;
                                                                       font-weight: 600;
                                                                       box-shadow: 0 0.5rem 1rem #ff52f136;"><?php echo $c?>
                                    </li>
                                </a>
                            <?php else:?>
                                <a href="?category=<?php echo $c?>">
                                    <li><?php echo $c?></li>
                                </a>
                            <?php endif;?>
                        <?php endfor;?>
                        <?php
                            if($category < $totalPaginationAca){?>
                               <a href='?page=<?php echo $category - 1?>'>
                               <li>Next</li>
                        </a>
                        <?php }?>
                    </ul>
                </section>
                            <?php
                            }else if(isset($_POST['entertaining'])){
                                foreach($resultEnter as $row3){
                                    echo "<tr>";
                                    echo "<td>".$noAll."</td>";
                                    echo "<td>".$row3['book_id']."</td>";
                                    echo "<td><b>".$row3['book_title']."</b></td>";
                                    echo "<td>".$row3['book_author']."</td>";
                                    echo "<td>".$row3['released_year']."</td>";
                                    echo "<td>".$row3['book_synopsis']."</td>";
                                    echo '<td><img src="data:image;base64,'.base64_encode($row3['book_photo']).'" width="200" 
                                                                                                                 height="300" 
                                                                                                                 border="0"/></td>';?>
                                    <form action="process.php" method="POST">
                                          <td>
                                            <?php
                                                $sqlborrow = "SELECT `book_id` FROM `borrow_book` WHERE `book_id` = '".$row3['book_id']."'";
                                                $sql3 = mysqli_query($connect,$sqlborrow);
                                                if (mysqli_num_rows($sql3)){?>
                                                        <button class="borrow" name="borrow" style="background-color:red"  type="submit" disabled>Borrowed</button>
                                            <?php }else{ ?>
                                                <input type="text" name="bookid" value="<?= $row3['book_id'];?>" hidden>
                                                <button class="borrow" name="borrow"  type="submit" >Borrow</button>
                                            <?php } ?>  
                                          </td>
                                    </form>
                                    <?php
                                    echo "</tr>";
                                    $noAll = $noAll + 1;
                                }?>
                                </tbody>
                                </table>
                                </section>
                            <?php
                            } else if (isset($_POST['novel'])){
                                foreach($resultNov as $row4){
                                    echo "<tr>";
                                    echo "<td>".$noAll."</td>";
                                    echo "<td>".$row4['book_id']."</td>";
                                    echo "<td><b>".$row4['book_title']."</b></td>";
                                    echo "<td>".$row4['book_author']."</td>";
                                    echo "<td>".$row4['released_year']."</td>";
                                    echo "<td>".$row4['book_synopsis']."</td>";
                                    echo '<td><img src="data:image;base64,'.base64_encode($row4['book_photo']).'" width="200" 
                                                                                                                 height="300" 
                                                                                                                 border="0"/></td>';?>
                                    <form action="process.php" method="POST">
                                          <td>
                                            <?php
                                                $sqlborrow = "SELECT `book_id` FROM `borrow_book` WHERE `book_id` = '".$row4['book_id']."'";
                                                $sql3 = mysqli_query($connect,$sqlborrow);
                                                if (mysqli_num_rows($sql3)){?>
                                                        <button class="borrow" name="borrow" style="background-color:red"  type="submit" disabled>Borrowed</button>
                                            <?php }else{ ?>
                                                <input type="text" name="bookid" value="<?= $row4['book_id'];?>" hidden>
                                                <button class="borrow" name="borrow"  type="submit" >Borrow</button>
                                            <?php } ?>  
                                          </td>
                                    </form>
                                    <?php
                                    echo "</tr>";
                                    $noAll = $noAll + 1;
                                } ?>
                                </tbody>
                                </table>
                                </section>
                            <?php
                            } else{
                            foreach($result as $row){
                                echo "<tr>";
                                echo "<td>".$noAll."</td>";
                                echo "<td>".$row['book_id']."</td>";
                                echo "<td><b>".$row['book_title']."</b></td>";
                                echo "<td>".$row['book_author']."</td>";
                                echo "<td>".$row['released_year']."</td>";
                                echo "<td>".$row['book_synopsis']."</td>";
                                echo '<td><img src="data:image;base64,'.base64_encode($row['book_photo']).'" width="200" 
                                                                                                             height="300" 
                                                                                                             border="0"/></td>';?>
                                <form action="process.php" method="POST">
                                      <td>
                                        <?php
                                            $sqlborrow = "SELECT `book_id` FROM `borrow_book` WHERE `book_id` = '".$row['book_id']."'";
                                            $sql3 = mysqli_query($connect,$sqlborrow);
                                            if (mysqli_num_rows($sql3)){?>
                                                    <button class="borrow" name="borrow" style="background-color:red"  type="submit" disabled>Borrowed</button>
                                        <?php }else{ ?>
                                            <input type="text" name="bookid" value="<?= $row['book_id'];?>" hidden>
                                            <button class="borrow" name="borrow"  type="submit" >Borrow</button>
                                        <?php } ?>  
                                      </td>
                                </form>
                                <?php
                                echo "</tr>";
                                $noAll = $noAll + 1;
                            }?>
                            </tbody>
                            </table>
                            </section>
                            <section class="pagination">
                    <ul class="page">
                        <?php
                            if($activePage > 1){?>
                               <a href='?page=<?php echo $activePage - 1?>'>
                               <li>Previous</li>
                        </a>
                        <?php }
                            for($p = 1; $p <= $totalPagination; $p++):?>
                            <?php if($activePage == $p):?>
                                <a href="?page=<?php echo $p?>" >
                                    <li style="color:white; background-color: #F6BE00;
                                                                       border-color: #F6BE00;
                                                                       font-weight: 600;
                                                                       box-shadow: 0 0.5rem 1rem #ff52f136;"><?php echo $p?>
                                    </li>
                                </a>
                            <?php else:?>
                                <a href="?page=<?php echo $p?>">
                                    <li><?php echo $p?></li>
                                </a>
                            <?php endif;?>
                        <?php endfor;?>
                        <?php
                            if($activePage < $totalPagination){?>
                               <a href='?page=<?php echo $activePage + 1?>'>
                               <li>Next</li>
                        </a>
                        <?php }?>
                    </ul>
                </section>
                        <?php
                        }
                        ?>
                        
                
            </main>
    </div>
      <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active');
        }
      </script>
</body>

</html>