<?php

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zuri_users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



$password = $_POST['password'];
$email = $_POST['email'];


   
    $error = 0;
    $token != "" ? $_POST['token']:$error++;
    $password != "" ? $_POST['password']:$error++;
    $email != ""  ?$_POST['email']:$error++;

    
    $_SESSION['token'] = $token;
    $_SESSION['email'] = $email;



    
    //redirecting if error is found and passing a message
    if($error > 0){
        $_SESSION["error"] = $error . " EMPTY FIELD FOUND";
        header("location:resetPw.php");
    }else{


    
    $_SESSION["error"] = $error . "No";
    header("location:index.php");

}

?>