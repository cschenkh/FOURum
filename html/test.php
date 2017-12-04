<?php //test.php

  $dir = 'sqlite:' . getcwd() . '/../FOURum.db';

  $dbh = new PDO($dir) or die('cannot open the db');
  $query = 'SELECT * FROM users';
  foreach ($dbh->query($query) as $row) {
    echo $row[0];
  }

?>
