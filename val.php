<?php  session_start() ?>
<?php include ('connect/db.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD']==="GET"){
    if(isset($_GET['id'])){
        $id =$_GET['id'];

        $sql ="SELECT * FROM product WHERE product_id = $id";

        $Stmt = mysqli_query($conn,$sql);

        if(mysqli_num_rows($Stmt) <=0){
            echo "<script>alert('Not FOund ELement')</script>";
            header("refresh:2;url=shop.php");
        }else{
            $row = mysqli_fetch_assoc($Stmt);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    
    <title>Confirm</title>
    <style>
        input{
            display: none;
        }

        .main{
            width: 30%;
            padding: 20px;
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;

        }
    </style>
</head>
<body>
    <center>
      <div class="main">  
        <form action="insert_card.php" method="post" enctype="multipart/form-data">
            <h2>you want buy the Product...?</h2>
            <input type="text" name="id" value="<?php echo $row['product_id']; ?>"><br>
            <input type="text" name="name" value="<?php echo $row["product_name"]; ?>"><br>
            <input type="text" name="price" value="<?php echo $row['product_price']; ?>"><br>
            <input type="file" name="img" value="<?php echo $row['product_img']; ?>">
            <button name="car" type="submit" class="btn btn-warning">Confirm Product</button>
                <br>
            <a href="shop.php">Skip To Home</a>
        </form>
      </div>  
    </center>
</body>
</html>