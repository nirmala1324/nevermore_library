<?php include('dbconnect.php');

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
            <form action="process_adm.php?id=<?php echo $book_id; ?>" method="POST">
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
                    

                            <div class="module">                              
                                <div class="module-head">
                                    <h3>Book Details</h3>
                                </div>
                                <div class="module-body">
                                        <?php
                                            $rno = $_GET['id'];
                                            $sql = "SELECT * from book_data where book_id='$rno'";
                                            $result = $connect->query($sql);
                                            $row = $result->fetch_assoc();  
                                            
                                            $book_id=$row['book_id'];
                                            $book_title=$row['book_title'];
                                            $book_author=$row['book_author'];
                                            $released_year=$row['released_year'];
                                            $book_synopsis=$row['book_synopsis'];
                                        

                                            echo "<table class= table>
                                                    <tr>
                                                        <td rowspan=5 class=space><img src='data:image;base64,".base64_encode($row['book_photo'])."' widht=200px height=200px></td>
                                                        <td class= space >Title</td> 
                                                        <td>: $book_title</td> 
                                                    </tr>
                                                    <tr>
                                                        <td>Book ID  </td>
                                                        <td>: $book_id</td> 
                                                    </tr>
                                                    <tr>
                                                        <td>Book Author </td>
                                                        <td>: $book_author</td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td>Released Year </td>
                                                        <td>: $released_year</td>
                                                    </tr>
                                                    <tr>                                   
                                                        <td>Synopsis </td>
                                                        <td>: $book_synopsis</td>
                                                    </tr>
                                                  
                                                </table>"
                                        ?>
                                        <div class="module-head">
                                            <tr>
                                                <td><a href= "adm_booklist.php" class = btn btn-primary>Back</a>
                                                <td><a href= "edit_booklist2.php?id=<?php echo $book_id; ?>" class="btn" value="edit">Edit</a></td>
                                                <td><a href= "delete_booklist.php?id=<?php echo $book_id; ?>" name="delete" class="btn">Delete</a></button></td>                                                      
                                                 </tr> 
                                        </div>
                               </div>
                                </div>
                        </div>
                    </div>
                
            </div>
            <div class="footer">
                
                
             </div>
             </form>
         </div>

         <!--DELETE-->

    </body>
</html>

           