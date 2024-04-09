<?php include ('connect/db.php'); ?>
<?php include ('connect/validation.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
 if(isset($_POST['Update'])){
    $id =$_POST['id'];
    $name =sanitize_input($_POST['name']);
    $price =sanitize_input($_POST['price']); 
    $detail =sanitize_input($_POST['detail']); 
    $img =$_FILES['img'];

    $img_loc = $_FILES['img']['tmp_name'];
    $img_name = $_FILES['img']['name'];
    $img_up  ="images/".$img_name;

    if(required_input($name) && required_input($price) && required_input($detail)){
        $sql="UPDATE product SET product_name='$name', product_price='$price',detail='detail',
            product_img='$img_up'WHERE product_id =$id";
        
        $stmt =mysqli_query($conn,$sql);

        if(move_uploaded_file($img_loc,'images/'.$img_name)){
            echo "<script>alert('successed update product')</script>";
        }else{
            echo "<script>alert('Not successed upload product')</script>";
        }   

        if($stmt){
            // echo "<script>alert('SUCCESSED UPDATE Element')</script>";
            redirect("index.php");
        }else{
            header("location:index.php");
        }
    }else{
        echo "<script>alert('Fields required')</script>";
        redirect("products.php");
        die;
    }
 }
}

