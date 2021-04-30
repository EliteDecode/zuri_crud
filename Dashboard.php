<?php


  if(isset($_SESSION['loggedIn'])){
    header("location:Dashboard.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<?php include_once 'processCrud.php' ;?>

<section class="dashboard">

<section class="side_bar">
    <div class="side_bar_header">
         <h3>Student Dashboard</h3>
    </div>

     <div class="side_bar_list">
         <ul>
             <li><a href="">Course</a></li>
             <li><a href="logout.php">Logout</a></li>
             <li><a href="">Reset Password</a></li>
         </ul>
     </div>
</section>
<section class="main_bar">
 <div class="main_bar_header">
     <h3>ZURI STUDENT DASHBOARD</h3>
 </div>

 <div class="main_bar_content">

 <div class="error"> 
    <p style="color:red; font-size:16px; margin-left:60px; margin-top:10px;">
       <?php
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
               echo $_SESSION['error'];

               session_destroy();
          }
       ?>
    </p>
    <p style="color:green; font-size:16px; margin-left:60px; margin-top:10px;">
       <?php
          if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
               echo $_SESSION['message'];

               session_destroy();
          }
       ?>
    </p>
</div>

         
<?php
     
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "crud";

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }


     $sql = "SELECT * FROM data";
     $result = mysqli_query($conn, $sql);

 ?>


 <table style="margin-left:30px;">
      <thead>
         <tr>
             <th>COURSE TITLE</th>
             <th>COURSE TRACK</th>
             <th rowspan='2'>ACTION</th>
         </tr>
      </thead>

 <?php while($row = $result->fetch_assoc()): ?>
      <tr>
         <td> <?php echo $row['course'];?>  </td>
         <td> <?php echo $row['track'];?></td>
         <td><a href="Dashboard.php?edit=<?php echo $row['id']; ?>" class ="edit_btn">Edit</a>
        <a href="processCrud.php?delete=<?php echo $row['id']; ?>" class="delete_btn">delete</a></td>
      </tr>
      <?php endwhile; ?>
 </table>

<form action="processCrud.php" method= "POST">

      <input type="hidden" name="id" value = "<?php echo $id ?>">
         <label for="course"></label>
         <input
          value = "<?php echo  $course ?>"
          type="text" placeholder="ADD COURSE" name="course">


         <input
         value = "<?php echo $track; ?>"
          type="text" placeholder="ADD COURSE TRACK" name="track">
         
         <?php if($update == true):?>
         <button type="submit" name="update">UPDATE COURSE</button>
         <?php else: ?>
        <button type="submit" name="add">ADD COURSE</button>
        <?php endif ?>



     </form>

 </div>
  
</section>
</section>
    
</body>
</html>