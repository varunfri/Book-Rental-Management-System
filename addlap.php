<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link  rel="stylesheet" href="css/logo.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <script type="text/javascript" src="../preview/no_back.js"> </script>
</head>
<body>
<style>
    *{
        margin: 0;
        padding: 0;

    }
    body{
        background-image: url("../books/img_4.jpg");
        background-repeat: no-repeat fixed;
        background-size: cover;
        background-position: center;
        /* margin-top: 0px; */
        
    }
    .main{
        width: 400px;
        margin: 100px auto 0px auto;
        margin-top: 30px;
    }
    .btnn{
        width: 240px;
        height: 40px;
        background: #ff7200;
        border:none;
        margin-top: 30px;
        margin-left: 40px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        color:#fff;
        transition: 0.4s ease;
    }

    .btnn:hover{
        background: #fff;
        color:#ff7200;
    }

    .btnn a{
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    h2{
        text-align: center;
        padding: 20px;
        font-family: sans-serif;

    }
    .register{
        background-color: rgba(0,0,0,0.6);
        width: 100%;
        font-size: 18px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: 2px 2px 15px rgba(0,0,0,0.3);
        color: #fff;
        margin: auto;

    }

    form#register{
        margin: 40px;
        margin-top: 10px;

    }

    label{
        font-family: sans-serif;
        font-size: 18px;
        font-style: italic;
    }

    input#name{
        width:300px;
        border:1px solid #ddd;
        border-radius: 3px;
        outline: 0;
        padding: 7px;
        background-color: #fff;
        box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
    }


    #back{
        border-radius: 10px;
        width: 100px;
        height: 40px;
        background: #ff7200;
        margin-top: 10px;
        margin-left: 20px;
        font-size: 18px;
    

    }


    #back a{
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    #fam{
        color: #ff7200;
        font-family: 'Times New Roman';
        font-size: 50px;
        padding-left: 20px;
        margin-top:-10px;
        text-align: center;
        letter-spacing: 2px;
        display: inline;
        margin-left: 250px;
    }

    .reg{
        width: 100%;
    }



</style>
<button id="back"><a href="adminlaptop.php">HOME</a></button> 
    
 <div class="main">
        
        <div class="register">
        <h2>Enter Details of Book</h2>
        <form id="register"  action="upload.php" method="POST" enctype="multipart/form-data">    
            <label>TITLE : </label>
            <br>
            <input type ="text" name="book_title"
            id="name" placeholder="Enter Book Title" required>
            <br><br>

            <label>AUTHOR : </label>
            <br>
            <input type ="text" name="author"
            id="name" placeholder="Enter Author Name" required>
            <br><br>

            <label>GENRE : </label>
            <br>
            <input type="text" name="genre"
            id="name" placeholder="Enter genre" required>
            <br><br>

            <label>ISBN-10 : </label>
            <br>
            <input type="text" name="isbn" maxlength='10'
            id="name" placeholder="Enter ISBN-10" required>
            <br><br>

            <label>PRICE : </label>
            <br>
            <input type="number" name="price"
            id="name" placeholder="Enter Price" required>
            <br><br>
            <!-- <label>Price : </label>
            <br>
            <input type="number" name="price" min="1"
            id="name" placeholder="Enter Price Of Laptop for One Day(in rupees)" required>
            <br><br> -->

            <label>Book Image : </label>
            <br>
            <input type="file" name="image" required>
           <br><br>

            <input type="submit" class="btnn"  value="ADD LAPTOP" name="addlap">
            </input>
            
        </form>
        </div> 
    </div.main>
</body>
</html>