<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN</title>
    <!-- <link rel="stylesheet" href="css/adlog.css">     -->
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
</head>
<body>
<style>

body{
    width: 100%;
    background-image: url("books/img_3.webp");
    background-repeat: no-repeat fixed;
    /* background-position: center; */
    background-size: cover;
    overflow: hidden;
    height: 100vh;
}

.form{
    width: 300px;
    height: 400px;
    background: linear-gradient(to top, rgb(239 239 239 / 80%) 50%,rgb(239 239 239 / 80%) 50%);
    position: absolute;
    top:200px;
    left:800px;
    border-radius: 10px;
    padding: 20px;
    

}

.form h2{
    width:90%;
    font-family: sans-serif;
    text-align: center;
    color: orange;
    font-size: 22px;
    background-color: hwb(0deg 0% 100% / 50%);
    border-radius: 10px;
    margin: 2px;
    padding: 8px;

}

 .h{
    width: 100%;
    height: 75px;
    background: transparent;
    border-bottom: 1px solid #ff7200;
    border-top: none;
    border-right: none;
    border-left:none;
    color:black;
    
    font-size: 15px;
    letter-spacing: 1px;
    margin-top: 30px;
    font-family: sans-serif;
}
.h:focus{
    outline: none;
}

::placeholder{
    color:black;
    font-family: Arial;
    
}

.btnn{
    width: 300px;
    height: 40px;   
    
    background: #ff7200;
    border:none;
    margin-top: 70px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
  
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

.form .link{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 17px;
    padding-top: 20px;
    text-align: center;
    color: #fff;
}

.form .link a{
    text-decoration: none;
    color:#ff7200
}



.helloadmin{
    width: -100px;
    height: 100%;
    margin-top: 10px;
    text-align: center;
}
.helloadmin h1{
    margin-top: 650px;
    margin-left: 10px;
    display: inline;
    font-family: 'Times New Roman';
    font-size: 50px;
    color: white;
}

.back{
    width: 100px;
    height: 40px;   
    background: #ff7200;
    border:none;
    margin-top: 20px;
    margin-left:30px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
}

.back a{
    text-decoration: none;
    color: black;
    font-weight: bold;
}
</style>

<?php
    require_once('connection.php');
    if(isset($_POST['adlog'])){
        $id=$_POST['adid'];
        $pass=$_POST['adpass'];
        
        
        if(empty($id)|| empty($pass))
        {
            echo '<script>alert("Enter Credentials!")</script>';
        }

        else{
            $query="select *from admin where ADMIN_ID='$id'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['ADMIN_PASSWORD'];
                if($pass  == $db_password)
                {
                    
                    // session_start();
                    // $_SESSION['email'] = $email;
                    echo '<script>alert("Welcome ADMINISTRATOR!");</script>';
                    header("location: admindash.php");
                    
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



<button class="back"><a href="index.php">Home</a></button>
    <div class="helloadmin">
    <h1>HELLO ADMIN!</h1></div>

    <form class="form" method="POST">
        <h2>Admin Login</h2>
        <input class="h" type="text" name="adid" placeholder="Enter Admin User Id">
        <input class="h" type="password" name="adpass" placeholder="Enter Admin Password">
        <input type="submit" class="btnn" value="LOGIN" name="adlog" >
    </form>
</body>
</html>