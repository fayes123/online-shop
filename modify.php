<?php include ('connect/db.php'); ?>
<?php include ('connect/validation.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['id'])){
        $id =$_GET['id'];

        $sql ="SELECT * FROM product WHERE product_id =$id";

        $stmt = mysqli_query($conn, $sql);

        if(!$stmt){
            header("location:admin.php");        
        }
        
        if(mysqli_num_rows($stmt) <=0 ){
            echo "<script>alert('Not found Element')</script>";
            redirect("products.php");
            die;
        }
    }
}

$row = mysqli_fetch_assoc($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Update Product</title>
</head>
<body>
    <center>
        <div class="main">
            <form action="up.php" method="post" enctype="multipart/form-data">
                <h2>Update Product</h2>
                 <img src="img/Logo2.jpg" alt="Logo" width="400px">
                  
                  <input type="text" name="id" value="<?php echo $row['product_id']; ?>">
                  <input type="text" name="name" value="<?php echo $row['product_name']; ?>"><br>
                  <input type="text" name="price" value="<?php echo $row['product_price']; ?>"><br>
                  
                  <textarea name="detail" id="area" cols="50" rows="10"><?php echo $row['detail']; ?></textarea> 
                  <br>

                  <input type="file" id="file" name="img" hidden><!-- upload imag -->
                  <label for="file"value=" <?php echo $row["product_img"]; ?>">Upload New Photo</label> 
                  
                  <button name="Update" type="sumbit">Update Product</button><br>
                  <a href="products.php">Show Products</a>
            </form>
        </div>
        <p>copy@right:Developper Mohamed fayed</p>
    </center>
</body>
</html>