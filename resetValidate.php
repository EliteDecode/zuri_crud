<?php

session_start();

$token = $_POST['token'];
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



    //For the sake of dinstiguishing users lets return them in arrays and call them.
    $registered_token = scandir("Database/tokkens/");
    $count_registered_token = count($registered_token);


    for($counter =0; $counter < $count_registered_token; $counter++){
        $new_token = $registered_token[$counter];
        if($new_token == $email. ".json"){
            $token_DB = file_get_contents('Database/tokkens/'. $new_token);
            $token_DB_decode = json_decode($token_DB);
            $token_DB_decoded = $token_DB_decode -> token;

         

           if($token_DB_decoded == $token){
            
            $registered_users = scandir("Database/file/");
            $count_registered_users = count($registered_users);

            
            for($counter =0; $counter < $count_registered_users; $counter++){
                $new_user = $registered_users[$counter];

                if($new_user == $email. ".json"){
                    $user_string = file_get_contents("Database/file/".$new_user);
                    $user_object = json_decode($user_string);
                    $user_object ->password = password_hash($password, PASSWORD_DEFAULT);

                    unlink('Database/file/'.$new_user);

                    file_put_contents('Database/file/'.$email. ".json", json_encode($user_object));

                    header('location:login.php');
                    die();


                }
            }


           }
         
        }
    }

    $_SESSION["error"] = $error . "No";
    header("location:index.php");

}

?>