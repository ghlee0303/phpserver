<?php
include "./db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $image_delete = $_POST["image_delete_check"];
  $var = '';
  $key = 0;

  $sql = "DELETE FROM photo_name WHERE post_id = ";
  if (isset($image_delete)) {
    foreach ($image_delete as $key => $value) {
      $var = $var . "," . $sql."'$value'";
    }
    $var = substr($var, 1);
  }
  echo $var;
}
?>