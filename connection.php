<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // $con = mysqli_connect('localhost','root','','laptop'); 
    $con = mysqli_connect('localhost','root','fri4e964','_book');
    if(!$con)
    {
        echo 'please check your Database connection';
    }







?>