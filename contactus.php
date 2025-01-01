<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/cont.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
    <title>Document</title>
    <style>
        body {
            background-image: url('images/lapbg.jpg'); /* Adjust the path to your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    
    <section class="contact">
        
        <div class="content">
            <h1
            style="
            padding: 5px;
            border-radius: 10px;
            background: linear-gradient(to top, rgb(255 255 255 / 60%) 50%,rgb(255 255 255 / 60%) 50%);
            "
            ><b>CONTACT US</b></h1>
           
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class="fas fa-map-marker" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Address</h3>
                            <p>Bengaluru<br>Karnataka<br>560067</p>
                        </div>
                 
                </div>
                <div class="box">
                    <div class="icon"><i class="fas fa-phone-alt" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Phone</h3>
                            <a href="tel:9448140164"><p>9448140164</p></a>
                        </div>
                 </div>
                 <div class="box">
                    <div class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Gmail</h3>
                            <a href="mailto:rentnrun1@gmail.com"><p>rentnrun1@gmail.com</p></a>
                        </div>
                 </div>

            </div>
            <div class="contactForm">
                <?php
                require 'config.php'; // SMTP configuration
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;  
                // Path to autoload.php from composer
                require './vendor/autoload.php';
                // PHP code to handle form submission and sending email
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $message = htmlspecialchars($_POST['message']);

                    send_mail($name, $email, $message, $username, $password, $host);
                }
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h2>Send Message</h2>
                    <div class="inputBox">
                        <input title="Fullname" type="text" name="name" required="required">
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input title="email" type="text" name="email" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea title="message" name="message" required="required"></textarea>
                        <span>Type your Message...</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="" value="Send">
                        <button class="btn" style="
                        /* width: 150px; */
                        border-radius: 10px;
                        background: orange;
                        color: #fff;
                        border: none;
                        cursor: pointer;
                        padding: 10px;
                        font-size: 18px;
                        margin-left:100px;">
                            <a href="index.php" style="
                            text-decoration: none;
                            color: #000000;">Go To Home</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

<?php


function send_mail($name, $email, $message, $username, $password, $host){
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = $host; 
        $mail->SMTPAuth = true;
        $mail->Username = $username; 
        $mail->Password = $password; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587; 
    
        //Recipients
        $mail->setFrom($username, 'RentNRun');
        $mail->addAddress($email, $name);
    
        //Content
        $mail->isHTML(true); 
        $mail->Subject = 'Contact Us Request';
        $mail->Body    = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contact Us Request Submitted</title>
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
        <h1>Contact Us Request</h1>
        <p>Hello, ' . htmlspecialchars($name) . '</p>
        <p>We have received your contact request. Here are the details:</p>
        <ul>
            <li><strong>Name:</strong> ' . htmlspecialchars($name) . '</li>
            <li><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>
            <li><strong>Message:</strong> ' . htmlspecialchars($message) . '</li>
        </ul>
        <p>We will get back to you as soon as possible. If you have any additional information to provide, please reply to this email.</p>
        <div class="footer">
            <p>Best regards,<br>Your Service Team<br><span class="highlight">RentNRun</span></p>
        </div>
        </div>
        </body>
        </html>';
    
        $mail->send();
        // echo '<p style="color: green;">Email has been sent successfully.</p>';
        echo '<script>  alert("Request submitted successfully.");</script>'; 
        echo '<script> window.location.href = "index.php";</script>'; 
    } catch (Exception $e) {
        echo '<p style="color: red;">Email could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</p>';
    }
}
?>

</html>
