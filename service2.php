<?php
require_once('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize and validate form inputs
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $req_type = mysqli_real_escape_string($con, $_POST['requestType']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($category) || empty($req_type) || empty($message)) {
        echo '<script>alert("Please fill in all fields.")</script>';
    } else {
        // Insert into service table
        $sql = "INSERT INTO service (name, email, category, req_type, message) 
                VALUES ('$name', '$email', '$category', '$req_type', '$message')";
        
        if (mysqli_query($con, $sql)) {
            echo '<script>alert("Service request submitted successfully.")</script>';

            // Send email notification
            sendMail($name, $email, $category, $req_type, $message);
            
            // Optionally, redirect to a confirmation page
            // header("Location: confirmation.php");
            // exit;
        } else {
            echo '<script>alert("Failed to submit service request. Please try again.")</script>';
        }
    }
}

function sendMail($name, $email, $category, $req_type, $message) {
    require './vendor/autoload.php'; // Path to autoload.php from composer
    require 'config.php';
    
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
        $mail->addAddress($email, $name); // Recipient email and name

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Service Request Submitted';
        $mail->Body    = '<p>Hello '.$name.',</p>'.
                         '<p>Thank you for submitting your service request. Here are the details:</p>'.
                         '<p><strong>Category:</strong> '.$category.'</p>'.
                         '<p><strong>Request Type:</strong> '.$req_type.'</p>'.
                         '<p><strong>Message:</strong> '.$message.'</p>'.
                         '<p>We will review your request and get back to you shortly.</p>'.
                         '<p>Best regards,<br>Your Rental Service Team<br><strong>RentNRun</strong></p>';

        $mail->send();
        echo '<script>alert("Email notification sent.")</script>';
    } catch (Exception $e) {
        echo '<script>alert("Email could not be sent. Mailer Error: '.$mail->ErrorInfo.'")</script>';
    }
}
?>
