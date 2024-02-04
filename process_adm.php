<?php
include ("dbconnect.php");
session_start();

if (isset($_POST['submitAddBook'])) {

        $book_id = $_POST['book_id'];
        $book_category = $_POST['book_category'];
        $book_title = $_POST['book_title'];
        $book_author = $_POST['book_author'];
        $released_year = $_POST['released_year'];
        $book_synopsis = $_POST['book_synopsis'];

        $fileName = $_FILES['book_photo']['name'];
        $fileSize = $_FILES['book_photo']['size'];
        $fileTemp = $_FILES['book_photo']['tmp_name'];
        $fileType = $_FILES['book_photo']['type'];
    

        $file = fopen($fileTemp,'r');
        $book_photo = fread($file, filesize(($fileTemp)));
        $book_photo = addslashes($book_photo);
        fclose($file);

        $fileName = addslashes($fileName);
        $location = "book_photo/$fileName";
        move_uploaded_file($fileTemp,$location);

        $addBook = "INSERT INTO book_data (book_id, book_category, book_title,released_year,book_author,book_synopsis,book_photo)
                    VALUES('$book_id', '$book_category','$book_title','$released_year','$book_author','$book_synopsis','$book_photo')";
    
        mysqli_query($connect, $addBook);
        echo "<script>alert('Product is successfully added'); window.location='product-list.php';</script>";
        header('location: adm_booklist.php');

    }


    
    if(isset($_POST['update']))
    {
        $book_id = $_POST['book_id'];
        $book_category = $_POST['book_category'];
        $book_title = $_POST['book_title'];
        $book_author = $_POST['book_author'];
        $released_year = $_POST['released_year'];
        $book_synopsis = $_POST['book_synopsis'];
        $book_photo = $_POST['book_photo'];
        $fileTemp  = $_FILES['book_photo']['tmp_name'];
    
        if($fileTemp != ''){
            $file = fopen($fileTemp,'r');
            $book_photo = fread($file, filesize(($fileTemp)));
            $book_photo = addslashes($book_photo);
            fclose($file);
            
            $query = "UPDATE book_data SET book_id = '$book_id', book_category = '$book_category',book_title = '$book_title', book_author = '$book_author', book_synopsis = '$book_synopsis', book_photo = '$book_photo'
                      WHERE book_id = '$book_id'";
            $result = mysqli_query($connect, $query);
    
                if (!$result) {
                    die ("Query is failed to run: " .mysqli_errno($connect). " - " .mysqli_error($connect));
                } else {
                    echo "<script>alert('Product informationis successfully edited');window.location='adm_booklist.php';</script>";
                }
            
        } else {

            $query = "UPDATE book_data SET book_id = '$book_id', book_category = '$book_category', book_title = '$book_title', book_author = '$book_author', book_synopsis = '$book_synopsis', book_photo = '$book_photo'
                    WHERE book_id = '$book_id'";
            $result = mysqli_query($connect, $query);
    
            if (!$result) {
                die ("Query is failed to run: " .mysqli_errno($connect). " - " .mysqli_error($connect));
            } else {
                echo "<script>alert('Product information is successfully edited');window.location='adm_booklist.php';</script>";
            }
        }
        
    }

    if (isset($_POST['back'])){
        header('location:adm_booklist.php');
    }


    ?>