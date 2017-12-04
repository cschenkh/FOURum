<?php // connect.php

  $dir = 'sqlite:' . getcwd() . '/../FOURum.db';

  $dbh = NULL;

  try {
    $dbh = new PDO($dir) or die('cannot open the db');
  } catch (Exception $e) {
    exit('Error: failed to connect to db');
  }

?>
