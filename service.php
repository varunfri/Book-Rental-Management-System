<?php 
require_once('connection.php');
session_start();

$value = $_SESSION['email'];
$_SESSION['email'] = $value;

$sql = "SELECT * FROM users WHERE EMAIL='$value'";
$name = mysqli_query($con, $sql);
$rows = mysqli_fetch_assoc($name);
$sql2 = "SELECT * FROM books WHERE AVAILABLE='Y'";
$books = mysqli_query($con, $sql2);
$uname = $rows['FNAME']." ". $rows['LNAME'];
$uemail = $rows['EMAIL'];
$sql3 = "SELECT * FROM booking WHERE BOOK_STATUS='APPROVED'";
$ser_book = mysqli_query($con, $sql3);
$app_bks = mysqli_fetch_assoc($ser_book);
if ($app_bks == null) {
    $ap_book = "No Books";
} else {
    $ap_book = $app_bks['BOOK_ID'];
}
$sql4 = "SELECT * FROM books WHERE BOOK_ID='$ap_book'";
$app_book = mysqli_query($con, $sql4);

// Perform insert into database
if (isset($_POST['submit'])) {
    // Sanitize and validate form inputs
    $book_name = mysqli_real_escape_string($con, $_POST['book']);
    $req_type = mysqli_real_escape_string($con, $_POST['requestType']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $req_date = date('Y-m-d');

    // Validate required fields
    if (empty($book_name) || empty($req_type) || empty($message)) {
        echo '<script>alert("Please fill in all fields.")</script>';
    } else {
        // Insert into service table
        $sql = "INSERT INTO service (name, email, book, req_type, message, req_date) 
                VALUES ('$uname', '$uemail', '$book_name', '$req_type', '$message', '$req_date')";

        if (mysqli_query($con, $sql)) {
            // Optionally, redirect to a confirmation page
            echo '<script>alert("Service Request Submitted");</script>'; 
            echo '<script>window.location.href = "lapdetails.php";</script>'; 
            exit;
        } else {
            echo '<script>alert("Failed to submit service request. Please try again.")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Rental Service</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("../books/img_5.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            overflow: hidden;
        }

        .home-btn {
            position: absolute;
            top: 20px;
            font-size: 20px;
            left: 20px;
            background-color: #ff7200;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 16px;
            transition: opacity 0.3s ease;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .blur-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: blur(20px);
            z-index: -1;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form {
            width: 300px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
        }

        .form h2 {
            text-align: center;
            color: black;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .form input[type="text"],
        .form input[type="email"],
        .form textarea,
        .form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ff7200;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .form input[type="submit"]:hover {
            background-color: #ff9f1a;
        }
    </style>
</head>
<body>
<a href="lapdetails.php" class="home-btn">Home</a>
    <div class="blur-background"></div>

    <div class="container">
        <form class="form" method="POST" onsubmit="return validateForm()">
            <h2>Book Rental Request</h2>
            <input type="text" required id="username" name="name" value="<?php echo $uname ?>" readonly>
            <input type="text" required id="username" name="email" value="<?php echo $uemail?>" readonly>
            <select name="book" required id="book">
                <option value="">Select Book</option>
                <?php while ($book = mysqli_fetch_assoc($app_book)) { ?>
                    <option value="<?php echo $book['TITLE']; ?>">
                        <?php echo $book['TITLE']; ?></option>
                <?php } ?>
            </select>
            <select name="requestType" required id="requestType">
                <option value="">Select Request Type</option>
                <option value="Rental">Rental</option>
                <option value="Return">Return</option>
                <option value="Renewal">Renewal</option>
            </select>
            <textarea rows="5" name="message" required id="msg" placeholder="Your Message"></textarea>
            <input type="submit" value="Submit" name="submit"> 
        </form>
    </div>

    <script>
        function validateForm() {
            var book = document.getElementById("book").value.trim();
            var requestType = document.getElementById("requestType").value.trim();
            var message = document.getElementById("msg").value.trim();

            if (book === "") {
                alert("Please select a book.");
                return false;
            }

            if (requestType === "") {
                alert("Please select a request type.");
                return false;
            }

            if (message === "") {
                alert("Please enter your message.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
