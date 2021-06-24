<?php
//Initializing db connection variables
$servername = "localhost";
$dbName = "db_members";
$username = "root";
$pwd = "";

//Creating Database connection
try{
  $conn = new PDO("mysql: host=$servername; dbname=$dbName", $username, $pwd);
  
  //set errror mode to execption
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection Failed: ". $e->getMessage();
}
?>