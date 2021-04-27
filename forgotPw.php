


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


<section class="reg_section" style="margin-top:50px; height:250px;">


<form action="forgotValidate.php" method="post" style="margin-top:50px;">
<div class="error"> 
    <p style="color:red; font-size:16px;">
       <?php
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
               echo $_SESSION['error'];

               session_destroy();
          } 
       ?>
    </p>
    <p style="color:green; font-size:16px;">
       <?php
          if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
               echo $_SESSION['message'];

               session_destroy();
          } 
       ?>
    </p>
</div>
<label for="Email">Recovery Email</label>
<input
<?php
          if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
               echo "value= " .$_SESSION['email'];
               $_SESSION['email'] = "";

          }
?>

 type="text" placeholder="Input Email" name="email">

<button type="submit" name="submit">SEND PASSWORD</button><br><br>



</form>


</section>
    
</body>
</html>