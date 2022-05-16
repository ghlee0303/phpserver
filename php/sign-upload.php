<?php
include "./db.php";

function image_list_db($mysqli) {
  $upload_dir = '../image/';
  $install_index = $_POST['install_id'];

  $tmp_name = $_FILES["sign"]["tmp_name"];
  $name = $_FILES["sign"]["name"];

  $ext = "png";
  $sign_name = "sign_" . explode("php", basename($tmp_name) . rand() . "." . $ext)[1];
  $upload_sign_name = $upload_dir . $sign_name;

  $sql_sign_init = "UPDATE sign_list SET delete_yn = '1' WHERE install_id = '$install_index'";
  $result_sign_init = mysqli_query($mysqli, $sql_sign_init);
  
  $sql_sign_insert = "INSERT INTO sign_list SET sign_file_name = '$sign_name', install_id = '$install_index'";
  $result_sign_insert = mysqli_query($mysqli, $sql_sign_insert);
  
      echo "$sql_sign_insert\n";
      if ($result_sign_insert) {
        echo "image_list 쿼리성공\n";
      } else {
        echo "image_list 쿼리실패\n";
        echo mysqli_error($mysqli);
        echo "\n";
      }

  $image_result = move_uploaded_file($tmp_name, $upload_sign_name);

  if ($image_result == true) {
    echo "image upload 성공\n";
  } else {
    echo "image upload 실패\n";
    echo "\n";
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  image_list_db($mysqli);
}
