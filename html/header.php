<!DOCTYPE html>

<?php 
  session_start();  
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="description." />
    <meta name="keywords" content="key, words" />
    <title>PHP-SQLite forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <h1>My forum</h1>
      <div id="wrapper">
      <div id="menu">
        <a class="item" href="/forum/index.php">Home</a> -
        <a class="item" href="/forum/create_topic.php">Create a topic</a> -
        <a class="item" href="/forum/create_cat.php">Create a category</a>

        <div id="userbar">
      
        <?php
          if (isset($_SESSION['signed_in']) && $_SESSION['signed_in']) {
            echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="signout.php">Sign out</a>';
          }
          else {
            echo '<a href="signin.php">Sign in</a> or <a href="signup.php">create an account</a>.';
          }
        ?>
        
        </div>

