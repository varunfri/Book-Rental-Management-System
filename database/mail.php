<?php
require 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Path to autoload.php from composer
require './vendor/autoload.php'; 
send_mail($username, $password, $host);
function send_mail($username, $password, $host){
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
        $mail->addAddress('vv137941@gmail.com', 'Recipient Name');

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Test Email using PHPMailer';
        $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laptop Rental Information</title>
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
            
            <h1>Laptop Rental Information</h1>
            <p>Hello [User`s Name]</p>
            
            <p>Thank you for choosing our laptop rental service. Here are the details of your rental:</p>
            
            <ul>
                <li><strong>Laptop Model:</strong> <?php $username ?></li>
                <li><strong>Rental Start Date:</strong> [Start Date]</li>
                <li><strong>Rental Duration:</strong> [Number of Days]</li>
                <li><strong>Total Rental Cost:</strong> [Total Cost]</li>
            </ul>
            
            <p>Please ensure that you review the terms and conditions of the rental agreement. If you have any questions or need further assistance, feel free to contact us at [Your Contact Information].</p>
            
            <p>Thank you again for choosing our services.</p>
            
            <div class="footer">
                <p>Best regards,<br>Your Rental Service Team<br><span class="highlight">RentNRun</span></p>
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
