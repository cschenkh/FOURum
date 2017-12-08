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
                      post_by_id,
                      post_by_name)
              VALUES ('" . $_POST['reply-content'] . "', 
                      NOW(), 
                      " . $conn->quote($_GET['id']) . ", 
                      " . $_SESSION['user_id'] . ",
                      " . $conn->quote($_SESSION['user_name']) . ")";
    }

    try {
      $conn->exec($sql);
    } catch (PDOException $e) {
      echo 'Your reply was not able to be submitted! Please try again later.';
      
      include 'footer.php';
      return;
    }
      
    echo '<script type="text/javascript">location.href = "/topic.php?id=' . $_GET['id'] . '";</script>';
  }

  include 'footer.php';
?>
