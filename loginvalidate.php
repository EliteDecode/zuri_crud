<?php

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zuri_users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$password = $_POST['password'];
$email = $_POST['email'];


    //validation
    //We are increasing the error values if an is found 
    $error = 0;
    $email != ""  ?$_POST['email']:$error++;
    $password != "" ? $_POST['password']:$error++;



    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;


    if($error > 0){
        $_SESSION["error"] = "COMPLETE YOUR DETAILS";
        header("location:login.php");
    }else{

    $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $sql);
   

    if(mysqli_num_rows($result) === 1){
      
        $_SESSION['loggedIn'] = $result;
        header("location:Dashboard.php");
        
    }else{
        $_SESSION["error"] = "INVALID USER DETAILS PLEASE SIGN UP";
        header("location:login.php");
       
      die();
    }

  

}
?>