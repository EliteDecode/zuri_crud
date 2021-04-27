


<?php
 session_start();

 if(!isset($_GET['token'])  && !isset($_SESSION['token'])){
    $_SESSION['error'] = "NO AVAILABLE TOKEN FOR THIS USER";
    header("location:login.php");
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>


<section class="reg_section">

<h1>Password Reset</h1>
<form action="resetValidate.php" method="POST">
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

<label for="Email">Email</label>
<input 
<?php
    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        echo "value=" . $_SESSION['email'];
        $_SESSION['email'] = "";
    }

?>

type="text" placeholder="Input Email" name="email">


<label for="password">New password</label>
<input type="password" name="password">

<input type="hidden" name="token"
 <?php
     if(isset($_SESSION['token'])){
         echo "value = ". $_SESSION['token'];
     }else{
         echo "value =". $_GET['token'];
     }
 ?>>


<button type="submit" name="submit">RESET</button><br><br>



</form>


</section>
    
</body>
</html>