<?php
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
                                <li class="active"><a href="index.php"><i class="menu-icon icon-home"></i>Home</a></li>
                                <li><a href="adm_memberList.php"><i class="menu-icon icon-user"></i>Manage Member</a></li>
                                <li><a href="adm_booklist.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="adm_addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                                <li><a href="borrowed_book.php"><i class="menu-icon icon-list"></i>Borrowed Books </a></li>
                                <li><a href="requests_return.php"><i class="menu-icon icon-tasks"></i>Return Requests </a></li>
                            </ul>
                </div>
                <div class="contentRight">
                    

                </div>
            </div>
            <div class="footer">
                
                
             </div>
         </div>
    </body>
</html>