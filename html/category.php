<?php

  include 'connect.php';
  include 'header.php';

  // first select category based on $_GET['cat_id']
  $sql = "SELECT
            COUNT(*)
          FROM
            categories
          WHERE
            cat_id = " . PDO::quote($_GET['id']);

  // Check if query succeeds
  if ($res = $conn->query($sql)) {  
    // Check if there aren't any columns representing the number of hits the SELECT statement would have found
    if ($conn->fetchColumn() <= 0) {
      echo 'This category does not exist!';
    }
    // Now that we know we have things we can select, make the real query
    else {
      $sql = "SELECT
                cat_id,
                cat_name,
                cat_description
              FROM
                categories
              WHERE
                cat_id = " . PDO::quote($_GET['id']);

      // Iterate through the results and list them on the page as html
      foreach ($conn->query($sql) as $row) {
        echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2>';
      }

      // Now query for topics
      $sql = "SELECT
                topic_id,
                topic_subject,
                topic_date,
                topic_cat,
              FROM
                topics
              WHERE
                topic_cat = " . PDO::quote($_GET['id']);

      // Execute prepared statement and see if it failed
      if (!($result = $conn->query($sql))) {
        echo 'The topics could not be displayed, please try again.';
      }
      else {
        // prep the table
        echo '<table border="1">
              <tr>
                <th>Topic</th>
                <th>Created at</th>
              </tr>';

        foreach ($result as $row) {
          echo '<tr>';
          echo '<td class="leftpart">';
          echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a></h3>';
          echo '</td>';
          echo date('d-m-Y', strtotime($row['topic_date']));
          echo '</td>';
          echo '</tr>';
        }
      }
    }
  }

  include 'footer.php';
?>
