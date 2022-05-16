<?php
include "./db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $delete_images_num = $_POST["image_delete_check"];
  $install_id = $_POST["install_id"];
  $sql_delete = '';
  $nums = '';
  $key = 0;

  //$sql = "UPDATE install SET count = '$input_count' where id = '$query'";
  /*
  *** DELETE 문 ***
  if (isset($delete_images_num)) {
    $sql = "DELETE FROM photo_name WHERE install_id = '$install_id' AND num in (";
    foreach ($delete_images_num as $key => $value) {
      $nums = $nums . ", " . "'$value'";
    }
    $sql_delete = $sql.substr($nums, 1).")";
  }*/

  if (isset($delete_images_num)) {
    $sql = "UPDATE photo_name SET delete_yn = 1 WHERE install_id = '$install_id' AND num in (";
    foreach ($delete_images_num as $key => $value) {
      $nums = $nums . ", " . "'$value'";
    }
    $sql_delete = $sql . substr($nums, 1) . ")";
  }

  echo "$sql_delete\n";
  echo "$nums";
}
?>