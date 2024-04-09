<?php include ('connect/db.php'); ?>
<?php

if($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        
        $sql ="SELECT * FROM card WHERE card_id =$id";
        $query =mysqli_query($conn, $sql);

        if(!$query){
            header("location:card.php");
        }else{

            if(mysqli_num_rows($query) > 0){
                $res ="DELETE FROM card WHERE card_id = $id";
                $Stmt = mysqli_query($conn, $res);
                header("location:card.php");

                if(!$Stmt){
                    header("location:card.php");
                }
            }else{
                echo "<script>alert('Not found ELement')</script>";
                header("refresh:2;url=card.php");
            }
        }
    }
}
