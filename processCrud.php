<?php

session_start();




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

$track = "";
$course = "";

    



if(isset($_POST['add'])){
    $course = $_POST['course'];
    $track = $_POST['track'];



    $error = 0;
    $course != "" ? $_POST['course']:$error++;
    $track != "" ? $_POST['track']:$error++;


    $_SESSION['course'] = $course;
    $_SESSION['track'] = $track;

    if($error > 0){
        $_SESSION["error"] = "ADD COURSE TITLE/TRACK";
        header("location:Dashboard.php");
    }else{

    $sql = "INSERT INTO data (course, track)
    VALUES ('$course', '$track')";
    
    
    if ($conn->query($sql) === TRUE) {
      
    $_SESSION['message'] = "COURSE ADDED SUCCESSFULLY";
    header("location:Dashboard.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    die();

}


}

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
  
  $sql = "DELETE FROM data WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
    
  $_SESSION['error'] = "COURSE DELETED SUCCESSFULLY";
  header("location:Dashboard.php");

  die();
  
}







if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql = "SELECT * FROM data WHERE id = $id ";
    $result = $conn->query($sql);
   
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $track = $row['track'];
    $course = $row['course'];

    header("location:Dashboard.php");
  }
} else {
  echo "0 results";
}

die();
  }



?>
