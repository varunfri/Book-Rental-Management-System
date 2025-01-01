<?php
require 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './vendor/autoload.php';
require_once('connection.php');
$bid=$_GET['id'];
$book_id=$_GET['bookid'];



//booking details
$sql2="SELECT *from booking where BOOK_Id=$book_id";
$result2=mysqli_query($con,$sql2);
$res2 = mysqli_fetch_assoc($result2);
//details from booking table
$uemail = $res2['EMAIL'];
$book_date=$res2['BOOK_ATE'];
$return_status=$res2['_STATUS'];
$return_date = date('Y-m-d');
// $return_date = $res2['RETURN_DATE'];


//laptop details
$sql="SELECT *from books where BOOK_ID=$bid";
$result=mysqli_query($con,$sql);
$res = mysqli_fetch_assoc($result);
//details from laptop table
$lap_name=$res['TITLE'];
$lap_ram = $res['AUTHOR'];
$lap_pro = $res['PRICE'];


//user details
$sql3 = "SELECT * from users where EMAIL='$uemail'";
$result3 = mysqli_query($con,$sql3);
$res3 = mysqli_fetch_assoc($result3);
$uname = $res3['FNAME']." ".$res3['LNAME'];


if($res['AVAILABLE']=='Y')
{
    echo '<script>alert("ALREADY LAPTOP IS RETURNED")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}
else{
    
    $sql4="UPDATE books set AVAILABLE='Y' where BOOK_ID=$res[BOOK_ID]";
    $query2=mysqli_query($con,$sql4);
    $sql5="UPDATE booking set BOOK_STATUS='RETURNED' where BOOK_ID=$res2[BOOK_ID]";
    $query=mysqli_query($con,$sql5);
    echo '<script>alert("BOOK RETURNED SUCCESSFULLY")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
    send_mail($uname, $uemail, $book_date, $return_date, $return_status, $lap_name, $lap_ram, $lap_pro,$username, $password, $host);
}  

function send_mail($uname, $uemail, $book_date, $return_date, $return_status, $lap_name, $lap_ram, $lap_pro,$username, $password, $host){
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
        $mail->addAddress($uemail, 'Recipient Name');

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Laptop Return Status';
        $mail->Body    = '
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Return Details</title>
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
                
            </style>
        </head>
        <body>
        <div class="container">
        <div class="logo">
            <img src="https://i.ibb.co/xhyJVPR/logo-1.png" alt="Company Logo">
        </div>
        <h1>Return Details</h1>
        <p>Hello, '.htmlspecialchars($uname).'</p>
        <p>Your laptop return details are as follows:</p>
        <ul>
            <li><strong>Email:</strong> ' . htmlspecialchars($uemail) . '</li>
            <li><strong>Booking Date:</strong> ' . htmlspecialchars($book_date) . '</li>
            <li><strong>Return Date:</strong> ' . htmlspecialchars($return_date) . '</li>
            <li><strong>Return Status:</strong> Returned </li>
            <li><strong>Laptop Name:</strong> ' . htmlspecialchars($lap_name) . '</li>
            <li><strong>RAM:</strong> ' . htmlspecialchars($lap_ram) . ' GB</li>
            <li><strong>Processor:</strong> ' . htmlspecialchars($lap_pro) . '</li>
        </ul>
        <p>If you have any questions, please contact us at rentnrun1@gmail.com.</p>
        <div class="footer">
            <p>Best regards,<br>Your Service Team<br><span class="highlight">RentNRead</span></p>
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