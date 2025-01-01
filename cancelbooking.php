<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CANCEL BOOKING</title>
    <script type="text/javascript" src="../preview/no_back.js"> </script>
</head>
<style>
    h1{
        background:#f8eee5;
        text-align:center;
        border-radius:10px;
        color:black;
        margin:0px auto 50px ;
        width:max-content;
        padding:10px;
    }
    .form{
        align-content: center;
        margin: 220px 200px;
    } 
    .hai{
        width: 200px;
    height: 40px;
   
    background: #ff7200;
    border:none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    margin-left: 200px;
    }
    .no{
        width: 200px;
    height: 40px;
  
    background: #ff7200;
    border:none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    margin-left: 300px;
    }

    .no a{
        text-decoration: none;
        color: white;
    }
    body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            /* position: static; */
            height: 100vh;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../images/payment_1.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            filter: blur(10px); /* Adjust the blur level as needed */
            z-index: -1;
        }

</style>
<body>
<div > 
<?php
	
    require_once('connection.php');
    session_start();
    $bid = $_SESSION['bid'];
    if(isset($_POST['cancelnow'])){
        $del = mysqli_query($con,"delete from booking where BOOK_ID = '$bid' order by BOOK_ID DESC limit 1");
        echo "<script>window.location.href='lapdetails.php';</script>";
        
    }


?>
 <form   method="POST" >
    <div class="form">
        <h1>ARE YOU SURE YOU WANT TO CANCEL YOUR BOOKING?</h1>
        <input  type="submit" class="hai" value="CANCEL NOW" name="cancelnow">
        <button class="no"><a href="payment.php" >GO TO PAYMENT</a></button>
        <div>
    </form>
</div>
</body>
</html>
