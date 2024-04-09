<?php session_start();?>

<?php include ('connect/db.php'); ?>
<?php include ('connect/validation.php'); ?>

<?php

$user_id =$_SESSION['user_id'];

if(!isset($user_id)){
    header("location:index.php");
};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header("location:index.php");
};

if(isset($_GET['delete_all'])){
    $qu ="DELETE FROM card WHERE user_id = $user_id";
    $fetch_card = mysqli_query($conn, $qu);
    header("location.shop.php");
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/prod.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Show Products</title>
</head>
 <style>
    #aa{
        margin-left: 70px;
        text-decoration: none;
         color: white; 
    }
</style>
<body>

<?php

    $sql ="SELECT * FROM product";

    $Stmt = mysqli_query($conn, $sql);

    if(mysqli_num_rows($Stmt) <=0){
        echo "<script>alert('Database is Empty.....!')</script>";
        redirect("admin.php");
    }

   
?>

<div class="container">

<div class="user-profile">

   <?php

      $select_user ="SELECT * FROM users wHERE user_id = $user_id" or die('query filed'); 

    //   mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
    
    $select = mysqli_query($conn, $select_user);
    
    if(mysqli_num_rows($select) > 0){
         $fetch_user = mysqli_fetch_assoc($select);
      };
   ?>

   <p>المستخدم الحالي : <span><?php echo $fetch_user['user_name']; ?></span> </p>
   <div class="flex">
      <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('هل أنت متأكد أنك تريد تسجيل الخروج؟');" class="delete-btn">تسجيل الخروج</a>
   </div>

</div>

    <nav class="navbar navbar-dark bg-dark">
        <a id="aa" class="navbar-brand" href="card.php">My Card</a>

    </nav>

     <center>
        <h2>ALL Products</h2>
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
                                <a href="val.php?id= <?php echo $rows['product_id']; ?>" class="btn btn-success" >Add TO Card</a>
                            </div>      
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>    
        </main>
</body>
</html>