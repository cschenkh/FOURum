<?php //connect.php
  $server = 'localhost';
  $username   = 'MyUserName';
  $password   = 'SecurePassword';
  $database   = 'db123';

  try {
    // Attempt the connection
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    
    // configure the PDO error mode to throw exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    // No need to do anything special but output the error
    echo "Connection to database failed: " . $e->getMessage();
    return;
  }

?>
