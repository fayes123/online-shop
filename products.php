<?php include ('connect/db.php'); ?>
<?php include ('connect/validation.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/prod.css">
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Show Products</title>
</head>
<body>

<?php

    $sql ="SELECT * FROM product";

    $Stmt = mysqli_query($conn, $sql);

    if(mysqli_num_rows($Stmt) <=0){
        echo "<script>alert('Database is Empty.....!')</script>";
        redirect("admin.php");
    }
  
?>
     <center>
        <h2>Control panel Admin</h2>
    </center> 
    <center>
        <main>
            <?php if(mysqli_num_rows($Stmt) > 0): ?>
                <?php while($rows = mysqli_fetch_assoc($Stmt)): ?> 
                    <div class="card" style="width: 15rem;">
                            <img src="<?php echo $rows['product_img'] ?>" class="card-img-top"> <!-- imag -->
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $rows['product_name']; ?> </h5> <!-- name -->
                                <p class="card-text"> <?php echo $rows['product_price']; ?> </p><!-- price -->
                                <p class="card-text"> <?php echo $rows['detail']; ?> </p><!-- detail -->
                                <a href="delete.php?id= <?php echo $rows['product_id']; ?>" class="btn btn-danger">Delete</a>
                                <a href="modify.php?id= <?php echo $rows['product_id'] ?>" class="btn btn-primary">Modify</a>
                            </div>      
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>    
        </main>
</body>
</html>