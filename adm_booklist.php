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
                    <form class="form-horizontal row-fluid" action="adm_booklist.php" method="post">
                        <div class="control-group">
                            <label class="control-label" for="Search"><b>Search:</b></label>
                            <div class="controls">
                                <input id="book_title" name="book_title" type="text" placeholder="Search title or book id" class="span8" required>
                                <button type="submit" name="searchButton" class="search" class="btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['searchButton'])){
                            $search = $_POST['book_title'];
                            $booklist="SELECT * from book_data WHERE book_id='$search' or book_title like '%$search%'";
                        } else {
                            $booklist="SELECT * from book_data";}
                            $result = $connect->query($booklist);
                            $rowcount = mysqli_num_rows($result);
                        
                        if(!($rowcount)){
                            echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                        } else {  ?>

                            <table class="table" border="1">
                                 <thead>
                                    <th>Book ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    //$result=$conn->query($sql);
                                    while($row=$result->fetch_assoc())
                                        {
                                            $book_id=$row['book_id'];
                                            $book_title=$row['book_title'];
                                            $book_author=$row['book_author'];  
                                        ?>
                                    
                                            <tr>
                                                <td><?php echo $book_id ?></td>
                                                <td><?php echo $book_title ?></td>
                                                <td><?php echo $book_author ?></td>
                                                <td><center><a href="booksdetail.php?id=<?php echo $book_id; ?>" class="btn btn-primary">Details</a>
                                                            <a href="edit_booklist2.php?id=<?php echo $book_id; ?>" name="edit" value="edit" class="btn btn-success">Edit</a></center></td>
                                            </tr>
                                    <?php }} ?>
                                </tbody>
                            </table> 
                
            </div>
        </div>        
    </body>
</html>