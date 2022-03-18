<?php
include "./db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $post_id = $_POST["post_id"];
  $commenter_id = $_POST['commenter_id'];
  $commenter_name = $_POST['commenter_name'];
  $comment_calendar = $_POST['comment_calendar'];
  $comment_text = $_POST['comment_text'];
  $comment_file = $_POST['comment_file'];
  $comment_purpose = $_POST['comment_purpose'];

  $sql_user = "SELECT id FROM user WHERE name = '$commenter_name' AND user_id = '$commenter_id'";
  $result = mysqli_query($mysqli, $sql_user);
  if ($result) {
    echo "comment 쿼리성공\n";
  } else {
    echo "comment 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }
  $row = mysqli_fetch_array($result);
  $user_index = $row['id'];
//post_id = '$post_id',
  $sql_comment = "INSERT INTO comment SET u_id = '$user_index', date = '$comment_calendar', contents = '$comment_text', purpose = '$comment_purpose'";
  $result = mysqli_query($mysqli, $sql_comment);
  if ($result) {
    echo "comment 쿼리성공\n";
  } else {
    echo "comment 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }
  $index = mysqli_insert_id($mysqli);
}
?>