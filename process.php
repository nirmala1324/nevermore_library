<?php 
    require('dbconnect.php');

    session_start();

    if (isset($_POST['submitSignup'])) {
        $username  = $_POST ['username'];
        $fullname  = $_POST ['fullName'];
        $gender    = $_POST ['gender'];
        $date      = $_POST ['date'];
        $address   = $_POST ['address'];
        $phonenum  = $_POST ['phoneNum'];
        $email     = $_POST ['email'];
        $password  = $_POST ['password'];
        $profpic   = $_POST ['profpic'];
        $fileTemp  = $_FILES['profpic']['tmp_name'];

        $file = fopen($fileTemp,'r');
        $photouser = fread($file, filesize(($fileTemp)));
        $photouser = addslashes($photouser);
        fclose($file);

        $query = "INSERT INTO user(username, fullname, gender, dob, address, phonenum, email, password, profpic)
                  VALUES('$username', '$fullname', '$gender', '$date', '$address', '$phonenum', '$email', '$password', '$photouser')";
    
        mysqli_query($connect, $query);
    
        header('location: login.html');
    }

    if (isset($_POST['borrow'])) {

        $id     = $_POST['bookid'];
        $sql    = "SELECT * FROM book_data WHERE book_id = '$id'";
        $edit   = mysqli_query($connect, $sql);
        $data   = mysqli_fetch_row($edit);
        $_SESSION['data'] = $data;

        header('location: borrowbook.php');
    }

    if (isset($_POST['borrow_db'])) {

        $bookid        = $_POST['bookid'];
        $username      = $_POST['user_name'];
        $borrowingdate = $_POST['borrowingdate'];
        $returningdate = $_POST['returningdate'];
        $sql    = "INSERT INTO borrow_book(book_id,username, borrowing_date, returning_date) 
                   VALUES ('$bookid','$username','$borrowingdate','$returningdate')";
        $insert = mysqli_query($connect, $sql);

        header("Location: borrowbook.php");
    }

    if (isset($_POST['return'])) {
        
        $id   = $_POST['borrowid'];
        $sql  = "SELECT * FROM borrow_book WHERE borrow_id = '$id'";
        $edit = mysqli_query($connect, $sql);
        $data1 = mysqli_fetch_row($edit);
        $_SESSION['data1'] = $data1;

        header('location: returnbook.php');
    }

    if (isset($_POST['return_db'])) {

        $uname         = $_SESSION['username'];
        $borrowid      = $_POST['borrowid'];
        $bookid        = $_POST['bookid'];
        $borrowingdate = $_POST['borrowingdate'];
        $returningdate = $_POST['returningdate'];
        $dateofreturn  = $_POST['dateofreturn'];
        $fine          = $_POST['fine'];
        $status        = $_POST['status'];
        $sql    = "INSERT INTO return_book(borrow_id, book_id, borrowing_date, returning_date, username, date_of_return, fine, status) 
                   VALUES ('$borrowid','$bookid','$borrowingdate','$returningdate','$uname', '$dateofreturn', '$fine', '$status')";
        $insert = mysqli_query($connect, $sql);

        header("Location: returnbook.php");

    }

    if (isset($_POST['logout'])) {

        session_destroy();

        header("Location: index.html");

    }

?>