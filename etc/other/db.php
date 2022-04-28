<?php
$servername = "localhost";
// Mysql connnection creds
$username = "";
$password = "";

try {
  $db = new PDO("mysql:host=$servername;dbname=iauth_host", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?> 
