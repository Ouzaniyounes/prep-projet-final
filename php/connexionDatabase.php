<?php 
// Hadi bach ykherjouli les Erorr
ini_set('display_errors', 1);
$servername ="localhost";
$dbname = "Platforme-Vente";
$username="root";
$password = "";


try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
  } catch(Exception $e) {
    echo "Connection failed: " . $e->getMessage();
  }






?>