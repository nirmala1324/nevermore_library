<?php require('dbconnect.php'); 
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
                                <li><a href="adm_returnbook.php"><i class="menu-icon icon-tasks"></i>Return Requests </a></li>
                            </ul>
                </div>
                <div class="contentRight">
                    <div class="module">
                        <div class="module-head"><h3>Add Book</h3></div>
                        <div class="module-body">   
                                <form class="form-horizontal row-fluid" action="process_adm.php" enctype="multipart/form-data" method="post">
                                     <div class="control-group">
                                        <label class="control-label" for="book_id"><b>Book ID</b></label>
                                        <div class="controls">
                                            <input type="text" id="book_id" name="book_id" placeholder="Book ID" class="span8" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_title"><b>Book Category</b></label>
                                        <div class="controls">
                                            <input type="text" id="book_category" name="book_category" placeholder="Book Category" class="span8" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_title"><b>Book Title</b></label>
                                        <div class="controls">
                                            <input type="text" id="book_title" name="book_title" placeholder="Book Title" class="span8" required>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label" for="book_author"><b>Author</b></label>
                                        <div class="controls">
                                            <input type="text" id="book_author" name="book_author" placeholder="Author" class="span8" required>                                         
                                        </div>
                                    </div>                                   
                                    <div class="control-group">
                                        <label class="control-label" for="released_year"><b>Year</b></label>
                                        <div class="controls">
                                            <input type="text" id="released_year" name="released_year" placeholder="Released Year" class="span8" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="book_synopsis"><b>Book Synopsis</b></label>
                                        <div class="controls">
                                            <textarea type="text" id="book_synopsis" name="book_synopsis" placeholder="Book Synopsis" class="span8" required></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label" for="book_photo"><b>Book Photo</b></label>
                                            <div class="controls">
                                                <input type="file" name="book_photo">
                                            </div>
                                        </div>     
                                    <div class="control-group">
                                        <div class="controls">
                                            <button style="height: 50px;" type="submit" name="submitAddBook" value="submitAddBook" class="btn">Add Book</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
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