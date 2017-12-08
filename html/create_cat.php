<?php // create_cat.php
  include 'connect.php';
  include 'header.php';

  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // form hasn't been posted yet, so display it
    echo '<form class="createForm" method="post" action="">
        Category name: <input class="regField" type="text" name="cat_name" /><br>
        Category description: <textarea name="cat_description" /></textarea><br>
        <input class="submission" type="submit" value="Add Category" />
        </form>';
  }
  else {
    // The form HAS been posted so let's save it
    $sql = "INSERT INTO categories(cat_name, cat_description)
              VALUES(" . $conn->quote($_POST['cat_name']) . ", " . 
                  $conn->quote($_POST['cat_description']) . ")";

    try {
      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
      return;
    }

    echo 'New category successfully added.';
  }

  include 'footer.php';
?>
