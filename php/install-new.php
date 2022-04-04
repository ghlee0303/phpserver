<?php
include "./db.php";

function is_Empty($val)
{
  if (is_array($val) == 1) {
    foreach ($val as $key => $value) {
      $val[$key] = !empty($value) ? "'$value'" : "NULL";
    }
  } else {
    $val = !empty($val) ? "'$val'" : "NULL";
  }

  return $val;
}

function install_spot_db($mysqli, $index) {
  $date = is_Empty($_POST["date"]);
  $office_edu = is_Empty($_POST["office_edu"]);
  $address = is_Empty($_POST["address"]);
  $region = is_Empty($_POST["region"]);
  $location = is_Empty($_POST["location"]);
  $maneger = is_Empty($_POST["maneger"]);
  $sql = '';

  if ($index == null) {
    $sql = "INSERT INTO install_spot SET date = $date, region = $region, address_1 = $address[0], address_2 = $address[1], office_edu = $office_edu, location = $location, maneger_name = $maneger[0], maneger_phone = $maneger[1], maneger_email = $maneger[2]";
  } else {
    $sql = "UPDATE install_spot SET date = $date, region = $region, address_1 = $address[0], address_2 = $address[1], office_edu = $office_edu, location = $location, maneger_name = $maneger[0], maneger_phone = $maneger[1], maneger_email = $maneger[2] WHERE id = $index";
  }

  $result = mysqli_query($mysqli, $sql);
  $index = mysqli_insert_id($mysqli);
/*
  echo "$sql\n";
  if ($result) {
    echo "install_spot 쿼리성공\n";
  } else {
    echo "install_spot 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }*/

  return mysqli_insert_id($mysqli);
}

function menu_list_db($mysqli, $index) {
  $network = is_Empty($_POST["network"]);
  $server = is_Empty($_POST["server"]);
  $latitude = is_Empty($_POST["latitude"]);
  $longitude = is_Empty($_POST["longitude"]);
  $scale = array(is_Empty($_POST["scale1"]), is_Empty($_POST["scale2"]), is_Empty($_POST["scale3"]), is_Empty($_POST["scale4"]));
  $query_index_brodcast = array();
  $sql = '';

  if ($index == null) {
    $sql = "INSERT INTO menu_list SET network_ip = $network[0], network_subnet = $network[1], network_gateway = $network[2], network_dns = $network[3], server_ip = $server[0], server_port = $server[1], server_id = $server[2], server_pwd = $server[3], latitude = $latitude, longitude = $longitude";
    $result = mysqli_query($mysqli, $sql);
    $menu_id = mysqli_insert_id($mysqli);

    foreach ($scale as $key => $value) {
      $sql_brod = "INSERT INTO brodcast SET scale1 = $value[0], scale2 = $value[1], distance = $value[2], menu_id = $menu_id";
      $result = mysqli_query($mysqli, $sql_brod);
      $query_index_brodcast[$key] = mysqli_insert_id($mysqli);
    }
  } else {
    $sql_menu_index = "SELECT menu_list_id FROM post WHERE id = $index";
    $sql_menu_index_result = mysqli_query($mysqli, $sql_menu_index);
/*
    if (!($sql_menu_index_result)) {
      echo "brod 인덱스 쿼리실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }*/
    $sql_menu_index_row = mysqli_fetch_array($sql_menu_index_result);
    
    $sql_brod_index = "SELECT id FROM brodcast WHERE menu_id = $sql_menu_index_row[menu_list_id]";
    $sql_brod_result =  mysqli_query($mysqli, $sql_brod_index);

    foreach ($scale as $key => $value) {
      $sql_brod_row = mysqli_fetch_array($sql_brod_result);
      $sql_brod = "UPDATE brodcast SET scale1 = $value[0], scale2 = $value[1], distance = $value[2] WHERE id = $sql_brod_row[id]";
      $result = mysqli_query($mysqli, $sql_brod);
      /*
      echo "$sql_brod\n";
      if ($result) {
        echo "menu_list_1 쿼리성공\n";
      } else {
        echo "menu_list_1 쿼리실패\n";
        echo mysqli_error($mysqli);
        echo "\n";
      }*/
    }
    $sql = "UPDATE menu_list SET network_ip = $network[0], network_subnet = $network[1], network_gateway = $network[2], network_dns = $network[3], server_ip = $server[0], server_port = $server[1], server_id = $server[2], server_pwd = $server[3], latitude = $latitude, longitude = $longitude WHERE id = $index";
  }

  $result = mysqli_query($mysqli, $sql);
  /*
  echo "$sql\n";
  if ($result) {
    echo "menu_list 쿼리성공\n";
  } else {
    echo "menu_list 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }*/

  return $menu_id;
}

