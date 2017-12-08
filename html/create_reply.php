<?php // create_topic.php
  include 'connect.php';
  include 'header.php';

  echo '<h2>Write a Reply</h2>';
  if ($_SESSION['signed_in'] == false) {
    // the user is not signed in
    echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to reply.';
  }
  else {
    // the user is signed in
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      // the form hasn't been posted yet, display it
      // retrieve the categories from the database for use in the dropdown
      $sql = "SELECT
                cat_id,
                cat_name,
                cat_description
              FROM
                categories";

      $sqlNumResults = "SELECT
                          COUNT(*)
                        FROM
                          categories";

      $numResults = $conn->query($sqlNumResults);

      if (!$numResults) {
        // the query failed
        echo 'Error while selecting from database. Please try again later.';
      }
      else {
        if ($numResults->fetchColumn() <= 0) {
          // there are no categories, so topic can't be posted
          if ($_SESSION['user_level'] == 1) {
            echo 'You have not created categories yet.';
          }
          else {
            echo 'Before you can post a topic, you must wait for an admin to create some categories.';
          }
        }
        else {
          $result = $conn->query($sql);

          echo '<form method="post" action="">
                Subject: <br><input type="text" name="topic_subject" /><br>
                Category:';
          echo '<select name="topic_cat">';

          foreach ($result as $row) {
            echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
          }

          echo '</select><br>';

          echo 'Message: <br><textarea name="post_content" /></textarea><br>
                <input type="submit" value="Create Topic" />
                </form>';
        }
      }
    }
    else {
      // start the transaction
      $query = "BEGIN";
      $result = $conn->query($query);

      if (!$result) {
        // The query failed, quit
        echo 'An error occured while created your topic. Please try again later.';
      }
      else {
        // the form has been posted, so save it
        // insert the topic into topics table, we'll save the post into the posts table
        $sql = "INSERT INTO
                  topics(topic_subject,
                         topic_date,
                         topic_cat,
                         topic_by_id,
                         topic_by_name)
                  VALUES(" . $conn->quote($_POST['topic_subject']) . ", 
                        NOW(),
                        " . $conn->quote($_POST['topic_cat']) . ", 
                        " . $_SESSION['user_id'] . ",
                        " . $conn->quote($_SESSION['user_name']) . ")";
        try {
          $conn->exec($sql);
        } catch (PDOException $e) {
          // something went wrong, display the error
          echo 'An error occured while inserting your topic. Please try again later. ' . $e->getMessage();
          
          $sql = "ROLLBACK;";
          $result = $conn->query($sql);

          include 'footer.php';
          return;
        }
        
        $topicid = $conn->lastInsertId();

        $sql = "INSERT INTO
                posts(post_content,
                      post_date,
                      post_topic,
                      post_by_id,
                      post_by_name)
                VALUES
                  (" . $conn->quote($_POST['post_content']) . ", 
                  NOW(),
                  " . $topicid . ", 
                  " . $_SESSION['user_id'] . ",
                  " . $conn->quote($_SESSION['user_name']) . ")";

        try {
          $conn->exec($sql);
        } catch (PDOException $e) {
          echo 'An error occured while inserting your post. Try again later. ' . $e->getMessage();
          $sql = "ROLLBACK;";
          $result = $conn->query($sql);

          include 'footer.php';
          return;
        }

        $sql = "COMMIT;";
        $result = $conn->query($sql);

        echo 'You have successfully create <a href="/topic.php?id=' . $topicid . '">your new topic</a>.';
      }
    }
  }

  include 'footer.php';
?>
