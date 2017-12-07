<?php

  include 'connect.php';
  include 'header.php';

  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo 'This operation is not allowed!';
  }
  else {
    // check if client is signed in
    if (!$_SESSION['signed_in']) {
      echo 'You must be signed in to reply!';
    }
    else {
      $sql = "INSERT INTO
                posts(post_content,
                      post_date,
                      post_topic,
                      post_by)
              VALUES ('" . $_POST['reply-content'] . "', 
                      NOW(), 
                      " . $conn->quote($_GET['id']) . ", 
                      " . $_SESSION['user_id'] . ")";

      try {
        $conn->exec($sql);
      } catch (PDOException $e) {
        echo 'Your reply was not able to be submitted! Please try again later.';
        
        include 'footer.php';
        return;
      }
      
      echo 'Your reply was submitted! See it <a href="topic.php>id=' . htmlentities($_GET['id']) . '">here</a>.';
    }
  }

  include 'footer.php';
?>
