<?php session_start();?>
<?php include('connect/db.php'); ?>
<?php include('connect/validation.php'); ?>

<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['submit'])){
    
      $password =$_POST['password'];
      $email =$_POST['email'];

      if(required_input($password) && required_input($email)){        
         
         $sql ="SELECT * FROM users WHERE user_email ='$email' AND password = '$password'";
         $Stmt = mysqli_query($conn, $sql);

         if(!$Stmt){
            die('Problem.....!');
         }

         if(mysqli_num_rows($Stmt) > 0){
            $row = mysqli_fetch_assoc($Stmt);

            if($row['user_name'] === "admin" && $row['password'] === "11219960"){
               header("location:admin.php");
            }else{
               $_SESSION['user_id'] = $row['user_id'];
               header("location:shop.php");
            }

         }else{
            $message[]="Incorrect email or password";
         }

      }else{
         $message[]="Fields Requird";
      }
      
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      input{
         text-align: center;
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>تسجيل الدخول</h3>
      <input type="text" name="email" placeholder="البريد الالكتروني" class="box">
      <input type="password" name="password"  placeholder="كلمة المرور" class="box">
      <input type="submit" name="submit" class="btn" value="تسجيل الدخول">
      <p>هل تملك حساب بالفعل؟ <a href="register.php"> حساب جديد</a></p>
   </form>

</div>

</body>
</html>