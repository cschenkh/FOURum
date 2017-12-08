<?php
//create_cat.php
  include 'connect.php';
  include 'header.php';

  $sqlNumFound = "SELECT
                    COUNT(*)
                  FROM
                    categories";

  if(!($numResults = $conn->query($sqlNumFound))) {
    echo 'The categories could not be displayed, please try again later.';
  }
  else {
    if($numResults->fetchColumn() <= 0) {
      echo 'No categories defined yet.';
    }
    else {
      $sql = "SELECT
                cat_id,
                cat_name,
                cat_description
              FROM
                categories";

      $result = $conn->query($sql);

      //prepare the table
      echo '<table border="1">
          <tr>
          <th>Category</th>
          <th>Last topic</th>
          </tr>'; 

      foreach ($result as $row) {
        echo '<tr>';
        echo '<td class="leftpart">';
        echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . 
            '</a></h3>' . $row['cat_description'];
        echo '</td>';
        echo '<td class="rightpart">';
        echo '<a href="topic.php?id="">Topic subject</a> at ';
        echo '</td>';
        echo '</tr>';
      }

      echo '</table>';
    }
  }

include 'footer.php';
?>
