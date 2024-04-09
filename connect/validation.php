<?php

function redirect($str){
    return header("refresh: 3;url=$str");
}

function required_input($str){
    $value=trim($str);

    if(empty($value)){
        return false;
    }
    return true;
}

function sanitize_input($str){
    filter_var($str,FILTER_SANITIZE_STRING);
    return $str;
}

function valid_E_mail($Email){
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true;
}


function Same_pass($pass, $pass1){
    if($pass1 !=$pass){
        return false;
    }
    return true;
}


function max_input($str, $max){
    if(strlen($str)> $max ){
        return false;
    }
    return true;
}


function min_input($str,$min){
    if(strlen($str) < $min){
        return false;
    }
    return true;
}