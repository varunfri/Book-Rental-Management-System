<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>REGISTRATION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
   <link rel="stylesheet" href="css/regs.css" type="text/css">
</head>
<body>
    
<?php
    require 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './vendor/autoload.php';
    require_once('connection.php');
    if(isset($_POST['regs']))
    {
        $fname=mysqli_real_escape_string($con,$_POST['fname']);
        $lname=mysqli_real_escape_string($con,$_POST['lname']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $ph=mysqli_real_escape_string($con,$_POST['ph']);
        $pass=mysqli_real_escape_string($con,$_POST['pass']);
        $cpass=mysqli_real_escape_string($con,$_POST['cpass']);
        $gender=mysqli_real_escape_string($con,$_POST['gender']);
        // $Pass=md5($pass);
        if(empty($fname)|| empty($lname)|| empty($email)|| empty($ph)|| empty($pass) || empty($gender))
        {
            echo '<script>alert("please fill the place")</script>';
        }
        else{
            if($pass==$cpass){
            $sql2="SELECT *from users where EMAIL='$email'";
            $res=mysqli_query($con,$sql2);
            if(mysqli_num_rows($res)>0){
                echo '<script>alert("EMAIL ALREADY EXISTS PRESS OK FOR LOGIN!!")</script>';
                echo '<script> window.location.href = "index.php";</script>';

            }
            else{
            $sql="insert into users (FNAME,LNAME,EMAIL,PHONE_NUMBER,PASSWORD,GENDER) values('$fname','$lname','$email',$ph,'$pass','$gender')";
            $result = mysqli_query($con,$sql);
            send_mail($fname, $lname, $cpass,$username,$email, $password, $host);
            if($result){
                echo '<script>alert("Registration Successful Press ok to login")</script>';
                echo '<script> window.location.href = "index.php";</script>';       
              }
            else{
                echo '<script>alert("please check the connection")</script>';
            }
        
            }

            }
            else{
                echo '<script>alert("PASSWORD DID NOT MATCH")</script>';
                echo '<script> window.location.href = "register.php";</script>';
            }
        }

      }
    function send_mail($fname, $lname, $cpass,$username,$email, $password, $host){
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = $host; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = $username; // SMTP username
        $mail->Password = $password; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom($username, 'RentNRead');
        $mail->addAddress($email, 'Recipient Name');

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Welcome to RentNRun';
        $mail->Body    = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to RentNRead</title>
        <style>
            /* Reset styles */
            body, h1, p {
                margin: 0;
                padding: 0;
            }
            
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                background-color: #f4f4f4;
                padding: 20px;
            }
            
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            
            h1 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
            }
            
            p {
                font-size: 16px;
                color: #666;
                margin-bottom: 20px;
            }
            
            .highlight {
                color: #007bff;
                font-weight: bold;
            }
            
            .footer {
                margin-top: 20px;
                border-top: 1px solid #ccc;
                padding-top: 10px;
                font-size: 14px;
                color: #666;
                text-align: center;
            }
            
            .logo {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .logo img {
                max-width: 500px;
                height: auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <img src="https://i.ibb.co/xhyJVPR/logo-1.png" alt="Company Logo">
            </div>
            
            <h1>Welcome to RentNRead!</h1>
            <p>Hello, '.htmlspecialchars($fname . " " . $lname).'</p>
            
            <p>Thank you for signing up with RentNRead. We are excited to have you on board. Here are some details of your registration:</p>
            
            <ul>
                <li><strong>Username:</strong>'. htmlspecialchars($email) .'</li>
                <li><strong>Password:</strong>  '. htmlspecialchars($cpass) .'</li>
            </ul>
            
            <p>Please review our <a href="https://www.termsandconditionsgenerator.com/live.php?token=4Qb6otmZOJm6KtDERQDwqjrSVavWkKSh">terms and conditions</a> 
            to ensure a smooth experience. If you have any questions or need assistance, 
            feel free to reach us rentnrun@gmail.com </p>
          
            <p>We look forward to serving you with the best laptop rental services.</p>
            
            <div class="footer">
                <p>Best regards,<br>Your Rental Service Team<br><span class="highlight">RentNRead/span></p>
            </div>
        </div>
    </body>
    </html>
    ';

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

    }


?>

  <style>
    body{  
        width: 100%;
        background-repeat: no-repeat fixed;
        /* background-position: center; */
        background-size: cover;
        height: 100vh;
    }
          input#psw{
        width:300px;
        border:1px solid #ddd;
        border-radius: 3px;
        outline: 0;
        padding: 7px;
        background-color: #fff;
        box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
    }
    input#cpsw{
        width:300px;
        border:1px solid #ddd;
        border-radius: 3px;
        outline: 0;
        padding: 7px;
        background-color: #fff;
        box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
    }
      #message {
      display:none;
      background: #f1f1f1;
      color: #000;
      position: relative;
      padding: 20px;
      
      width: 400px;
      margin-left:1000px;
      margin-top: -500px;
    }

    #message p {
      padding: 10px 35px;
      font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
      color: green;
    }

    .valid:before {
      position: relative;
      left: -35px;
      content: "✔";
    }

    /* Add a red text color and an "x" icon when the requirements are wrong */
    .invalid {
      color: red;
    }

    .invalid:before {
      position: relative;
      left: -35px;
      content: "✖";
}</style> 

    <button id="back"><a href="index.php">HOME</a></button>
    <!-- <h1 id="fam">JOIN OUR FAMILY OF BOOKS!</h1> -->
 <div class="main">
        
        <div class="register">
        <h2>Register Here</h2>
        
        <form id="register" action="register.php" method="POST">    
            <label>First Name : </label>
            <br>
            <input type ="text" name="fname"
            id="name" placeholder="Enter Your First Name" required>
            <br>

            <label>Last Name : </label>
            <br>
            <input type ="text" name="lname"
            id="name" placeholder="Enter Your Last Name" required>
            <br> 

            <label>Email : </label>
            <br>
            <input type="email" name="email"
            id="name" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex: example@ex.com"placeholder="Enter Valid Email" required>
            <br> 

            <label>Phone Number : </label>
            <br>
            <input type="tel" name="ph" maxlength="10" onkeypress="return onlyNumberKey(event)"
            id="name" placeholder="Enter Your Phone Number" required>
            <br> 

            

            <label>Password : </label>
            <br>
            <input type="password" name="pass" maxlength="12"
            id="psw" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <br> 
            <label>Confirm Password : </label>
            <br>
            <input type="password" name="cpass" 
            id="cpsw" placeholder="Renter the password" required>
            <br> 
            <tr>
                <td><label">Gender : </label></td><br>
                 <td>
                    <label for="one">Male</label>
                    <input type="radio" id="input_enabled" name="gender" value="male" style="width:50px">
                </td> 
                <td>
                    <label for="two">Female</label>
                    <input type="radio" id="input_disabled" name="gender" value="female" style="width:50px" />
                </td>
            </tr>
            <br><br>

            <input type="submit" class="btnn"  value="REGISTER" name="regs" style="background-color: #ff7200;color: white">
            
        
        
        </input>
            
        </form>
        </div> 
    </div>
    <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>  
<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
</body>
</html>