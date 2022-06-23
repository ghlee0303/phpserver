<?php
require_once(__DIR__ . '/vendor/autoload.php');
include "./php/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $excel_file = $_FILES['excel_file']['tmp_name'];
  $excel_file_name = $_FILES['excel_file']['name'];
  $file_type = pathinfo($excel_file_name, PATHINFO_EXTENSION);

  if ($file_type == 'xls') {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
  } elseif ($file_type == 'xlsx') {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  } else {
    $return = array(
      "err" => 1
    );

    echo json_encode($return);
    exit;
  }

  $reader->setReadDataOnly(true);
  $spreadsheet = $reader->load($excel_file);
  $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
  $sheet_data = call_install_excel($sheet);

  foreach ($sheet_data as $sheet) {
    install_db($mysqli, install_spot_db($mysqli, $sheet), menu_list_db($mysqli, $sheet));
  }
}

function call_install_excel($sheet) {
  $sheet_data = array();
  $brodcast = array();
  $excel_index = 4;

  $brodcast[] = array(
    "scale1" => $sheet->getCell('Q' . $excel_index)->getValue(),
    "scale2" => $sheet->getCell('R' . $excel_index)->getValue(),
    "distance" => $sheet->getCell('S' . $excel_index)->getValue(),
  );
  $brodcast[] = array(
    "scale1" => $sheet->getCell('T' . $excel_index)->getValue(),
    "scale2" => $sheet->getCell('U' . $excel_index)->getValue(),
    "distance" => $sheet->getCell('V' . $excel_index)->getValue(),
  );
  $brodcast[] = array(
    "scale1" => $sheet->getCell('W' . $excel_index)->getValue(),
    "scale2" => $sheet->getCell('X' . $excel_index)->getValue(),
    "distance" => $sheet->getCell('Y' . $excel_index)->getValue(),
  );

  $brodcast[] = array(
    "scale1" => $sheet->getCell('Z' . $excel_index)->getValue(),
    "scale2" => $sheet->getCell('AA' . $excel_index)->getValue(),
    "distance" => $sheet->getCell('AB' . $excel_index)->getValue(),
  );

  $sheet_data[] = array(
    "err" => 0,
    "region" => $sheet->getCell('B' . $excel_index)->getValue(),
    "address_1" => $sheet->getCell('C' . $excel_index)->getValue(),
    "address_2" => $sheet->getCell('D' . $excel_index)->getValue(),
    "location" => $sheet->getCell('E' . $excel_index)->getValue(),
    "name" => $sheet->getCell('F' . $excel_index)->getValue(),
    "phone" => $sheet->getCell('G' . $excel_index)->getValue(),
    "email" => $sheet->getCell('H' . $excel_index)->getValue(),
    "network_ip" => $sheet->getCell('I' . $excel_index)->getValue(),
    "network_subnet" => $sheet->getCell('J' . $excel_index)->getValue(),
    "network_gateway" => $sheet->getCell('K' . $excel_index)->getValue(),
    "network_dns" => $sheet->getCell('L' . $excel_index)->getValue(),
    "server_ip" => $sheet->getCell('M' . $excel_index)->getValue(),
    "server_port" => $sheet->getCell('N' . $excel_index)->getValue(),
    "server_id" => $sheet->getCell('O' . $excel_index)->getValue(),
    "server_pwd" => $sheet->getCell('P' . $excel_index)->getValue(),
    "latitude" => $sheet->getCell('AC' . $excel_index)->getValue(),
    "longitude" => $sheet->getCell('AD' . $excel_index)->getValue(),
    "brodcast" => $brodcast,
    //"index" => $i
  );

  $sheet_data = is_Empty($sheet_data);
  print_r($sheet_data);
  
  return $sheet_data;
}

function is_Empty($input) {
  if (is_array($input) == 1) {
    foreach ($input as $key => $value) {
      $input[$key] = is_Empty($value);
    }
  } else {
    $input = !empty($input) ? "'$input'" : "NULL";
  }

  return $input;
}

function install_db($mysqli, $spot_id, $menu_id) {
  $sql = "INSERT INTO install SET install_spot_id = '$spot_id', menu_list_id = '$menu_id', type = '설치'";
  $result = mysqli_query($mysqli, $sql);

  echo "$sql\n";
  if ($result) {
    echo "install_db 쿼리성공\n";
  } else {
    echo "install_db 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }
  $install_index = mysqli_insert_id($mysqli);
}

function menu_list_db($mysqli, $sheet_data) {
  $sql = "INSERT INTO menu_list 
  SET 
    network_ip = $sheet_data[network_ip], 
    network_subnet = $sheet_data[network_subnet], 
    network_gateway = $sheet_data[network_gateway], 
    network_dns = $sheet_data[network_dns], 
    server_ip = $sheet_data[server_ip], 
    server_port = $sheet_data[server_port], 
    server_id = $sheet_data[server_id], 
    server_pwd = $sheet_data[server_pwd], 
    latitude = $sheet_data[latitude], 
    longitude = $sheet_data[longitude]";
  $result = mysqli_query($mysqli, $sql);
  $menu_id = mysqli_insert_id($mysqli);

  echo "$sql\n";
  if ($result) {
    echo "menu_list_db 쿼리성공\n";
  } else {
    echo "menu_list_db 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }

  // 경보방송
  foreach ($sheet_data['brodcast'] as $brodcast_array) {
    foreach ($brodcast_array as $value)
    $sql_brod = "INSERT INTO brodcast SET scale1 = $value[scale1], scale2 = $value[scale2], distance = $value[distance], menu_id = $menu_id";
    $result = mysqli_query($mysqli, $sql_brod);
  }

  return $menu_id;
}

function install_spot_db($mysqli, $sheet_data) {
  $region = region_db($mysqli, $sheet_data['region']);
  $sql = "INSERT INTO install_spot 
  SET 
    region_id = $region, 
    address_1 = $sheet_data[address_1], 
    address_2 = $sheet_data[address_2], 
    location = $sheet_data[location], 
    maneger_name = $sheet_data[name], 
    maneger_phone = $sheet_data[phone], 
    maneger_email = $sheet_data[email]";
  $result = mysqli_query($mysqli, $sql);
  $spot_id = mysqli_insert_id($mysqli);

  echo "$sql\n";
  if ($result) {
    echo "menu_list_db 쿼리성공\n";
  } else {
    echo "menu_list_db 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }

  return $spot_id;
}

function region_db($mysqli, $region) {
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
?>