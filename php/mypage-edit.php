<?php
  include "./db.php";

  function is_Empty($val) {
    if (is_array($val) == 1) {
      foreach ($val as $key => $value) {
        $val[$key] = !empty($value) ? "'$value'" : "NULL";
      }
    } else {
      $val = !empty($val) ? "'$val'" : "NULL";
    }

    return $val;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['mode'] == 'pwdcheck') {
      $jud = password_verify($_POST['input_pwd'], $_POST['user_pwd']) ? 1 : 0;
      echo "$jud";
      exit;
    } else if ($_GET['mode'] == 'update') {
      $input_name = is_Empty($_POST['name']);
      $input_pwd = password_hash($_POST['pwd'][1], PASSWORD_DEFAULT);
      $input_phone = is_Empty($_POST['phone']);
      $input_email = is_Empty($_POST['email']);

      $user_index = is_Empty($_POST['user_index']);

      $sql = "UPDATE user SET name = $input_name, user_pwd = '$input_pwd', phone = $input_phone, email = $input_email WHERE id = $user_index";
      $result = mysqli_query($mysqli, $sql);

      echo "$sql\n";
    }
    
    
  } else {
    echo "잘못된 접근입니다.\n";
  }
?>