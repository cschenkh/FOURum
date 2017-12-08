<?php // topic.php

  include 'connect.php';
  include 'header.php';

  // First check if the topic given the id exists
  $sql = "SELECT
            COUNT(*)
          FROM
            topics
          WHERE
            topic_id = " . $conn->quote($_GET['id']);

  // Check of general syntax and connection to DB
  if ($res = $conn->query($sql)) {
    // Check to see if there are any hits from the SELECT statement
    if ($res->fetchColumn() <= 0) {
      echo 'This topic does not exist!';
    }
    // Now that we know we know it exists, make the real query
    else {
      $sql = "SELECT
                topic_id,
                topic_subject
              FROM
                topics
              WHERE
                topic_id = " . $conn->quote($_GET['id']);

      // Iterate through the result(s) and list them on the page as html
      foreach ($conn->query($sql) as $row) {
        echo '<h2>Posts in ' . $row['topic_subject'] . ' </h2>';
      }

      // Now query for posts under this topic
      $sql = "SELECT
                post_content,
                post_date,
                post_by_id,
                post_by_name
              FROM
                posts
              WHERE
                post_topic = " . $conn->quote($_GET['id']);

      // Execute prepared statement and see if it failed
      if (!($result = $conn->query($sql))) {
        echo 'The topics could not be displayed, please try again.';
      }
      else {
        // prep the table
        echo '<table border="1">
              <tr>
                <th>Author</th>
                <th>Post</th>
              </tr>';

        foreach ($result as $row) {
          echo '<tr>';
          echo '<td class="postAuthor">';
          echo 'Written by: ' . $row['post_by_name'] . '<br />';
          echo date('m-d-Y', strtotime($row['post_date']));
          echo '</td><td class="postContent">';
          echo $row['post_content'];
          echo '</td>';
          echo '</tr>';
        }

        echo '</table>';
      }
    }
  }

?>
