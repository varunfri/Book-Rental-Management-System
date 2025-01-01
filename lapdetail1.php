<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url("images/lapbg.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .cd {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .icon {
            width: 200px;
            height: 70px;
        }

        .menu ul {
            display: flex;
            list-style-type: none;
        }

        .menu ul li {
            margin-left: 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .menu ul li a:hover {
            color: orange;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,.5);
            transition: transform 0.2s ease;
            overflow: hidden;
            cursor: pointer;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box .imgBx {
            text-align: center;
            margin-bottom: 10px;
        }
        img {
            max-width: 50%;
            height: auto;
            border-radius: 8px;
        }

        .box .imgBx  {
            /* max-width: 100%;
            height: auto;
            border-radius: 8px; */
        }

        .box .content {
            text-align: left;
        }

        .box h1, .box h2 {
            margin-bottom: 10px;
        } 
       
        

        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ff7200;
            border: none;
            color: white;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .button:hover {
            background-color: #e66000;
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
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 10px;
            top: 5px;
            color: black;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: red;
            text-decoration: none;
            cursor: pointer;
        }

        #modal-content p {
            margin-bottom: 10px;
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
                    <li><a href="lapdetails.php">HOME</a></li>
                    <li><a href="service.php">SERVICES</a></li>
                    <li><a href="index.php" class="button">LOGOUT</a></li>
                </ul>
            </div>
        </div>

        <div>
            <h1 class="overview">OUR BOOKS OVERVIEW</h1>
            <div class="grid-container">
                <?php
                // Example PHP to fetch and display laptop details
                require_once('connection.php');
                $sql = "SELECT * FROM laptops WHERE AVAILABLE='Y'";
                $laptops = mysqli_query($con, $sql);
                

                while ($result = mysqli_fetch_array($laptops)) {
                    ?>
                    <?php 
                    $lap_id = $result['LAP_ID'];
                    $lap_name = $result['LAP_NAME'];
                    $company = $result['COMPANY'];
                    $ram = $result['RAM'];
                    $processor = $result['processor'];
                    $price = $result['PRICE'];
                    ?>
                    <div class="box" >
                        <div class="imgBx">
                            <img src="images/<?php echo $result['LAP_IMG']; ?>" alt="<?php echo $result['LAP_NAME']; ?>">
                        </div>
                       <div class="content">
                            <h1><?php echo $result['LAP_NAME']; ?></h1>
                            <h2>COMPANY: <?php echo $result['COMPANY']; ?></h2>
                            <h2>RAM SIZE: <?php echo $result['RAM']; ?></h2>
                            <h2>PROCESSOR: <?php echo $result['processor']; ?></h2>
                            <h2>Rent Per Day: ₹<?php echo $result['PRICE']; ?>/-</h2> -->
                            <a href="booking.php?id=<?php echo $result['LAP_ID']; ?>" class="book_button">Book Now</a>
                        </div>  
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal for displaying detailed laptop information -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modal-content"></div>
    </div>
</div>

<script>
    // JavaScript functions to handle modal display
    
    function showDetails(lapId) {
        // You can customize this function to fetch more details via AJAX if needed
        var modal = document.getElementById('modal');
        var modalContent = document.getElementById('modal-content');
        modal.style.display = "block";
        modalContent.innerHTML = `
        <style>
        h2{
        text-align:center;
        }
        </style>
            <h2>Laptop Details</h2>

            <p>Display details for Laptop ID: ${lapId}</p>
            <p> </p>
        `;
    }

    function closeModal() {
        var modal = document.getElementById('modal');
        modal.style.display = "none";
    }
</script>

</body>
</html>
