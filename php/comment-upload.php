<?php
include "./db.php";

function is_Empty($val) {
  if (is_array($val) == 1) {
    foreach ($val as $key => $value) {
      $val[$key] = !empty($value) ? $value : "NULL";
    }
  } else {
    $val = !empty($val) ? $val : "NULL";
  }

  return $val;
}

function comment_file($mysqli, $comment_index){
  $upload_dir = '../image/';
  $comment_file = $_FILES['comment_file'];
  $tmp_name = $comment_file["tmp_name"];
  $name = $comment_file["name"];

  $ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $name);
  $file_name = explode("php", basename($tmp_name) . rand() . "." . $ext)[1];
  $upload_file = $upload_dir . $file_name;

  $sql = "INSERT INTO image_list SET image_file_name = '$file_name', comment_id = '$comment_index'";
  $result = mysqli_query($mysqli, $sql);

  echo "$sql\n";
  if ($result) {
    echo "image 쿼리성공\n";
  } else {
    echo "image 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }

  $image_result = move_uploaded_file($tmp_name, $upload_file);
  if ($image_result == true) {
    echo "image upload 성공\n";
  } else {
    echo "image upload 실패\n";
    echo "\n";
  }
}

function comment_upload($mysqli) {
  $post_id = $_POST["post_id"];
  $commenter_id = $_POST['commenter_id'];
  $commenter_name = $_POST['commenter_name'];
  $comment_date = $_POST['comment_date'];
  $comment_text = $_POST['comment_text'];
  $comment_purpose = $_POST['comment_purpose'];

  $sql_user = "SELECT id FROM user WHERE name = '$commenter_name' AND user_id = '$commenter_id'";
  $result = mysqli_query($mysqli, $sql_user);
  if ($result) {
    echo "user 쿼리성공\n";
  } else {
    echo "user 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }
  $row = mysqli_fetch_array($result);
  $user_index = $row['id'];

  $sql_comment = "INSERT INTO comment SET u_id = '$user_index', date = '$comment_date', contents = '$comment_text', purpose = '$comment_purpose', post_id = '$post_id'";
  $result = mysqli_query($mysqli, $sql_comment);
  echo "$sql_comment\n";
  if ($result) {
    echo "comment 쿼리성공\n";
  } else {
    echo "comment 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }
  $comment_index = mysqli_insert_id($mysqli);

  if (isset($_FILES['comment_file'])) 
    comment_file($mysqli, $comment_index);
  
}

function comment_delete($mysqli){
  $comment_id = $_POST["comment_id"];
  $sql_comment = "UPDATE comment SET delete_yn = '1' WHERE id = $comment_id";
  echo "$sql_comment\n";
  $result = mysqli_query($mysqli, $sql_comment);
  if ($result) {
    echo "delete 쿼리성공\n";
  } else {
    echo "delete 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  switch ($_POST["type"]) {
    case "upload":
      comment_upload($mysqli);
      break;
    case "delete":
      comment_delete($mysqli);
      break;
    case "change":
      echo "C";
      break;
  }
}
?>