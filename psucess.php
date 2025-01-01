<html>
  <head>
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  </head>
<style>
            body {
                text-align: center;
                /* padding: 40px 0; */
                background-image: url("images/ps.png");
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                
            }
            h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
            }
            p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size:20px;
            margin: 0;
            }
            i {
                color: #9ABC66;
                font-size: 100px;
                line-height: 200px;
                margin-left:-15px;
            }
            .card {
                background: white;
                padding: 60px;
                border-radius: 4px;
                box-shadow: 0 2px 3px #C8D0D8;
                display: inline-block;
                margin-top: 100px;
               


            }


            
            #back{
                width: 150px;
                height: 40px;
                background: #ff7200;
                border:none;
                margin-top: 10px;
                margin-left: 65px;
                font-size: 18px;
            

            }

            #back a{
                text-decoration: none;
                color: black;
                font-weight: bold;
            }
            .ba{
                width: 1px;
                
            }
 </style>
<body>
       
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>We received your rental request;<br/> we'll be in touch shortly!</p>
        <div class="ba"><button name ="send" id="back"><a href="lapdetails.php">Search BOOKS</a></button></div>
        
      </div>
<?php

    require 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './vendor/autoload.php';
    require_once('connection.php');

    session_start();
    $email=$_SESSION['email'] ;
    
    $sql="select *from booking where EMAIL='$email' order by BOOK_ID DESC ";
    $cname = mysqli_query($con,$sql);
    $book = mysqli_fetch_assoc($cname);  
    $book_id=$book['BOOK_ID'];
    $to = $book['EMAIL'];
    // $book_id = $book['BOOK_ID'];
    $book_date = $book['BOOK_DATE'];
    $return_date = $book['RETURN_DATE'];
    $price = $book['PRICE'];
    $booking_status = $book['BOOK_STATUS'];
    
    $sql2="select *from users where EMAIL='$to' ";
    $colname = mysqli_query($con,$sql2);
    $usname = mysqli_fetch_assoc($colname);  
    $name = $usname['FNAME'].$usname['LNAME'];

    $sql3 = "select * from books where BOOK_ID='$book_id'";
    $cname = mysqli_query($con,$sql3);
    $book_det = mysqli_fetch_assoc($cname);
    $title = $book_det['TITLE'];
    $author = $book_det['AUTHOR'];
    $genre = $book_det['GENRE'];
    $price = $book_det['PRICE'];

 
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
    $mail->addAddress('vv137941@gmail.com', 'Recipient Name');
    // $mail->addAddress($to, 'Recipient Name'); // this is to send the copy for user mail
    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Laptop Booking Details';
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Details</title>
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
            <h1>Booking Details</h1>
            <p>Hello, ' . htmlspecialchars($name).'</p>
            <p>Here are the details of your booking:</p>
            <ul>
                <li><strong>Email:</strong> ' . htmlspecialchars($to) . '</li>
                <li><strong>Booking Date:</strong> ' . htmlspecialchars($book_date) . '</li>
                <li><strong>Return Date:</strong> ' . htmlspecialchars($return_date) . '</li>
                <li><strong>Price:</strong> ₹' . htmlspecialchars($price) . '</li>
                <li><strong>Booking Status:</strong> ' . htmlspecialchars($booking_status) . '</li>
                <li><strong>Brand:</strong> ' . htmlspecialchars($author) . '</li>
                <li><strong>Laptop Name:</strong> ' . htmlspecialchars($title) . '</li>
                <li><strong>RAM:</strong> ' . htmlspecialchars($genre) . ' GB</li>
                <li><strong>ID:</strong> ' . htmlspecialchars($book_id) . '</li>
            </ul>
            
            <p>If you have any questions, please contact us at rentnrun1@gmail.com.</p>
            <div class="footer">
                <p>Best regards,<br>Your Service Team<br><span class="highlight">RentNRun</span></p>
            </div>
        </div>
    </body>
    </html>';

    $mail->send();
     
    } catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
 
?>
</body>
</html>
