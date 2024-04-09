<?php include('connect/db.php'); ?>
<?php include('connect/validation.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['submit'])){
        $name = sanitize_input($_POST['name']);
        $email = $_POST['email'];
        $password = trim($_POST['password']);
        $Cpass = trim($_POST['cpassword']);

      if(required_input($name) && required_input($email) && required_input($password) && required_input($Cpass)){  
            if(valid_E_mail($email)){
                if(Same_pass($password,$Cpass)){
                    // $newpass=password_hash($password,0);
                

                    if(max_input($name,50) && min_input($name, 3)){
                        if(min_input($password,8) && max_input($password,20)){
                            
                            $sql ="SELECT * FROM users WHERE user_email ='$email' 
                                AND password = '$password'";

                             $Stmt =mysqli_query($conn, $sql);

                             if(!$Stmt){
                                die('Problem....!');
                             }

                            if(mysqli_num_rows($Stmt) > 0){
                                $message[]="User Already Exits";
                            }else{
                                $res = "INSERT INTO users(user_name, user_email,password)
                                    VALUES('$name', '$email', '$password')";
                                
                                $res = mysqli_query($conn, $res);
                                header("location:index.php");
                                    
                            }
                        }else{
                            $message[]="password maxlenght 20 and minlenght 8 Digits";
                        }

                    }else{
                        $message[]="name maxlenght 50 and minlenght 3 Digits";
                    }

                }else{
                 $message[]="Password not Same";               
                }

            }else{
                $message[]="Please enter a valid Email";
            }   
        
      }else{
        $message[]="the Fields is required.....!";
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
   <title>register</title>

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
      <h3>انشاء حساب جديد</h3>
      <input type="text" name="name" required placeholder="اسم السمتخدم" class="box">
      <input type="email" name="email" required placeholder="البريد الالكتروني" class="box">
      <input type="password" name="password" required placeholder="كلمة المرور" class="box">
      <input type="password" name="cpassword" required placeholder="تأكيد كلمة المرور" class="box">
      <input type="submit" name="submit" class="btn" value="تسجيل حساب">
      <p>هل لديك حساب؟ <a href="index.php"> تسجيل دخول</a></p>
   </form>

</div>

</body>
</html>