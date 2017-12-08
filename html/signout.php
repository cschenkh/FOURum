<?php
  include 'connect.php';
  include 'header.php';

  $_SESSION = array();

  echo 'You have been signed out.';
  echo '<br /><br />';
  echo '<a href="/index.php">Click here to go back to the main page</a>';

  include 'footer.php';
?>
