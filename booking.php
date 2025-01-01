<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link  rel="stylesheet" href="css/logo.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPTOP BOOKING</title>
    <!-- <link  rel="stylesheet" href=""> -->
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
        setTimeout("preventBack()", 0); 
        window.onunload = function () { null };
    </script>
</head>

<body background="images/lapbg6.jpg">
<style>
    .payment{
        margin:0px 50px 0 0;
    }

    *{
        margin: 0;
        padding: 0;
    }
    body{
        /* overflow: hidden; */
        width: 100%;
        background-repeat: no-repeat fixed;
        background-position: center;
        background-size: cover;
        height: 100vh;
    }

    div.main{
        width: 400px;
        margin: 100px auto 0px auto;
    }
    .btnn{
        width: 240px;
        height: 40px;
        background: #ff7200;
        border:none;
        margin-top: 30px;
        margin-left: 30px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        color:#fff;
        transition: 0.4s ease;
    }

    .btnn:hover{
        background: #fff;
        color:#ff7200;
    }

    .btnn a{
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    h2{
        text-align: center;
        padding: 20px;
        font-family: sans-serif;
    }
    div.register{
        background-color: rgba(0,0,0,0.6);
        width: 100%;
        font-size: 18px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: 2px 2px 15px rgba(0,0,0,0.3);
        color: #fff;
    }

    form#register{
        margin: 20px 40px 40px 40px;
    }

    label{
        font-family: sans-serif;
        font-size: 18px;
        font-style: normal;
    }

    input.name, input#dfield, input#datefield{
        width:300px;
        border:1px solid #ddd;
        border-radius: 3px;
        outline: 0;
        padding: 7px;
        background-color: #fff;
        box-shadow: inset 1px 1px 5px rgba(0,0,0,0.3);
    }

    .hai{
        width: 100%;
        height: 0px;
    }
    .main{
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
        background-position: center;
        background-size: cover;
    }
    .navbar{
        width: 1200px;
        height: 75px;
        margin: auto;
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
        color: black;
    }

    ul li{
        list-style: none;
        margin-left: 80px;
        margin-top: 20px;
        font-size: 14px;
        color: black;
    }

    ul li a{
        text-decoration: none;
        color:white;
        font-family: Arial;
        font-weight: bold;
        transition: 0.4s ease-in-out;
    }

    ul li a:hover{
        color:#7f95b2;
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

    .circle{
        border-radius:48%;
        width:65px;
    }

    button{
        border:none;
        width:120px;
        height:40px;
        border-radius:10px;
    }
    .phello{
        color: white;
        width: 200px;
        margin-left: -50px;
        padding: 0px;
    }
    .uname{
        color:white;
    }
</style>

<?php 
    require_once('connection.php');
    session_start();
    $lapid=$_GET['id'];
    
    $sql="select * from books where BOOK_ID='$lapid'";
    $cname = mysqli_query($con,$sql);
    $email = mysqli_fetch_assoc($cname);
   

    $value = $_SESSION['email'];
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $uname = $rows['FNAME']." ".$rows['LNAME'];
    $uemail=$rows['EMAIL'];
    $uphone = $rows['PHONE_NUMBER'];
    $lap_price = $email['PRICE'];
    $title = $email['TITLE'];
    $carprice=$email['PRICE'];
    
    if(isset($_POST['book']))
    {   
        $bdate=date('Y-m-d',strtotime($_POST['date']));
        $dur=mysqli_real_escape_string($con,$_POST['dur']);
        // $phno=mysqli_real_escape_string($con,$_POST['ph']);
        $phno = $uphone;
        $rdate=date('Y-m-d',strtotime($_POST['rdate']));
         
        if(empty($bdate)|| empty($dur)|| empty($phno)|| empty($rdate)){
            echo '<script>alert("please fill the place")</script>';
        }
        else{
            if($bdate<$rdate){
                $price=($dur*$carprice);

                $payment_method = $_POST['payment'];

                if($payment_method == 'CWP') {
                    $sql = "insert into booking (BOOK_ID, EMAIL, BOOK_DATE, DURATION, PHONE_NUMBER, PRICE, RETURN_DATE) values ($lapid, '$uemail', '$bdate', $dur, $phno, $price, '$rdate')";
                    $result = mysqli_query($con, $sql);
    
                    if($result) {
                        $_SESSION['email'] = $uemail;
                        header("Location: psucess.php"); // Redirect to success page for CWP
                        exit;
                    }   else {
                        echo '<script>alert("Please check your connection.")</script>';
                    }
                } elseif($payment_method == 'Online'){
                    $sql="insert into booking (BOOK_ID,EMAIL,BOOK_DATE,DURATION,PHONE_NUMBER,PRICE,RETURN_DATE) values($lapid,'$uemail','$bdate',$dur,$phno,$price,'$rdate')";
                    $result = mysqli_query($con,$sql);
    
                    if($result){
                        $_SESSION['email'] =$uemail;
                        header("Location: payment.php");
                    }
                    else{
                        echo '<script>alert("please check the connection")</script>';
                    }
                     
                }
                
                // // modifying the coce
                // $sql="insert into booking (BOOK_ID,EMAIL,BOOK_DATE,DURATION,PHONE_NUMBER,PRICE,RETURN_DATE) values($lapid,'$uemail','$bdate',$dur,$phno,$price,'$rdate')";
                // $result = mysqli_query($con,$sql);
                
                // if($result){
                //     $_SESSION['email'] =$uemail;
                //     header("Location: payment.php");
                // }
                // else{
                //     echo '<script>alert("please check the connection")</script>';
                // }



            }
            else{
                echo  '<script>alert("please enter a correct return date")</script>';
            }
        }
    }
?>
    
<div class="hai">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">RentNRead</h2>
        </div>
        <div class="menu">
            <ul>
                <li><button><a style="color:black;" href="lapdetails.php">HOME</a></button></li>
                <li><button><a style="color:black;" href="service.php">SERVICE</a></button></li>
                <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
                <li><img src="images/profile.png" class="circle" alt="Alps"></li>
                <li><p class="phello">HELLO! &nbsp;<a class="uname"><?php echo $uname; ?></a></p></li>
            </ul>
        </div>
    </div>
</div>
                
<div class="main"> 
    <div class="register">
        <h2>BOOKING</h2>
        <form id="register" method="POST">
            <h2><?php echo "".$email['TITLE']?></h2>
            <br>
            <label>BOOKING DATE : </label>
            <br>
            <input type="date" name="date" id="datefield" min="" max="" placeholder="ENTER THE DATE FOR BOOKING">
            <br><br>
            <label>DURATION : </label>
            <br>
            <input type="number" name="dur" min="1" max="30" class="name"id="duration" placeholder="Enter Rent Period (in days)">
            <br><br>
            <label>PHONE NUMBER : </label>
            <br>
            <input type="tel" name="ph" maxlength="10" class="name" value="<?php echo "+91"." ". $uphone ?>" readonly>
            <br><br>
            <label>RETURN DATE : </label>
            <br>
            <input type="date" name="rdate" id="dfield" placeholder="Enter The Return Date" readonly>
            <br><br>
            <label>TOTAL PRICE : </label>
            <br>
            <input type="text" class="name" name=" " id="total_price" placeholder="Total Price" readonly>
            <br><br>
            <span>
                <input type='radio' name='payment' value="CWP"  required>
                <label class='payment' alt="casj">COP</label>
                <input type='radio' name='payment'   value="Online" required>
                <label>Online Payment</label>
            </span>
            
            <input type="submit" class="btnn" value="BOOK" name="book">
        </form>
    </div>
</div>
    
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
         dd = '0' + dd;
    }
    if (mm < 10) {
          mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("min", today);
      document.getElementById("datefield").setAttribute("max", today);
     // document.getElementById("datefield").setAttribute("max", yyyy + '-' + mm + '-' + (dd + 30)); // Set maximum booking date to 30 days from today

     var lapPrice = <?php echo $lap_price; ?>;

    function calculateReturnDate() {
        var startDate = new Date(document.getElementById("datefield").value);
        var duration = parseInt(document.getElementById("duration").value);
        if (!isNaN(startDate) && !isNaN(duration)) {
            startDate.setDate(startDate.getDate() + duration);
            var dd = startDate.getDate();
            var mm = startDate.getMonth() + 1; //January is 0!
            var yyyy = startDate.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var returnDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById("dfield").value = returnDate;

            var totalPrice = duration * lapPrice;
            document.getElementById("total_price").value = totalPrice;


        }
    }

    document.getElementById("datefield").addEventListener("change", calculateReturnDate);
    document.getElementById("duration").addEventListener("input", calculateReturnDate);

    // document.getElementById('total_price').value=days;
</script>

</body>
</html>