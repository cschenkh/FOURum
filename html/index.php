<?php //index.php
  include 'connect.php';
  include 'header.php';

  // table top to add a category
  echo '<div class="createContent">
          <a class="createContentText" href="/create_cat.php">Create New Category</a>
        </div>';

  $sqlNumFound = "SELECT
                    COUNT(*)
                  FROM
                    categories";

  if(!($numResults = $conn->query($sqlNumFound))) {
    echo 'The categories could not be displayed, please try again later.';
  }
  else {
    if($numResults->fetchColumn() <= 0) {
    }
    else {
      $sql = "SELECT
                cat_id,
                cat_name,
                cat_description
              FROM
                categories";

     $result = $conn->query($sql);
      
      // prepare the table
      echo '<table border="1">
          <tr>
          <th>Category</th>
          <th>Last topic</th>
          </tr>'; 

      foreach ($result as $row) {

        $sqlTopic = "SELECT
                      topic_id,
                      topic_subject,
                      topic_date
                    FROM
                      topics
                    WHERE
                      topic_cat = " . $row['cat_id'] . "
                    ORDER BY
                      topic_id
                      DESC
                    LIMIT
                      0, 1";

        $topicRes = $conn->query($sqlTopic);

        echo '<tr>';
        echo '<td class="leftpart">';
        echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . 
            '</a></h3>' . $row['cat_description'];
        echo '</td>';
        echo '<td class="rightpart">';

        if ($topicRes) {
          if ($topicInfo = $topicRes->fetch()) {
            echo '<a href="topic.php?id=' . $topicInfo['topic_id'] . '">' . $topicInfo['topic_subject'] . '</a><br>';
            echo 'Last Topic Update: ';
            echo date('m-d-Y', strtotime($topicInfo['topic_date']));
          }
        }

        echo '</td>';
        echo '</tr>';
      }

      echo '</table>';
    }
  }

include 'footer.php';
?>
