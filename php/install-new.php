<?php
include "./db.php";

/*
################
조회한 값이 공백인지 확인
공백이라면 "NULL" 리턴
아니라면 '값' 리턴
################
*/
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

/*
################
region 테이블
입력한 값이 region 테이블에 존재하지 않을 시 INSERT 후 생성한 id 값 리턴
존재한다면 테이블 내 해당 행의 id 값을 리턴
################
*/
function region_db($mysqli) {

  $region = is_Empty($_POST["region"]);

  $region_search_sql = "SELECT * FROM region WHERE region = $region";
  $region_search_result = mysqli_query($mysqli, $region_search_sql);
  $region_search_row = mysqli_fetch_array($region_search_result);

  if ($region_search_row == null) { // 입력된 값이 테이블에 존재하지 않을 경우
    $region_insert_sql = "INSERT INTO region SET region = $region";
    $region_insert_result = mysqli_query($mysqli, $region_insert_sql);
    $region_id = mysqli_insert_id($mysqli);
  } else {
    $region_id = $region_search_row['id'];
  }

  return $region_id;
}

/*
################
install_spot 테이블
설치 페이지의 설치 장소 탭에 해당
################
*/
function install_spot_db($mysqli, $index) {
  $date = is_Empty($_POST["date"]);
  $office_edu = is_Empty($_POST["office_edu"]);
  $region = region_db($mysqli);
  $location = is_Empty($_POST["location"]);
  $address = is_Empty($_POST["address"]);
  $maneger = is_Empty($_POST["maneger"]);
  $sql = '';

  if ($index == null) { // 새로 작성하는 경우
    $sql = "INSERT INTO install_spot SET date = $date, region_id = '$region', address_1 = $address[0], address_2 = $address[1], office_edu = $office_edu, location = $location, maneger_name = $maneger[0], maneger_phone = $maneger[1], maneger_email = $maneger[2]";
  } else {
    $sql = "UPDATE install_spot SET date = $date, region_id = '$region', address_1 = $address[0], address_2 = $address[1], office_edu = $office_edu, location = $location, maneger_name = $maneger[0], maneger_phone = $maneger[1], maneger_email = $maneger[2] WHERE id = $index";
  }

  $result = mysqli_query($mysqli, $sql);
  $index = mysqli_insert_id($mysqli);

  echo "$sql\n";
  if ($result) {
    echo "install_spot 쿼리성공\n";
  } else {
    echo "install_spot 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }

  return mysqli_insert_id($mysqli);
}

/*
################
menu_list 테이블
설치 페이지의 메뉴 설정 탭에 해당
################
*/
function menu_list_db($mysqli, $index) {
  $network = is_Empty($_POST["network"]);
  $server = is_Empty($_POST["server"]);
  $latitude = is_Empty($_POST["latitude"]);
  $longitude = is_Empty($_POST["longitude"]);
  $scale = array(is_Empty($_POST["scale1"]), is_Empty($_POST["scale2"]), is_Empty($_POST["scale3"]), is_Empty($_POST["scale4"]));
  $sql = '';

  if ($index == null) { // 새로 작성하는 경우
    $sql = "INSERT INTO menu_list SET network_ip = $network[0], network_subnet = $network[1], network_gateway = $network[2], network_dns = $network[3], server_ip = $server[0], server_port = $server[1], server_id = $server[2], server_pwd = $server[3], latitude = $latitude, longitude = $longitude";
    $result = mysqli_query($mysqli, $sql);
    $menu_id = mysqli_insert_id($mysqli);

    // 경보방송
    foreach ($scale as $key => $value) {
      $sql_brod = "INSERT INTO brodcast SET scale1 = $value[0], scale2 = $value[1], distance = $value[2], menu_id = $menu_id";
      $result = mysqli_query($mysqli, $sql_brod);
    }
  } else {
    $sql_brod_index = "SELECT id FROM brodcast WHERE menu_id = $index";
    $sql_brod_result =  mysqli_query($mysqli, $sql_brod_index);

    // 경보방송
    foreach ($scale as $key => $value) {
      $sql_brod_row = mysqli_fetch_array($sql_brod_result);
      $sql_brod = "UPDATE brodcast SET scale1 = $value[0], scale2 = $value[1], distance = $value[2] WHERE id = $sql_brod_row[id]";
      $result = mysqli_query($mysqli, $sql_brod);
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

/*
################
install 테이블의 check_list 컬럼에 해당
설치 페이지의 체크 리스트 탭에 해당
체크한 항목의 index + a + index + a .. 를 반복하여 하나의 string 형태로 저장함
ex) 2a6a7a11a
################
*/
function check_list($mysqli, $index) {

  $check = $_POST["check"];
  $var = '';
  $key = 0;

  if (isset($check)) { 
    foreach ($check as $key => $value) {
      $var = $var . "a" . $value;
    }
    $var = substr($var, 1);
    $sql = "UPDATE install SET check_list = '$var' WHERE id = $index";
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

/*
################
image_list 테이블
설치 페이지의 사진 첨부 탭에 해당
################
*/
function image_list_db($mysqli, $install_index) {

  $image_index = $_POST['file_id'];
  $upload_dir = '../image/';

  foreach ($_FILES["img"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
      $judge = 0;

      $tmp_name = $_FILES["img"]["tmp_name"][$key];
      $name = $_FILES["img"]["name"][$key];

      $ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $name);     // 확장자
      $file_name = explode("php", basename($tmp_name) . rand() . "." . $ext)[1]; // 랜덤한 파일명 생성
      $upload_file = $upload_dir.$file_name;

      $sql_select_image_num = "SELECT * FROM image_list WHERE install_id = '$install_index' AND num = '$image_index[$key]'";
      $result_select_image_num = mysqli_query($mysqli, $sql_select_image_num);
      $row_select_image_num = mysqli_fetch_array($result_select_image_num);
      $judge = $row_select_image_num['num'];
      
      if ($judge) {
        $sql = "UPDATE image_list SET image_file_name = '$file_name', delete_yn = NULL WHERE install_id = '$install_index' AND num = '$image_index[$key]'";
      } else {
        $sql = "INSERT INTO image_list SET image_file_name = '$file_name', num = '$image_index[$key]', install_id = '$install_index'";
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
  $install_index = $_POST["query"];
  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $total_count = $_POST['total_count'];

  $sql = "SELECT id FROM user WHERE name = '$user_name' AND user_id = '$user_id'";
  $result = mysqli_query($mysqli, $sql);

  $row = mysqli_fetch_array($result);
  $user_index = $row['id'];

  // 새로 작성하는 경우
  if ($install_index == "new") {

    $sql = "INSERT INTO install SET user_id = '$user_index'";
    $result = mysqli_query($mysqli, $sql);

    $install_index = mysqli_insert_id($mysqli);

    $query_index_install_spot = install_spot_db($mysqli, null);
    $query_index_menu_list = menu_list_db($mysqli, null);
    image_list_db($mysqli, $install_index);
    check_list($mysqli, $install_index);

    if(empty($_POST['complete'])) {
      $sql = "UPDATE install SET install_spot_id = '$query_index_install_spot', menu_list_id = '$query_index_menu_list', count = '$total_count', type = '$_POST[type]' where id = '$install_index'";  
    } else {
      $sql = "UPDATE install SET install_spot_id = '$query_index_install_spot', menu_list_id = '$query_index_menu_list', count = '$total_count', type = '$_POST[type]', complete = 1 where id = '$install_index'";
    }
    $result = mysqli_query($mysqli, $sql);
    
    /*
    echo "$sql\n";
    if ($result) {
      echo "install insert 쿼리성공\n";
    } else {
      echo "install insert 쿼리실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }*/

  } else {
    $install_id_sql = "SELECT * FROM install WHERE id = '$install_index'";
    $install_id_result = mysqli_query($mysqli, $install_id_sql);
    $install_id_row = mysqli_fetch_array($install_id_result);

    $query_index_install_spot = install_spot_db($mysqli, $install_id_row['install_spot_id']);
    $query_index_menu_list = menu_list_db($mysqli, $install_id_row['menu_list_id']);
    image_list_db($mysqli, $install_index);
    check_list($mysqli, $install_index);

    if (empty($_POST['complete'])) {
      $sql = "UPDATE install SET count = '$total_count' where id = '$install_index'";
    } else {
      $sql = "UPDATE install SET count = '$total_count', complete = 1 where id = '$install_index'";
    }

    echo "$sql\n";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
      echo "install update 쿼리성공\n";
    } else {
      echo "install update 쿼리실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }
  }

  if (!empty($_POST['complete'])) {
    $date = is_Empty($_POST["date"]);
    echo "????";
    $maintenance_sql = "INSERT INTO maintenance SET install_id = '$install_index', maintenance_date = $date, user_id = '$user_index'";
    $maintenance_result = mysqli_query($mysqli, $maintenance_sql);

    echo "$maintenance_sql\n";
    if ($maintenance_result) {
      echo "maintenance 쿼리성공\n";
    } else {
      echo "maintenance 쿼리실패\n";
      echo mysqli_error($mysqli);
      echo "\n";
    }
  }
} else {
  echo "잘못된 접근입니다.\n";
}

/*
    $date = is_Empty($_POST["date"]);
    $sql_date = "SELECT count(id) FROM install_spot WHERE date(date) >= date_format($date, '%Y-%m-01') AND date(date) <= last_day($date) AND id IN (SELECT install_spot FROM install WHERE user_id = '$user_index')";
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
?>