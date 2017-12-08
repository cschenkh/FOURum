<!DOCTYPE html>

<?php
  session_start();
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="description." />
    <meta name="keywords" content="key, words" />
    <title>PHP-MySQL forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <div id="nav-bar">
      <a class="nav-item" href="/index.php">Home</a>
      
      <?php
        if ($_SESSION['signed_in']) {
          echo '<a class="nav-item" style="float: right; border-right: none;" href="signout.php">Sign Out</a>';
          echo '<a class="nav-item" style="float: right"> Hello, ' . $_SESSION['user_name'] . '</a>';
        }
        else {
          echo '<a class="nav-item" style="float: right; border-right: none;" href="/signup.php">Sign Up</a>
            <a class="nav-item" style="float: right" href="/signin.php">Sign In</a>';
        }
      ?>
    </div>
    <h1>FOURum</h1>
      <div id="wrapper">
      <div id="menu">
        <a class="item" href="/create_topic.php">Create a topic</a> -
        <a class="item" href="/create_cat.php">Create a category</a>

        <div id="userbar">
      
        </div>
      </div>

