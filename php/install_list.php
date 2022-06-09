<?php
include "./db.php";

function call_list($mysqli) {
  $install_db_data = array();

  $user_sql = "SELECT * FROM user WHERE name = '$_POST[name]' AND user_id = '$_POST[userid]'";
  $user_result = mysqli_query($mysqli, $user_sql);
  $user_data = mysqli_fetch_array($user_result);

  $install_sql = "SELECT complete, type, count, seq, date_format(install_spot.date, '%Y-%m-%d') as date, install_spot.address_2 as address, install.id as id, user.name as name FROM install JOIN install_spot ON install.install_spot_id = install_spot.id JOIN user ON install.user_id = user.id WHERE install.user_id = $user_data[id]";
  
  if (!empty($_POST['type']) && !($_POST['type'] == "undefined")) {
    $install_sql = $install_sql . " AND install.type = $_POST[type]";
  }
  if (!empty($_POST['date_1'] && $_POST['date_2'])) {
    $install_sql = $install_sql . " AND DATE(install_spot.date) BETWEEN '$_POST[date_1]' AND '$_POST[date_2]'";
  }
  if (!empty($_POST['search'])) {
    $install_sql = $install_sql . " AND MATCH(install_spot.address_2) AGAINST('$_POST[search]*' IN BOOLEAN MODE) OR MATCH(user.name) AGAINST('$_POST[search]*' IN BOOLEAN MODE)";
  }

  $install_sql = $install_sql . " ORDER BY install.seq DESC";
  $install_result = mysqli_query($mysqli, $install_sql);

  //echo $install_sql;

  while ($install_spot_row = mysqli_fetch_array($install_result)) {
    $install_db_data[] = $install_spot_row;
  }

  echo json_encode($install_db_data, JSON_UNESCAPED_UNICODE);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  call_list($mysqli);
}
?>