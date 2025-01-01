<?php 
    session_start(); // Start the session at the very beginning
    require_once('connection.php');

    if (!isset($_SESSION['email'])) {
        // Handle the case where the email is not set in the session
        echo "User is not logged in.";
        exit;
    }

    $value = $_SESSION['email'];

    $sql="SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows = mysqli_fetch_assoc($name);
    $uname = $rows['FNAME']." ".$rows['LNAME'];

    $sql2="SELECT * FROM books WHERE AVAILABLE='Y'";
    $books = mysqli_query($con,$sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/logo.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <script src="https://www.google.com/books/jsapi.js"></script>
    <style>
        /* General styles */
        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url("../books/img_5.jpg") fixed;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            overflow: hidden;
        }

        .navbar {
            width: 1200px;
            height: 75px;
            margin: auto;
        }

        .icon {
            width: 200px;
            float: left;
            height: 70px;
        }

        ul {
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        ul li {
            list-style: none;
            margin-left: 40px;
            margin-top: 27px;
            font-size: 14px;
        }

        ul li a {
            text-decoration: none;
            color: black;
            font-family: Arial;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        ul li a:hover {
            color: #7f95b2;
        }

        .navbar ul {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .nn {
            width: 100px;
            border: none;
            height: 40px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: black;
            transition: 0.4s ease;
        }

        .nn a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .overview {
            text-align: center;
            margin-top: 40px;
            margin-left: auto;
            margin-right: auto;
            width: 450px;
            border-radius: 10px;
            background: linear-gradient(to top, rgb(255 255 255 / 60%) 50%, rgb(255 255 255 / 60%) 50%);
        }

        .circle {
            border-radius: 48%;
            width: 65px;
        }

        .phello {
            width: 180px;
            margin-left: 0px;
            padding: 0px;
        }

        #stat {
            margin-left: -8px;
            font-weight: bold;
            font-size: 18px;
        }

        /* Book info/container */
        .book-container {
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            margin: 0px 10px 20px;
            width: 400px;
            background: #ebdedec2;
        }

        .book-info {
            margin: 0px 20px;
            width: 200px;
        }

        .book-info h2 {
            margin-bottom: 5px;
        }

        .book-info p {
            margin-bottom: 5px;
            font-size: 18px;
        }

        .book-image {
            position: relative;
            width: 150px; /* Adjust size as needed */
            height: 200px; /* Adjust size as needed */
            overflow: hidden;
            border-radius: 10px;
        }

        .book-image img {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .book-image:hover img {
            transform: scale(1.1); /* Example hover effect to enlarge image */
        }

        .book-actions {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .book-image:hover .book-actions {
            opacity: 1;
        }

        .book-actions button {
            background-color: #ff7200;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-right: 5px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .book-actions button:hover {
            background-color: #ff9f4d;
        }

        .book_info {
            margin:  20px  20px 20px 100px  ;
            padding: 10px;
            /* background: rgba(255, 255, 255, 0.8); */
            border-radius: 10px;
            overflow-y: scroll;
            height: calc(100vh - 200px); /* Adjust as needed */
        }

        .search-form {
            margin-left: 20px; /* Adjust margin as needed */
        }

        .search-form input[type="text"] {
            width: 200px;
            height: 40px;
            margin-top: 10px;
            padding: 0px 10px 0px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .search-form .search-button {
            height: 40px;
            padding: 5px 15px;
            background-color: #ff7200;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .search-form .search-button:hover {
            background-color: #e65c00; /* Darker shade of primary color */
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #c6c6c69e;
            margin: 2% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            max-width: 600px;
            border-radius: 10px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 25px;
            top: 17px;
            color: black;
            font-size: 38px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: red;
            text-decoration: none;
            cursor: pointer;
        }

        .h1 {
            text-align: center;
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
            width: auto;
            height: auto;
            background: linear-gradient(to top, rgb(255 255 255 / 90%) 50%, rgb(255 255 255 / 90%) 50%);
        }

        .imgs {
            max-width: 400px;
        }

        .loading-spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        button {
            margin-top: 10px;
            border: 1px solid #fff;
            width: 120px;
            height: 40px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="cd">
        <div class="main">
            <div class="navbar">
                <div class="icon">
                    <h2 class="logo">RentNRead</h2>
                </div>
                <div class="menu">
                    <ul>
                        <li>
                            <a href="service.php"><button id="stat" style="border:none;width:110px;height:40px;border-radius:10px;">
                                SERVICES
                            </button></a>
                        </li>
                        <li>
                            <a href="bookinstatus.php"> 
                                <button id="stat" style="border:none;width:100px;height:40px;border-radius:10px;">
                                STATUS
                                </button>
                            </a>
                        </li>
                        <li>
                            <form class="search-form" method="GET" action="search.php">
                                <span class="search-container">
                                    <input type="text" name="query" placeholder="Search ISBN/Author/Title">
                                </span>
                            </form>
                        </li>
                        <li>
                            <button style="border:none;width:fit-content;height:40px;border-radius:10px;">
                                <p class="phello">HELLO! &nbsp;
                                    <a id="pname"><?php echo $uname ?></a>
                                </p>
                            </button>
                        </li>
                        <li>
                            <a href="index.php"><button id="stat" class="nn">LOGOUT</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h1 class="overview">OUR BOOKS OVERVIEW</h1>
        <div class="book_info">
            <?php
            if (isset($books)) {
                if (mysqli_num_rows($books) > 0) {
                    while ($row = mysqli_fetch_assoc($books)) {
                        echo "<div class='book-container'>";
                        echo "<div class='book-image'>";
                        echo "<img src='images/{$row['BOOK_IMG']}' alt='{$row['TITLE']}'>";
                        echo "<div class='book-actions'>";
                        echo "<button onclick='previewBook(\"{$row['TITLE']}\", \"{$row['ISBN']}\")'>Preview</button>"; // Preview button
                        echo "<a href='booking.php?id={$row['BOOK_ID']}'><button>Rent</button></a>"; // Rent button
                        echo "</div>"; // Close book-actions
                        echo "</div>"; // Close book-image

                        echo "<div class='book-info'>";
                        echo "<h2>" . $row['TITLE'] . "</h2>";
                        echo "<p>Author: " . $row['AUTHOR'] . "</p>";
                        echo "<p>Price: ₹" . $row['PRICE'] . "</p>";
                        echo "<p>Genre: " . $row['GENRE'] . "</p>";
                        echo "<p>ISBN: " . $row['ISBN'] . "</p>";
                        // Add more information as needed
                        echo "</div>"; // Close book-info
                        echo "</div>"; // Close book-container
                    }
                } else {
                    echo "<p>No results found for '$searchQuery'</p>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Modal for displaying detailed book information -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modal-content">
            </div>
        </div>
    </div>

    <script src="../preview/books.js" type="text/javascript"></script>
</body>
</html>
