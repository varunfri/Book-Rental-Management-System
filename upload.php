<?php
if(isset($_POST['addlap']) ){
    require_once('connection.php');
   echo "<prev>";
   print_r($_FILES['image']);
   echo "</prev>";
   $img_name= $_FILES['image']['name'];
   $tmp_name= $_FILES['image']['tmp_name'];
   $error= $_FILES['image']['error'];
    if($error === 0){
        $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
        $img_ex_lc= strtolower($img_ex);
        $allowed_exs = array("jpg","jpeg","png","webp","svg");
        if(in_array($img_ex_lc,$allowed_exs)){
            $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
            $img_upload_path='images/'.$new_img_name;
            move_uploaded_file($tmp_name,$img_upload_path);
                $title=mysqli_real_escape_string($con,$_POST['book_title']);
                $author=mysqli_real_escape_string($con,$_POST['author']);
                $genre=mysqli_real_escape_string($con,$_POST['genre']);
                $price=mysqli_real_escape_string($con,$_POST['price']);
                $isbn = mysqli_real_escape_string($con,$_POST['isbn']);
                $available="Y";
                $query="INSERT INTO books(TITLE,AUTHOR,GENRE,PRICE,BOOK_IMG,AVAILABLE,ISBN) values('$title','$author','$genre',$price,'$new_img_name','$available','$isbn')";
                $res=mysqli_query($con,$query);
                if($res){
                    echo '<script>alert("New Book Added Successfully!!")</script>';
                    echo '<script> window.location.href = "adminlaptop.php";</script>';                }
        }else{
            echo '<script>alert("Cant upload this type of image")</script>';
            echo '<script> window.location.href = "addlap.php";</script>';   
        }
    }
    else{
        $em="unknown error occured";
        header("Location: addlap.php?error=$em");
    }
}
else{
    echo "false";
}



?>
