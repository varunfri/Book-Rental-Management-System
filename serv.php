<?php
require_once('connection.php');
$bookid= 85;
$approval_date = date('Y-m-d');
//getting details from booking table
$sql="SELECT *from booking where BOOK_Id=$bookid";
$result=mysqli_query($con,$sql);
$res = mysqli_fetch_assoc($result);
$LAP_ID=$res['LAP_ID'];
$email=$res['EMAIL'];

//getting the user details
$sql3 = "SELECT * from users where EMAIL='$email'";
$result3 = mysqli_query($con,$sql3);
$res3 = mysqli_fetch_assoc($result3);
$uname = $res3['FNAME']." ".$res3['LNAME'];

//getting details from laptop table
$sql2="SELECT *from laptops where LAP_ID=$LAP_ID";
$carres=mysqli_query($con,$sql2);
$carresult = mysqli_fetch_assoc($carres); //refering the column
//get the details of the laptop
$lap_name = $carresult['LAP_NAME'];
$lap_ram = $carresult['RAM'];
$laP_pro = $carresult['processor'];

?>
<html>
    <head>
</head>
<body>
    <p> <?php echo $lap_name;?></p>
    <p> <?php echo $lap_name;?></p>
      <p> <?php echo $lap_name;?></p>
</body>
    </html>