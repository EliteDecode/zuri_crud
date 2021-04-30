<?php

//connecting to sql
//Creating the database
//creating table

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection


// Create database
$sql = "CREATE DATABASE crud";
if ($conn->query($sql) === TRUE) {
}


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

// sql to create table
$sql = "CREATE TABLE data (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
course VARCHAR(30) NOT NULL,
track VARCHAR(30) NOT NULL
)";





$id = 0;
$track = "";
$course = "";
$update = false;

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
    $update = true;
    $sql = "SELECT * FROM data WHERE id = $id ";
    $result = $conn->query($sql);
   
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $course = $row['course'];
    $track = $row['track'];
}
}

  

if(isset($_POST['update'])){
  $id = $_POST['id'];
  $course = $_POST['course'];
  $track = $_POST['track'];

  $sql = "UPDATE data SET course='$course', track='$track' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
  $_SESSION['message'] = "COURSE UPDATED SUCCESSFULLY";
  header("location:Dashboard.php");
  } else {
    echo "Error updating record: " . $conn->error;
}

  
}

?>