function check_list($mysqli, $index) {

  $check = $_POST["check"];
  $var = '';
  $key = 0;

  if (isset($check)) {
    foreach ($check as $key => $value) {
      $var = $var . "a" . $value;
    }
    $var = substr($var, 1);
    $sql = "UPDATE post SET check_list = '$var' WHERE id = $index";
  } else {

    return null;
  }
  
  $result = mysqli_query($mysqli, $sql);
  /*
  echo "$sql\n";
  if ($result) {
    echo "check_list 쿼리성공\n";
  } else {
    echo "check_list 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }*/
}

function image_list_db($mysqli, $post_index) {

  $image_index = $_POST['file_id'];
  $upload_dir = '../image/';

  foreach ($_FILES["img"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
      $judge = 0;

      $tmp_name = $_FILES["img"]["tmp_name"][$key];
      $name = $_FILES["img"]["name"][$key];

      $ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $name);
      $file_name = explode("php", basename($tmp_name) . rand() . "." . $ext)[1];
      $upload_file = $upload_dir.$file_name;

      $sql_select_image_num = "SELECT * FROM image_list WHERE post_id = '$post_index' AND num = '$image_index[$key]'";
      $result_select_image_num = mysqli_query($mysqli, $sql_select_image_num);
      $row_select_image_num = mysqli_fetch_array($result_select_image_num);
      $judge = $row_select_image_num['num'];
      
      if ($judge) {
        $sql = "UPDATE image_list SET image_file_name = '$file_name', delete_yn = NULL WHERE post_id = '$post_index' AND num = '$image_index[$key]'";
      } else {
        $sql = "INSERT INTO image_list SET image_file_name = '$file_name', num = '$image_index[$key]', post_id = '$post_index'";
      }

      $result = mysqli_query($mysqli, $sql);
      /*
      echo "$sql\n";
      if ($result) {
        echo "image_list 쿼리성공\n";
      } else {
        echo "image_list 쿼리실패\n";
        echo mysqli_error($mysqli);
        echo "\n";
      }*/
    
      $image_result = move_uploaded_file($tmp_name, $upload_file);

      if ($image_result == true) {
        echo "image upload 성공\n";
      } else {
        echo "image upload 실패\n";
        echo "\n";
      }
    }
  }

}








if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $query = $_POST["query"];
  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $total_count = $_POST['total_count'];

  $sql = "SELECT id FROM user WHERE name = '$user_name' AND user_id = '$user_id'";
  $result = mysqli_query($mysqli, $sql);

  $row = mysqli_fetch_array($result);
  $user_index = $row['id'];

  if ($query == "new") {

    $sql = "INSERT INTO post SET user_id = '$user_index'";
    $result = mysqli_query($mysqli, $sql);

    $post_index = mysqli_insert_id($mysqli);

    $query_index_install_spot = install_spot_db($mysqli, null);
    $query_index_menu_list = menu_list_db($mysqli, null);
    image_list_db($mysqli, $post_index);
    check_list($mysqli, $post_index);

    /*
    $date = is_Empty($_POST["date"]);
    $sql_date = "SELECT count(id) FROM install_spot WHERE date(date) >= date_format($date, '%Y-%m-01') AND date(date) <= last_day($date) AND id IN (SELECT install_spot FROM post WHERE user_id = '$user_index')";
    $result = mysqli_query($mysqli, $sql_date);
    $count = mysqli_fetch_array($result)[0] + 1;

    if (!($result)) {
      echo "월별 갯수 쿼리 실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }
    echo "$sql_date\n";
    echo "월별 갯수 : ";
    echo $count;*/

    if(empty($_POST['complete'])) {
      $sql = "UPDATE post SET install_spot_id = '$query_index_install_spot', menu_list_id = '$query_index_menu_list', count = '$total_count', type = '$_POST[type]' where id = '$post_index'";  
    } else {
      $sql = "UPDATE post SET install_spot_id = '$query_index_install_spot', menu_list_id = '$query_index_menu_list', count = '$total_count', type = '$_POST[type]', complete = 1 where id = '$post_index'";
    }
    $result = mysqli_query($mysqli, $sql);
    
    echo "$sql\n";
    if ($result) {
      echo "post insert 쿼리성공\n";
    } else {
      echo "post insert 쿼리실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }

  } else {
    $post_id_sql = "SELECT * FROM post WHERE id = '$query'";
    $post_id_result = mysqli_query($mysqli, $post_id_sql);
    $post_id_row = mysqli_fetch_array($post_id_result);

    $query_index_install_spot = install_spot_db($mysqli, $post_id_row['install_spot_id']);
    $query_index_menu_list = menu_list_db($mysqli, $post_id_row['menu_list_id']);
    image_list_db($mysqli, $query);
    check_list($mysqli, $query);

    if (empty($_POST['complete'])) {
      $sql = "UPDATE post SET count = '$total_count' where id = '$query'";
    } else {
      $sql = "UPDATE post SET count = '$total_count', complete = 1 where id = '$query'";
    }

    echo "$sql\n";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
      echo "post update 쿼리성공\n";
    } else {
      echo "post update 쿼리실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }
  }
} else {
  echo "잘못된 접근입니다.\n";
}
?>