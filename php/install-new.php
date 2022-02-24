<?php
include "./db.php";

function install_spot_db($mysqli, $index) {
  $date = $_POST["date"];
  $office_edu = $_POST["office_edu"];
  $address = $_POST["address"];
  $region = $_POST["region"];
  $location = $_POST["location"];
  $maneger = $_POST["maneger"];
  $sql = '';

  if ($index == "new") {
    $sql = "INSERT INTO install_spot SET date = '$date', region = '$region', address_1 = '$address[0]', address_2 = '$address[1]', office_edu = '$office_edu', location = '$location', maneger_name = '$maneger[0]', maneger_phone = '$maneger[1]', maneger_email = '$maneger[2]'";
  } else {
    $sql = "UPDATE install_spot SET date = $date, region = $region, address_1 = $address[0], address_2 = $address[1], office_edu = $office_edu, location = $location, maneger_name = $maneger[0], maneger_phone = $maneger[1], maneger_email = $maneger[2] WHERE id = $index";
  }

  echo "$sql\n";
  $result = mysqli_query($mysqli, $sql);
  if ($result) {
    echo "install_spot 쿼리성공\n";
  } else {
    echo "install_spot 쿼리실패\n";
    echo mysqli_error($mysqli) + " dddd";
  }

  return mysqli_insert_id($mysqli);
}

function menu_list_db($mysqli, $index) {
  $network = $_POST["network"];
  $server = $_POST["server"];
  $latitude = $_POST["latitude"];
  $longitude = $_POST["longitude"];
  $scale = array($_POST["scale1"], $_POST["scale2"], $_POST["scale3"], $_POST["scale4"]);
  $query_index_brodcast = array();
  $sql = '';

  if ($index == "new") {
    foreach ($scale as $key => $value) {
      $sql_brod = "INSERT INTO brodcast(scale1, scale2, distance) VALUES('$value[0]', '$value[1]', '$value[2]')";
      $result = mysqli_query($mysqli, $sql_brod);
      $query_index_brodcast[$key] = mysqli_insert_id($mysqli);
    }
    $sql = "INSERT INTO menu_list(network_ip, network_subnet, network_gateway, network_dns, server_ip, server_port, server_id, server_pwd, brod1, brod2, brod3, brod4, latitude, longitude) VALUES('$network[0]', '$network[1]', '$network[2]', '$network[3]', '$server[0]', '$server[1]', '$server[2]', '$server[3]', '$query_index_brodcast[0]', '$query_index_brodcast[1]', '$query_index_brodcast[2]', '$query_index_brodcast[3]', '$latitude', '$longitude')";
  } else {
    $sql_brod_index = "SELECT brod1, brod2, brod3, brod4 FROM menu_list WHERE id = $index";
    $result = mysqli_query($mysqli, $sql_brod_index);
    if (!($result)) {
      echo "brod 인덱스 쿼리실패\n";
    }
    $row = mysqli_fetch_array($result);
    $index_brod = array($row["brod1"], $row["brod2"], $row["brod3"], $row["brod4"]);
    foreach ($scale as $key => $value) {
      $sql_brod = "UPDATE brodcast SET scale1 = $value[0], scale2 = $value[1], distance = $value[2] WHERE = $index_brod[$key])";
      $result = mysqli_query($mysqli, $sql_brod);
    }
    $sql = "UPDATE menu_list SET network_ip = $network[0], network_subnet = $network[1], network_gateway = $network[2], network_dns = $network[3], server_ip = $server[0], server_port = $server[1], server_id = $server[2], server_pwd = $server[3], latitude = $latitude, longitude = $longitude WHERE id = $index";
  }

  echo "$sql\n";
  $result = mysqli_query($mysqli, $sql);
  if ($result) {
    echo "menu_list 쿼리성공\n";
  } else {
    echo "menu_list 쿼리실패ddddd\n";
    echo mysqli_error($mysqli);
  }

  return mysqli_insert_id($mysqli);
}

function check_list($mysqli, $index) {

  $check = $_POST["check"];
  $var = '';

  if (isset($check)) {
    foreach ($check as $key => $value) {
      $var = $var . "," . $value;
    }
    $sql = "UPDATE post SET check_list = $var WHERE = id = $index";
  } else {
    return null;
  }

  echo "$sql\n";
  $result = mysqli_query($mysqli, $sql);
  if ($result) {
    echo "install_spot 쿼리성공\n";
  } else {
    echo "install_spot 쿼리실패\n";
  }

  return mysqli_insert_id($mysqli);
  /*
  $name_array = explode(",", $var);
  echo $name_array[0];
  echo "/";
  echo $name_array[3];
  echo "/";
  echo $name_array[2];*/
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if(isset($_FILES["img"])) {
    echo "파일 있음\n";
  }

  $uploads_dir = '../image/';
  foreach ($_FILES["img"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
      $tmp_name = $_FILES["img"]["tmp_name"][$key];
      $name = $_FILES["img"]["name"][$key];

      $upload_file = explode("php", $uploads_dir . basename($tmp_name) . rand() . ".jpg")[1];

      move_uploaded_file($tmp_name, $upload_file);
    }
  }
/*
  $query_index_install_spot = 0;
  $query_index_menu_list = 0;
  $index = $_POST["query"];

  if ($index == "new") {
    $query_index_install_spot = install_spot_db($mysqli, $index);
    $query_index_menu_list = menu_list_db($mysqli, $index);
  } else {
    $sql_index = "SELECT * FROM post WHERE id = $index";
    $result = mysqli_query($mysqli, $sql_index);
    if (!($result)) {
      echo "인덱스 쿼리실패\n";
      break;
    }
    $row_date = mysqli_fetch_array($result);

    $index_install = $row['install_spot'];
    $index_meun = $row['menu_setting'];
    $index_check = $row['check_list'];
    $index_photo = $row['photo_list'];

    $query_index_install_spot = install_spot_db($mysqli, $index_install);
    $query_index_menu_list = menu_list_db($mysqli, $index_menu);
  }



  $sql_date = "SELECT * FROM install_spot WHERE id AND date(date) >= date_format($date, '%Y-%m-01') AND date(date) <= last_day($date) IN (SELECT install_spot FROM post WHERE user_id = '$userid')";
  $result = mysqli_query($mysqli, $sql_date);
  $row_date = mysqli_fetch_array($result);
  $count = count($row_date)+1;
  $result = mysqli_query($mysqli, $sql);
  if (!($result)) {
    echo "월별 갯수 쿼리 실패\n";
  }
  echo $count;*/
  
} else {
  echo "잘못된 접근입니다.\n";
}
?>