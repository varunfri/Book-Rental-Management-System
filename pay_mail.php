<?php
            // function send_mail($email, $name, $book_date, $return_date, $price, $booking_status, $lap_name, $ram, $company) {
            
            function send_mail(){
            $mail = new PHPMailer(true);
            require 'config.php';
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
                $mail->addAddress( $email, 'Recipient Name');

                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Service Request Submitted';
                $mail->Body    = '
                <!DOCTYPE html>
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
        <p>Hello,' . htmlspecialchars($name) . '</p>
        <p>Here are the details of your booking:</p>
        <ul>
            <li><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>
            <li><strong>Booking Date:</strong> ' . htmlspecialchars($book_date) . '</li>
            <li><strong>Return Date:</strong> ' . htmlspecialchars($return_date) . '</li>
            <li><strong>Price:</strong> ₹' . htmlspecialchars($price) . '</li>
            <li><strong>Booking Status:</strong> ' . htmlspecialchars($booking_status) . '</li>
            <li><strong>Laptop Name:</strong> ' . htmlspecialchars($lap_name) . '</li>
            <li><strong>RAM:</strong> ' . htmlspecialchars($ram) . ' GB</li>
            <li><strong>Company:</strong> ' . htmlspecialchars($company) . '</li>
        </ul>
        <div class="laptop-image">
            <img src="' . htmlspecialchars($lapimage) . '" alt="Laptop Image">
        </div>
        <p>If you have any questions, please contact us at rentnrun1@gmail.com.</p>
        <div class="footer">
            <p>Best regards,<br>Your Service Team<br><span class="highlight">RentNRun</span></p>
        </div>
    </div>
</body>
</html>
';

                $mail->send();
                echo '<script>alert("Email has been sent") </script>';
                
            } catch (Exception $e) {
                echo '<script>alert("Email not sent") </script>', $mail->ErrorInfo;
            }
        }
        // header("Location: con.php");
        ob_end_flush();
        ?>