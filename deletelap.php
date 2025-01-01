<?php

require_once('connection.php');
$lapid=$_GET['id'];
$sql="DELETE from books where BOOK_ID=$lapid";
$result=mysqli_query($con,$sql);

echo '<script>alert("LAPTOP DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "adminlaptop.php";</script>';

?>