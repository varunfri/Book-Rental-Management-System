<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <script type="text/javascript" src="../preview/no_back.js"> </script>
</head>
<style>
    button{
        margin-top:10px;
        border:1px solid #fff;
        width:120px;
        height:40px;
        border-radius:10px;
    }
    *{
        margin: 0;
        padding: 0;
    }
    body{
        width: 100%;
        background-repeat: no-repeat fixed;    
        background-position: center;
        background-size: cover;
        height: 100vh;
        overflow:hidden;
    }
    .hai{
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0) 50%, rgba(0,0,0,0) 50%), url('../books/img_3.webp');
        background-position: center;
        background-size: cover;
        height: 100%;
        animation: infiniteScrollBg 50s linear infinite;
    }
    .main{
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0) 50%, rgba(0,0,0,0) 50%);
        background-position: center;
        background-size: cover;
        height: 109vh;
        animation: infiniteScrollBg 50s linear infinite;
    }
    .navbar{
        width: 1200px;
        height: 75px;
        margin: 0px 50px;
    }
    .icon{
        width:200px;
        float: left;
        height : 70px;
    }
    .menu{
        width: 400px;
        float: left;
        height: 70px;
    }
    ul{
        float: left;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    ul li{
        list-style: none;
        margin-left: 62px;
        margin-top: 27px;
        font-size: 14px;
    }
    ul li a{
        text-decoration: none;
        color: black;
        font-family: Arial;
        font-weight: bold;
        transition: 0.4s ease-in-out;
    }

    .table-container {
        width: 90%;
        max-height: 450px;
        margin: 50px auto;
        overflow-y: auto;
        box-shadow: 0 0 20px rgba(0,0,0,0.15);
    }

    .content-table{
        border-collapse: collapse;
        font-size: 19px;
        width: 100%;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
    }
    .content-table thead tr{
        background-color: orange;
        color: black;
        text-align: center;
        position: sticky;
        top: 0;
    }
    .content-table th {
        padding: 12px 15px;
    }
    .content-table td{
        width: 100px;
        text-align:center;
        padding: 12px 15px;
    }
    .content-table tbody tr{
        border-bottom: 1px solid #dddddd;
    }
    .content-table tbody tr {
        background-color: #f3f3f3c9;
    }
    .content-table tbody tr:last-of-type{
        border-bottom: 2px solid orange;
    }
    .header{
        margin-top: -800px;
        margin-left: 850px;
    }
    .nn{
        width:100px;
        background: #ff7200;
        border:none;
        height: 40px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        color:white;
        transition: 0.4s ease;
    }
    .nn a{
        text-decoration: none;
        color: black;
        font-weight: bold;
    }
    .add{
        width: 200px;
        height: 40px;
        background: #ff7200;
        border:none;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        color:#fff;
        transition: 0.4s ease;
        margin-top:20px;
        margin-left: 1050px;
    }
    .add a{
        text-decoration: none;
        color: black;
        font-weight: bolder;
    }
    .but a{
        text-decoration: none;
        color: black;
    }
</style>
<body>
<?php
require_once('connection.php');
$query="SELECT * FROM booking ORDER BY BOOK_ID DESC";    
$queryy=mysqli_query($con,$query);
$num=mysqli_num_rows($queryy);
?>
<div class="hai">
    <div class="navbar">
        <a href="admindash.php"> 
            <div class="icon">
                <h2 class="logo">RentNRead</h2>
            </div>
        </a>
        <div class="menu">
            <ul>
                <li><button><a href="adminlaptop.php">BOOKS</a></button></li>
                <li><button><a href="adminusers.php">USERS</a></button></li>                    
                <li><button><a href="adminbook.php">REQUESTS</a></button></li>
                <li><button><a href="ser_request.php">SERVICES</a></button></li>    
                <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
            </ul>
        </div>
    </div>
</div>
<div>
    <h1 class="header"> </h1>
    <div>
        <h1 style="
            text-align: center;
            margin-top: 120px;
            margin-left:auto;
            margin-right:auto;
            width:200px;
            border-radius:10px;
            background: linear-gradient(to top, rgb(255 255 255 / 80%) 50%, rgb(255 255 255 / 80%) 50%);
        ">REQUESTS</h1>
        <div class="table-container">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>BOOK ID</th>
                        <th>EMAIL</th>
                        <th>BOOK DATE</th>
                        <th>DURATION</th>  
                        <th>PRICE</th>
                        <th>PHONE NUMBER</th>
                        <th>RETURN DATE</th>
                        <th>BOOKING STATUS</th>
                        <th>APPROVE</th>
                        <th>RETURN</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($res=mysqli_fetch_array($queryy)){ ?>
                <tr class="active-row">
                    <td><?php echo $res['BUY_ID'];?></td>
                    <td><?php echo $res['EMAIL'];?></td>
                    <td><?php echo $res['BOOK_DATE'];?></td>
                    <td><?php echo $res['DURATION'];?></td>
                    <td><?php echo  '₹ '.$res['PRICE'];?></td>
                    <td><?php echo $res['PHONE_NUMBER'];?></td>
                    <td><?php echo $res['RETURN_DATE'];?></td>
                    <td><?php echo $res['BOOK_STATUS'];?></td>
                    <td>
                        <button type="submit" class="but" name="approve">
                            <a href="approve.php?id=<?php echo $res['BOOK_ID']?>">APPROVE</a>
                        </button>
                    </td>
                    <td>
                        <button type="submit" class="but" name="approve">
                            <a href="adminreturn.php?id=<?php echo $res['BOOK_ID']?>&bookid=<?php echo $res['BOOK_ID']?>">RETURN</a>
                        </button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
