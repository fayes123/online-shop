<?php include ('connect/db.php'); ?>
<?php include ('connect/validation.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD'] === "GET"){
    $id=$_GET['id'];

    $query = "Select * FROM product WHERE product_id = $id";
    $res=mysqli_query($conn, $query);    
    
    
    $sql = "DELETE FROM product WHERE product_id = $id";
    $stmt = mysqli_query($conn, $sql);

    if(!$stmt){
        echo "<script>alert('problem .....!')</script>";
        redirect("products.php");
    
    }else{
        if(mysqli_num_rows($res) > 0){
       
            echo "<script>alert('Deleted SUCCESSFULLY')</script>";
            header("location:products.php");
       
        }else{
            echo "<script>alert('Not Deleted SUCCESSFULLY')</script>";
            redirect("products.php");
        }
    }


    
}

?>