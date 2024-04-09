<?php include ('connect/validation.php')?>

<?php
include ('connect/db.php');

if(isset($_POST['Upload'])){
    $name =sanitize_input($_POST['name']);
    $price =sanitize_input($_POST['price']);
    $details =trim(sanitize_input($_POST['detail']));

    $IMAGE =$_FILES['img'];

    $img_loc = $_FILES['img']['tmp_name'];
    $img_name = $_FILES['img']['name'];
    $img_up  ="images/".$img_name;
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['Upload'])){
        if(required_input($name) && required_input($price) && required_input($details)){
            $query ="INSERT INTO product (product_name, product_price ,product_img,
            detail) VALUES('$name', '$price', '$img_up', '$details')";

            $stmt = mysqli_query($conn, $query);

            if(!$stmt){
                print_r(mysqli_connect_error());
                header("refresh:3 ;url = admin.php");
            }

            if(move_uploaded_file($img_loc, 'images/'.$img_name)){
                echo "<script>alert('successed upload product')</script>";
            }else{
                echo "<script>alert('Not successed upload product')</script>";
            }
            
        }else{
            echo "<script>alert('Fields required')</script>";
            
        }
            redirect("admin.php");
        

    }
}else{
    header("loaction:admin.php");
}

