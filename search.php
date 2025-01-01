<?php
require_once('connection.php'); // Make sure to include your database connection file

if (isset($_GET['query'])) {
    $searchQuery = mysqli_real_escape_string($con, $_GET['query']);

    // SQL query to search for books based on the search query
    $sql = "SELECT * FROM books WHERE TITLE LIKE '%$searchQuery%' OR AUTHOR LIKE '%$searchQuery%' OR ISBN LIKE '%$searchQuery%'";
    $result = mysqli_query($con, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/logo.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    
    <style>
        body {
            background: url("../books/img_5.jpg") fixed;
            width: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
        }
        /* Style for modal preview */
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
        .h1 {
        text-align: center;
        border-radius: 10px;
        margin-left: auto;
        margin-right: auto;
        width: auto;
        height: auto;
        background: linear-gradient(to top, rgb(255 255 255 / 90%) 50%, rgb(255 255 255 / 90%) 50%);
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
            margin-top: 20px;
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
        
        /* Navbar styles */
        .navbar {
            width: 1200px;
            height: 75px;
            margin: 0px 50px;
        }

        .icon {
            width: 200px;
            float: left;
            height: 70px;
        }

        .menu {
            width: 400px;
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
            margin-left: 62px;
            margin-top: 15px;
            font-size: 14px;
        }

        ul li a {
            text-decoration: none;
            color: black;
            font-family: Arial;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        button {
            margin-top: 10px;
            border: 1px solid #fff;
            width: 120px;
            height: 40px;
            border-radius: 10px;
        }

        .book-container {
            border-radius:10px;
            display: inline-flex;
            align-items: center;
            margin:0px 10px  20px;
            background:#ebdedec2;
        }

        .book-info {
            margin:0px 20px;
        }

        .book-info h2 {
            margin-bottom: 5px;
        }

        .book-info p {
            margin-bottom: 5px;
        }

        .book-image {
            position: relative;
            width: 150px; /* Adjust size as needed */
            height: 200px; /* Adjust size as needed */
            overflow: hidden;
            border-radius:10px;
            
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
            /* margin-top: 120px; */
            margin: 120px auto 0px 120px ;
            
        }
    </style>

    <script src="https://www.google.com/books/jsapi.js"></script>
    <script src="../preview/books.js" type="text/javascript"></script>
</head>

<body>
    <div class="hai">
        <div class="navbar">
            <a href="#">
                <div class="icon">
                    <h2 class="logo">RentNRead</h2>
                </div>
            </a>
            <div>
                <ul>
                    <li><button><a href="lapdetails.php">BOOKS</a></button></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="book_info">
        <?php
        if (isset($result)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                     
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
                echo "<script>alert('NO BOOK Found');</script>";
                echo '<script> window.location.href = "lapdetails.php";</script>';
            }
        }
        ?>
    </div>

    <!-- Modal for displaying detailed book information -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modal-content"></div>
    </div>
</div>
</body>
</html>
