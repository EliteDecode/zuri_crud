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




$email = $_POST['email'];


    //validation
    //We are increasing the error values if an is found 
    $error = 0;
    $email != ""  ?$_POST['email']:$error++;
    $_SESSION['email'] = $email;

    if($error > 0){
        $_SESSION['error'] = "EMPTY FIELD FOUND";
        header("location:forgotPw.php");
    }else{
 
      
    $sql = "SELECT email FROM users WHERE email = '$email' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) === 1){

            $token = "";

            $token_selection = ['a', 'b', 'c', 'd', 'e', 1 , 3 , 2, 5 , 'A', 'B', 'C' , 'D'];

            for($i=0; $i< 30; $i++){
                $index = mt_rand(0, count($token_selection)-1);

                $token .= $token_selection[$index];
            }

            $subject = "Password Reset Link";
            $message = "Requested password link from your account, ignore if you didnt request or visit: localhost/zuri_task_sql/resetPw.php?token=".$token;
            $headers = "From: no-reply@snh.org" . "\r\n" .
            "CC: seyi@snh.org";

            $sql = "INSERT INTO users ( first_name, last_name, email, password, token) VALUES ( '', '', '', '', '$token') ";
            
            if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            };
   
            
            $mail = mail($email,$subject,$message,$headers);

            if($mail){
                $_SESSION['message'] = "RESET LINK SENT TO ". $email;
                header("location:forgotPw.php");
            }else{
                $_SESSION['error'] = "EMAIL NOT SENT ";
                header("location:forgotPw.php");

            }
            die();
        
    }

    $_SESSION['error'] = "INVALID EMAIL ID";
    header("location:forgotPw.php");


   
}