
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BOOK RENTAL</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link  rel="stylesheet" href="css/logo.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
    <link  rel="stylesheet" href="css/style.css">
     
</head>
<style>
     button
        {
        
        border:1px solid #fff; width:150px;height:40px;border-radius:10px;
        }
  body{
    width: 100%;
    background-repeat: no-repeat fixed;
    background-position: center;
    background-size: cover;
    height: 100vh;
    overflow: hidden;
    }
    .menu{
        margin-top:10px;
    }   
</style>
<body>

<?php
    require_once('connection.php');
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        
        
        if(empty($email)|| empty($pass))
        {
            echo '<script>alert("please fill the blanks")</script>';
        }

        else{
            $query="select *from users where EMAIL='$email'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['PASSWORD'];
                // if(md5($pass)  == $db_password)
                if($pass  == $db_password)
                {
                    header("location: lapdetails.php");
                    session_start();
                    $_SESSION['email'] = $email;
                    
                }
                else{
                    echo '<script>alert("Enter a proper password")</script>';
                }

            }
            else{
                echo '<script>alert("enter a proper email")</script>';
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
                    <li><a href="index.php"> </a></li>
                    <!-- <li><a href="service.php">SERVICES</a></li> -->
                    
                    <li><button><a href="contactus.php">CONTACT US</a></li>
                  <li> <button class="adminbtn"><a href="adminlogin.php">ADMIN LOGIN</a></button></li>
                </ul>
            </div>
            
          
        </div>
        <div class="content">
            <h1 class="head">Rent Your <br><span>Book..</span></h1>
            <p class="par">Live the life of Fulfillment<br>
                Just rent a book of your wish from our collection.<br>
                 Join us to make this family vast.  </p>
            <button class="cn" ><a href="register.php">JOIN US</a></button>
            <div class="form">
                <h2>Login Here</h2>
                <form method="POST"> 
                <input type="email" name="email" placeholder="Enter Email Here">
                <input type="password" name="pass" placeholder="Enter Password Here">
                <input class="btnn" type="submit" value="Login" name="login"></input>
                </form>
                <p class="link">Don't have an account?<br>
                <b>  <a href="register.php">Sign up </a> </b>here</a></p>
                <!-- <p class="liw">or<br>Log in with</p>
                <div class="icon">
                    &emsp;&emsp;&emsp;&ensp;<a href="https://www.facebook.com/"><ion-icon name="logo-facebook"></ion-icon> </a>&nbsp;&nbsp;
                    <a href="https://www.instagram.com/"><ion-icon name="logo-instagram"></ion-icon> </a>&ensp;
                    <a href="https://myaccount.google.com/"><ion-icon name="logo-google"></ion-icon> </a>&ensp;
                    
                </div> -->
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
