<?php

////////////////////// connect database ///////////////////

$name_server="localhost";
$user_name="root";
$password="";
$name_db="online shope";

$conn =mysqli_connect($name_server, $user_name, $password, $name_db);

if(!$conn){
    die(print_r(mysqli_connect_error(), true));
}
