<!DOCTYPE html>
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
      <div id="userbar">Hello Test123. Not you? Log out.</div>
      </div>
      
      <div id="content">
      </div><!-- content -->
      </div><!-- wrapper -->
      
      <div id="footer">Created for MEEEEE!!!!</div>
  </body>
</html>

<?php
  $error = false;
  if($error = false) {
    //the beautifully styled content, everything looks good
    echo '<div id="content">some text</div>';
  }
  else {
    //bad looking, unstyled error :-( 
  } 
?>
