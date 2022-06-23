<?php

require_once(__DIR__ . '/vendor/autoload.php');

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
//echo json_encode(call_install_excel($sheet));
//print_r(call_install_excel($sheet));
call_install_excel($sheet);


function call_install_excel($sheet) {
  $sheet_data = array();
  $excel_index = 1;
  echo "\n";
  
  //while ($sheet->getCell('B'.$top)->getValue()) {
  
  for ($i=1; $i<=10; $i=$i+1) {
    $j = 0;
    while (!($sheet->getCell('A'.$excel_index)->getValue()) && $sheet->getCell('B'.$excel_index)->getValue() &&$j < 201) {
      $brodcast = array();
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
        "index" => $i
      );

      $excel_index = $excel_index + 1;
      $j = $j + 1;
    }
    $sheet->getCell('A'.$excel_index)->getValue();
    $excel_index = $excel_index + 2;
  }

  $sheet_data = is_Empty($sheet_data);
  print_r ($sheet_data);
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
?>