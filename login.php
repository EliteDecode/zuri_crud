


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

<h1>LOG IN</h1>
<form action="loginvalidate.php" method="POST">
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
               echo "value= " .$_SESSION['email'];
               $_SESSION['email'] = "";

          }
?>

 type="text" placeholder="Input Email" name="email">

<label for="password">password</label>
<input
<?php
          if(isset($_SESSION['password']) && !empty($_SESSION['password'])){
               echo "value=" .$_SESSION['password'];
               $_SESSION['password'] = "";

              
          }
?>

 type="password" name="password">
<button type="submit" name="submit">LOGIN</button><br><br>

<span>FORGOT PASSWORD?</span>
<a href="forgotPw.php">CLICK HERE</a> <br>
<a href="index.php">SIGN UP</a>



</form>


</section>
    
</body>
</html>