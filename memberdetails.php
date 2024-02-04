<?php include('dbconnect.php'); ?>
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
                                <div class="module-head">
                                    <h3>Student Details</h3>
                                </div>
                                <div class="module-body">
                                    <?php
                                        $rno=$_GET['id'];
                                        $sql="select * from user where username='$rno'";
                                        $result=$connect->query($sql);
                                        $row=$result->fetch_assoc();    
                                        
                                            $username=$row['username'];
                                            $fullname=$row['fullname'];
                                            $email=$row['email'];
                                            $gender=$row['gender'];
                                            $address=$row['address'];                                      
                                            $dob=$row['dob'];
                                            $phonenum=$row['phonenum'];
                                   

                                            echo "<table class= table>
                                            <tr>
                                                <td class= space >Fullname</td>
                                                <td>: $fullname</td>
                                            </tr>
                                            <tr>
                                                <td>Date of Birth  </td>
                                                <td>: $dob</td>
                                            </tr>
                                            <tr>
                                                <td>Gender </td>
                                                <td>: $gender</td>
                                            </tr>
                                            <tr>
                                                
                                                <td>Email </td>
                                                <td>: $email</td>
                                            </tr>
                                            <tr>                                   
                                                <td>Phone </td>
                                                <td>: $phonenum</td>
                                            </tr>
                                            <tr>                                   
                                                <td>Address </td>
                                                <td>: $address</td>
                                            </tr>
                                          
                                        </table>"
                                        ?>
                                        <div class="module-head">
                                            <tr>
                                                <td><a href= adm_memberList.php class = btn btn-primary>Back</a>
                                                <td><a href="delete_member.php?id=<?php echo $username; ?>" class="btn" name="delete" value="delete">Delete</a></button></td>                                                      
                                                 </tr>
                                        </div>                       
                                </div>
                                </div>
                        </div>
                    </div>
                
            </div>
            <div class="footer">
                
                
             </div>
         </div>
    </body>
</html>