<?php  session_start(); ?>
<?php include ('connect/db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/card.css"> 
    <link rel="stylesheet" href="css/style.css"> 
    <title>My Card</title>
</head>

<body>

<center>
    <h2>My Products</h2>
</center>

<?php

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header("location.index.php");
}

    $sql = "SELECT * FROM card WHERE user_id = $user_id";

    $Stmt = mysqli_query($conn, $sql);

    if(!$Stmt){
        print_r(mysqli_connect_error(), true);
        header("refresh: 2; url=shop.php");
    }else{
        if(mysqli_num_rows($Stmt) <=0){
            echo "<script>alert('Not found Products') </script>";
            header("refresh: 2; url=shop.php");
            die;
        }
    }
    
  function TotalPrice(){  
        global $conn;
        global $user_id;

    $query ="SELECT card_price FROM card WHERE user_id =$user_id";
    $result=mysqli_query($conn, $query);

    if(mysqli_num_rows($result)<=0){
        header("location:shop.php");
    }else{
        $TPrice=0;
        while($Datat = mysqli_fetch_assoc($result)){
            $TPrice += $Datat['card_price'];
        }
        return $TPrice ." "."$";
    }
}
?>
    <center>
        <main>
            <table class="table">
                <thead>
                    <tr>
                        <td scope='col'>Name Product</td>
                        <td scope='col'>Price Product</td>
                        <td scope='col'>Photo Product</td>
                        <td scope='col'>Delete Product</td>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($Stmt)):  ?>   
                        <tr>
                            <td> <?php echo $row['card_name']; ?> </td>
                            <td> <?php echo $row['card_price']; ?> </td>
                            <td> <img src="<?php echo $row['card_img']; ?> " alt="Product Photo" width="60px"> </td>
                            <td><a href="del_card.php?id= <?php echo $row['card_id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>            
                </tbody>


                <tfoot>
                    <tr>
                        <td colspan="4">Total Price: <?php echo TotalPrice(); ?> </td>
                    </tr>
                    <tr class="table-bottom">
                        <td colspan="4"><a href="shop.php?delete_all" onclick="return confirm('حذف كل المنتجات من العربة?');" class="delete-btn <?php echo (TotalPrice() > 1)?'':'disabled'; ?>">Delete ALL</a></td>
                    </tr>    
                </tfoot>
                

            </table>
        </main>

        <a href="shop.php">Show ALL Products</a>
    </center>

</body>
</html>