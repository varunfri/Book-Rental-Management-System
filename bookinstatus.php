<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
    <script type="text/javascript" src="../preview/no_back.js"> </script>
</head>
<style>

        *{
            margin: 0;
            padding: 0;

        }

        body{
            background: url("../books/img_5.jpg") fixed;
            background-position: center;
            background-size: cover;
            background-repeat:no-repeat;
            width: 100%;
            height: 100vh;

        
        }
        .box{
            border-radius:10px;
            position:center;    
            top: 50%;
            left: 100%;
            padding: 20px;
            box-sizing: border-box;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,.5);
            background: linear-gradient(to top, rgba(255, 251, 251, 0.8)70%,rgba(250, 246, 246, 0.8)90%);
            display: flex;
            align-content: center;
            width: 700px;
            height: 250px;
            margin-top: 50px;
            margin-left: 400px;
        }


        .box .content{
            margin-top: 10px;
            margin-left: 50px;
            margin-bottom:100px;
            font-size: larger;
        }

        .box .button{
            width: 240px;
            height: 40px;
            background: #ff7200;
            border:none;
            margin-top: 30px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color:#fff;
            transition: 0.4s ease;
        }

        .utton{
            width: 120px;

            height: 40px;
            background: #ff7200;
            border:none;
            font-weight: bold;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color:#fff;
            transition: 0.4s ease; 
            margin-top:30px;margin-left:30px;
        }
         

        ul{
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        ul li{
            list-style: none;
            margin-left: 200px;
            /* margin-top: -1px; */
            font-size: 35px;

        }
        .name{
            font-weight: bold;
        }

</style>
<body>
 <div> 
 <a href="lapdetails.php"><button  class="utton">Home</button> </a>
</div>
<!-- Booking Status Heading -->
<h1 style="
text-align:center;
background: linear-gradient(to top, rgb(255 255 255 / 80%) 50%,rgb(255 255 255 / 80%) 50%);
width:400px;
margin:0px auto;
border-radius:10px;
">  BOOKING STATUS  </h1>
        
<?php

require_once('connection.php');
session_start();
$email = $_SESSION['email'];

$sql="SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC";


$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) == 0){
    echo '<script>alert("THERE ARE NO BOOKING DETAILS")</script>';
    echo '<script>window.location.href = "lapdetails.php";</script>';
}
else{
    
    while($row = mysqli_fetch_assoc($result)) {
        $lapId = $row['BOOK_ID'];
        $sql2 = "SELECT * FROM books WHERE BOOK_ID='$lapId'";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $sql3 = "SELECT * FROM users WHERE EMAIL='$email'";
        $result3 = mysqli_query($con,$sql3);
        $row3 = mysqli_fetch_assoc($result3);
        
?>
<!-- <ul><li class="name">HELLO! <?php echo $row3['FNAME']." ".$row3['LNAME']?></li></ul> -->

            <div class="box">
                <div class="content">
                    <h3>BOOK NAME : <?php echo $row2['TITLE']?></h3><br>
                    <h3>NO OF DAYS : <?php echo $row['DURATION']?></h3><br>
                    <h3>BOOKING STATUS : <?php echo $row['BOOK_STATUS']?></h3><br>
                    <h3>BOOKING DATE : <?php echo $row['BOOK_DATE']?></h3><br>
                </div>
            </div>
<?php
        }
    }
?>

    
</body>
</html>