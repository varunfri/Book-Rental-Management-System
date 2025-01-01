<?php
require 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Path to autoload.php from composer
require './vendor/autoload.php';
require_once('connection.php');
$bookid=$_GET['id'];
$approval_date = date('Y-m-d');
//getting details from booking table
$sql="SELECT *from booking where BOOK_Id=$bookid";
$result=mysqli_query($con,$sql);
$res = mysqli_fetch_assoc($result);
$LAP_ID=$res['BOOK_ID'];

$email=$res['EMAIL'];

//getting the user details
$sql3 = "SELECT * from users where EMAIL='$email'";
$result3 = mysqli_query($con,$sql3);
$res3 = mysqli_fetch_assoc($result3);
$uname = $res3['FNAME']." ".$res3['LNAME'];

//getting details from laptop table
$sql2="SELECT *from books where BOOK_ID=$LAP_ID";
$carres=mysqli_query($con,$sql2);
$carresult = mysqli_fetch_assoc($carres); //refering the column
//get the details of the laptop
$lap_name = $carresult['TITLE'];
$lap_ram = $carresult['PRICE'];
$lap_pro = $carresult['AUTHOR'];

 
if($carresult['AVAILABLE']=='Y')
{
if($res['BOOK_STATUS']=='APPROVED' || $res['BOOK_STATUS']=='RETURNED')
{
    echo '<script>alert("ALREADY APPROVED")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}
else{
    $query="UPDATE booking set  BOOK_STATUS='APPROVED' where BOOK_ID=$bookid";
    $queryy=mysqli_query($con,$query);
    $sql_n="UPDATE books set AVAILABLE='N' where BOOK_ID=$res[BOOK_ID]";
    $query2=mysqli_query($con,$sql_n);
    
    echo '<script>alert("APPROVED SUCCESSFULLY")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
    send_mail($uname, $email, $approval_date, $lap_name, $lap_ram, $lap_pro, $username, $password, $host);
}  
}
else{
    echo '<script>alert("LAPTOP IS NOT AVAILABLE")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}

function send_mail($uname, $email, $approval_date, $lap_name, $lap_ram, $lap_pro, $username, $password, $host){
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
        $mail->setFrom($username, 'RentNRun');
        $mail->addAddress($email, 'Recipient Name');
    
        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Laptop Approval Status';
        $mail->Body    = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Approval Details</title>
        <style>
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
            ul {
                list-style-type: none;
                padding: 0;
            }
            ul li {
                margin-bottom: 10px;
            }
            ul li strong {
                display: inline-block;
                width: 120px;
            }
            .laptop-image {
                text-align: center;
                margin: 20px 0;
            }
            .laptop-image img {
                max-width: 100%;
                height: auto;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>
    <div class="container">
    <div class="logo">
        <img src="https://i.ibb.co/xhyJVPR/logo-1.png" alt="Company Logo">
    </div>
    <h1>Approval Details</h1>
    <p>Hello, ' . htmlspecialchars($uname) . '</p>
    <p>Your laptop approval details are as follows:</p>
    <ul>
        <li><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>
        <li><strong>Approval Date:</strong> ' . htmlspecialchars($approval_date) . '</li>
        <li><strong>Approval Status:</strong> Approved</li>
        <li><strong>Laptop Name:</strong> ' . htmlspecialchars($lap_name) . '</li>
        <li><strong>RAM:</strong> ' . htmlspecialchars($lap_ram) . ' GB</li>
        <li><strong>Processor:</strong> ' . htmlspecialchars($lap_pro) . '</li>
    </ul>
     
    <p>If you have any questions, please contact us at rentnrun1@gmail.com.</p>
    <div class="footer">
        <p>Best regards,<br>Your Service Team<br><span class="highlight">RentNRun</span></p>
    </div>
    </div>
    </body>
    </html>';
    
        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>