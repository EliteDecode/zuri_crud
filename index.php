<?php

session_start();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>


<section class="reg_section">

<h1>Registration Page</h1>
<form action="registervalidate.php" method="post">
    <!--We are getting the message from the foraction.php-->
<div class="error"> 
    <p style="color:red; font-size:16px;">
       <?php
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
               echo $_SESSION['error'];

               session_destroy();
          }
       ?>
    </p>
</div>

<!-- The PHP attached here is to retain the value of the form when refreshed -->

<label for="firstname">Firstname</label> 
<input 

<?php
          if(isset($_SESSION['firstname']) && !empty($_SESSION['firstname'])){
               echo  "value=" . $_SESSION['firstname'];
                $_SESSION['firstname'] = ''; 
          }
 ?>

type="text" placeholder="Input Firstname" name="firstname">

<label for="lastname">Lastname</label>
<input 
   <?php
    if(isset($_SESSION['lastname']) && !empty($_SESSION['lastname'])){
        echo "value=" . $_SESSION['lastname'];
        $_SESSION['lastname'] = "";
    }
   ?>

type="text" placeholder="Input Lastname" name="lastname">

<label for="password">password</label>
<input 
<?php
    if(isset($_SESSION['password']) && !empty($_SESSION['password'])){
        echo "value=" . $_SESSION['password'];
        $_SESSION['password'] = "";
    }

?>

type="password" name="password">

<label for="Email">Email</label>
<input 
<?php
    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        echo "value=" . $_SESSION['email'];
        $_SESSION['email'] = "";
    }

?>

type="text" placeholder="Input Email" name="email">

<button type="submit" name="submit">SUBMIT</button>
</form>


</section>
    
</body>
</html>