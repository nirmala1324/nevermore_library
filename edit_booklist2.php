<?php
// database connection
include ("dbconnect.php");
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
                                <li class="active"><a href="index.php"><i class="menu-icon icon-home"></i>Home</a></li>
                                <li><a href="adm_memberList.php"><i class="menu-icon icon-user"></i>Manage Member</a></li>
                                <li><a href="adm_booklist.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="adm_addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                                <li><a href="adm_borrowbook.php"><i class="menu-icon icon-list"></i>Borrowed Books </a></li>
                                <li><a href="adm_returnbook.php"><i class="menu-icon icon-tasks"></i>Returned Books</a></li>
                            </ul>
                </div>
                <div class="contentRight">
                    <div class="module">
                        <div class="module-head"><h3>Edit Book</h3></div>
                        <div class="module-body">  
                                    <?php

                                        $bookID = $_GET['id'];
                                        $sql = "SELECT * from book_data where book_id='$bookID'";
                                        $edit = $connect->query($sql);
                                        $row = $edit->fetch_assoc();  

                                        $book_id=$row['book_id'];
                                        $book_category=$row['book_category'];
                                        $book_title=$row['book_title'];
                                        $book_author=$row['book_author'];
                                        $released_year=$row['released_year'];
                                        $book_synopsis=$row['book_synopsis'];
                                      
                                                                      
                                       ?>
                                    <form class="form-horizontal row-fluid" action="process_adm.php" method="post" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label" for="book_id"><b>Book ID</b></label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $book_id ?>" id="book_id" name="book_id" placeholder="Book ID" class="span8" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_title"><b>Book Category</b></label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $book_category; ?>" id="book_category" name="book_category" placeholder="Book Category" class="span8">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_title"><b>Book Title</b></label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $book_title; ?>" id="book_title" name="book_title" placeholder="Book Title" class="span8">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_author"><b>Author</b></label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $book_author;?>" id="book_author" name="book_author" placeholder="Author" class="span8">                                         
                                        </div>
                                    </div>                                   
                                    <div class="control-group">
                                        <label class="control-label" for="released_year"><b>Year</b></label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $released_year;?>" id="released_year" name="released_year" placeholder="Released Year" class="span8">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_synopsis"><b>Book Synopsis</b></label>
                                        <div class="controls">
                                            <textarea type="text" id="book_synopsis" name="book_synopsis" placeholder="Book Synopsis" class="span8"><?php echo $book_synopsis; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label" for="book_photo"><b>Book Photo</b></label>                              
                                            <div class="controls">
                                                <input style="width: 50px; height: 50px" type="image" name="book_photo" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['book_photo']);?>" >
                                                <input type="file" name="book_photo" value="<?php echo base64_encode($row['book_photo']);?>">
                                            </div>
                                        </div>  
                                        <div class="control-group">
                                        <div class="controls" >
                                            <input type="submit" name="back" value="Back" class="btn"></input>
                                            <input type="submit" name="update" value="Update" class="btn"></input>                                        </div>
                                        </div>                                
                                </form>
                                
                                
                    </div>

                    </div>
                    </div>

                    </div>
                    </div>
                   
                </div>
            </div>
            <div class="footer">
                
            </div>
                
             </div>
         </div>

    </body>
</html>

                       