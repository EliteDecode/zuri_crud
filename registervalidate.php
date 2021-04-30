<?php



session_start();

include('connections.php');


$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$password = $_POST['password'];
$email = $_POST['email'];


    //validation
    //We are increasing the error values if an is found 
    $error = 0;
    $first_name != "" ? $_POST['firstname']:$error++;
    $last_name != "" ? $_POST['lastname']:$error++;
    $email != ""  ?$_POST['email']:$error++;
    $password != "" ? $_POST['password']:$error++;


    $_SESSION['firstname'] = $first_name;
    $_SESSION['lastname'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

 
    

    //redirecting if error is found and passing a message
    if($error > 0){
        $_SESSION["error"] = "COMPLETE YOUR DETAILS";
        header("location:index.php");
    }else{

    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $_SESSION["error"] = " $email.  ALREADY EXITS";
        header("location:index.php");
        
    }else{
        $sql = "INSERT INTO users (first_name, last_name, email, password)
        VALUES ('$first_name', '$last_name', '$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        } 

        header("location:login.php");

        die();
    }

}

?>



