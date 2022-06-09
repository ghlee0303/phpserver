<?php
include "./db.php";

/*
class comment_data {
  private $purpose;
  private $date;
  private $time;
  private $period;
  private $name;
  private $image;
  private $contents;

  public function __construct($purpose, $date, $time, $period, $name, $image, $contents)
  {
    $this->purpose = $purpose;
    $this->date = $date;
    $this->time = $time;
    $this->period = $period;
    $this->name = $name;
    $this->image = $image;
    $this->contents = $contents;
  }
}*/

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

function comment_call($mysqli) {
  $install_id = $_POST["install_id"];
  $search_purpose = $_POST['search_purpose'] == "전체" ? "" : "AND purpose = \"$_POST[search_purpose]\"";
  $comment_sql =
    "SELECT 
    comment.id, 
    date, 
    purpose, 
    period, 
    contents, 
    productNo, 
    productChange, 
    comment.install_id, 
    u_id,
    image_file_name,
    name 
  FROM comment 
  JOIN user ON user.id = comment.u_id 
  LEFT OUTER JOIN image_list ON image_list.comment_id = comment.id 
  WHERE comment.install_id = $install_id AND comment.delete_yn is NULL ".$search_purpose." ORDER BY date DESC";
  $comment_result = mysqli_query($mysqli, $comment_sql);

  /*
  echo "$comment_sql\n";
  if ($comment_result) {
    echo "comment_sql 쿼리성공\n";
  } else {
    echo "comment_sql 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }*/

  $comment_query = mysqli_fetch_array($comment_result);
  $image_download_link = array();
  $comment_count = 0;
  $comments_array = array();

  while ($comment_query) {
    $comment_index = $comment_query['id'];
    $comment_date = date("m.d", strtotime($comment_query['date']));
    $comment_time = date("H:i", strtotime($comment_query['date']));
    $comment_purpose = $comment_query['purpose'];
    $comment_contents = $comment_query['contents'];
    $comment_period = $comment_query['period'];
    $comment_name = $comment_query['name'];
    $comment_image = empty($comment_query['image_file_name']) ? $comment_query['image_file_name'] : "./image/" . $comment_query['image_file_name'];
    $comments_array[] = array("purpose"=>$comment_purpose, "date"=>$comment_date, "time"=>$comment_time, "period"=>$comment_period, "name"=>$comment_name, "image"=>$comment_image, "contents"=>$comment_contents);

    $comment_query = mysqli_fetch_array($comment_result);
    $comment_count = $comment_count + 1;
  }

  echo json_encode($comments_array, JSON_UNESCAPED_UNICODE);
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
  $install_id = $_POST["install_id"];
  $commenter_id = $_POST['commenter_id'];
  $commenter_name = $_POST['commenter_name'];
  $comment_date = date("Y-m-d H:i:s");
  $comment_text = $_POST['comment_text'];
  $comment_purpose = $_POST['comment_purpose'];
  $comment_product_val = $_POST['comment_product_val'];
  $product = $_POST['product'];

  echo "작성자 id: $commenter_id\n";
  echo "작성자명: $commenter_name\n";
  echo "날짜: $comment_date\n";
  echo "내용: $comment_text\n";
  echo "목적: $comment_purpose\n";
  echo "변수: $comment_product_val\n";
  echo "제품1: $product[0]\n";

  if ($comment_product_val) {
    $product[1] = "NULL";
  }
  
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

  $sql_comment = "INSERT INTO comment SET u_id = '$user_index', date = '$comment_date', contents = '$comment_text', purpose = '$comment_purpose', install_id = '$install_id', productNo = '$product[0]', productChange = '$product[1]'";
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
  switch ($_POST["comment_type"]) {
    case "upload":
      comment_upload($mysqli);
      break;
    case "delete":
      comment_delete($mysqli);
      break;
    case "call":
      comment_call($mysqli);
      break;
  }
}
?>