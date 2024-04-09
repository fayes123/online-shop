<?php session_start();  ?> 
<?php include ('connect/db.php'); ?>
<?php

$user_id =$_SESSION['user_id'];

if(!isset($user_id)){
header("location:index.php");
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['car'])){
        $id = $_POST['id'];
        $name =$_POST['name'];
        $price = $_POST['price'];

        $res ="SELECT product_img FROM product WHERE product_id = $id";
        $data =mysqli_query($conn, $res);

        $row = mysqli_fetch_assoc($data);

        $img = $row['product_img'];

        $sql = "INSERT INTO card (user_id,card_name, card_price, card_img)
              VALUES($user_id,'$name', '$price', '$img')";
        
        $Stmt = mysqli_query($conn, $sql);

        if(move_uploaded_file($img_loc, 'imgs/'.$img)){
            echo "<script>alert('successed upload product')</script>";
        }else{
            echo "<script>alert('Not successed upload product')</script>";
        }

        if(!$Stmt){
            print_r(mysqli_connect_error(), true);
            header("refresh:2;url=shop.php");
        }else{
            header("location:card.php");        
        }
    }
}

