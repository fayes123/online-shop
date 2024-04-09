<?php include ('connect/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Online shop</title>
</head>
<body>
    <center>
        <div class="main">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <h2>Online Shop</h2>
                 <img src="img/Logo2.jpg" alt="Logo" width="400px">
                  
                  <input type="text" name="name" placeholder="Name product"><br>
                  <input type="text" name="price" placeholder="Price product"><br>
                                    
                  <textarea name="detail" id="area"  cols="50" rows="10" placeholder="Detail Product: .....etc "></textarea> 
                  <br>

                  <input type="file" id="file" name="img" hidden><!-- upload imag -->
                  <label for="file">Upload Photo</label> 
                  
                  <button name="Upload">$Upload Product</button><br>
                  <a href="products.php">Show All Products</a>
            </form>
        </div>
        <p>copy@right:Developper Mohamed fayed</p>
    </center>
</body>
</html>