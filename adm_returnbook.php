<?php 
    include('dbconnect.php'); 

    session_start();
    
if (!isset($_SESSION['username'])){
    header("Location: youMustLogin.php");
}else{
    $uname = $_SESSION['username'];
}
?>

<html>
    <head>
        <title>Admin Dashboard</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="dash_Admin.css" rel="stylesheet">
    </head>
    <body>
         <div class="banner-all">
            <!--/.navbarTOP-->
            <div class="navbar">
                <img src="never.png" class="Logo">
                <ul>
                <li><a href="#">Admin</a></li>
            </ul>
            </div>
            <!--/.navbarSidebar-->
            <div class="container">
                <div class="sidebarLeft">
                <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="homepageAdmin.php"><i class="menu-icon icon-home"></i>Home</a></li>
                                <li><a href="adm_memberList.php"><i class="menu-icon icon-user"></i>Manage Member</a></li>
                                <li><a href="adm_booklist.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="adm_addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                                <li><a href="adm_borrowbook.php"><i class="menu-icon icon-list"></i>Borrowed Books </a></li>
                                <li><a href="adm_returnbook.php"><i class="menu-icon icon-tasks"></i>Request Returned</a></li>
                            </ul>
                </div>
                <div class="contentRight">
                    <div class="tableR">
                    <form class="form-horizontal row-fluid" action="adm_returnbook.php" method="post">
                        <div class="control-group">
                            <label class="control-label" for="Search"><b>Search:</b></label>
                            <div class="controls">
                                <input id="returnedlist" name="returnedlist" type="text" placeholder="Search username / book id" class="span8" required>
                                <button type="submit" name="searchButton" class="search" class="btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['searchButton'])){
                            $search = $_POST['returnedlist'];
                            $returnedlist="SELECT * from return_book WHERE username='$search' or status like '%$search%'";
                        } else {
                            $returnedlist="SELECT * from return_book";}

                            $result = $connect->query($returnedlist);
                            $rowcount = mysqli_num_rows($result);
                        
                        if(!($rowcount)){
                            echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                        } else {  ?>

                            <table class="table" border="1">
                                 <thead>
                                    <th>Returned ID</th>
                                    <th>Borrowed ID</th>
                                    <th>Username</th>
                                    <th>Borrowing Date</th>
                                    <th>Returning Date</th>
                                    <th>Date of Return</th>
                                    <th>Fine</th>
                                    <th>Cofirm</th>
                                </thead>
                                <tbody>
                                    <?php
                                    //$result=$conn->query($sql);
                                    while($row=$result->fetch_assoc())
                                        {
                                            $return_id=$row['return_id'];
                                            $borrow_id=$row['borrow_id'];
                                            $username=$row['username'];
                                            $borrowing_date=$row['borrowing_date']; 
                                            $returning_date=$row['returning_date'];
                                            $date_of_return=$row['date_of_return']; 
                                            $fine = $row['fine'];  
                                        ?>
                                    
                                            <tr>
                                                <td><?php echo $return_id ?></td>
                                                <td><?php echo $borrow_id ?></td>
                                                <td><?php echo $username ?></td>
                                                <td><?php echo $borrowing_date ?></td>
                                                <td><?php echo $returning_date ?></td>
                                                <td><?php echo $date_of_return ?></td>
                                                <td><?php echo $fine ?></td> 
                                                <td><center>
                                                    <?php
                                                        $sqlconfirm = "SELECT `status` FROM `return_book` WHERE `status` = 'confirmed'";
                                                        $sql3 = mysqli_query($connect,$sqlconfirm);
                                                        if (mysqli_num_rows($sql3)){?>
                                                               <button href="returnconfirm.php?id1=<?php echo $borrow_id; ?>&id2=<?php echo $username;?>" style="background-color: grey;" aria-disabled="TRUE">Confirm</button>
                                                    <?php }else{ ?>
                                                               <a href="returnconfirm.php?id1=<?php echo $borrow_id; ?>&id2=<?php echo $username;?>" 
                                                               class="btn btn-success" style="background-color: black;">Confirm</a>
                                                    <?php } ?>
                                                    </center>
                                                </td>                                
                                            </tr>
                                    <?php }} ?>
                                </tbody>
                            </table> 
                
            </div>
        </div>        
    </body>
</html> 