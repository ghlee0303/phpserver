<?php
include "./db.php";

function call_list($mysqli) {
  $maintenance_db_data = array();

  $user_sql = "SELECT * FROM user WHERE name = '$_POST[name]' AND user_id = '$_POST[userid]'";
  $user_result = mysqli_query($mysqli, $user_sql);
  $user_data = mysqli_fetch_array($user_result);

  $maintenance_sql = "SELECT user.name, maintenance.period as period, maintenance.complete as complete, maintenance.type as type, maintenance.seq as seq, date_format(maintenance.maintenance_date, '%Y-%m-%d') as date, maintenance.id as id, (SELECT install_spot.address_2 FROM install_spot WHERE install.install_spot_id = install_spot.id) as address FROM maintenance JOIN install ON maintenance.install_id = install.id JOIN user ON maintenance.user_id = user.id WHERE maintenance.user_id = '$user_data[id]'";
  //"SELECT complete, type, count, seq, date_format(maintenance.maintenance_date, '%Y-%m-%d') as date, install_spot.address_2 as address, maintenance.id as id, user.name as name FROM maintenance JOIN maintenance_spot ON maintenance.maintenance_spot_id = maintenance_spot.id JOIN user ON maintenance.user_id = user.id WHERE maintenance.user_id = $user_data[id]";
  
  /*
  if (!empty($_POST['type']) && !($_POST['type'] == "undefined")) {
    $maintenance_sql = $maintenance_sql . " AND maintenance.type = $_POST[type]";
  }

  if (!empty($_POST['date_1'] || $_POST['date_2'])) {
    $date_1 = (empty($_POST['date_1'])) ? '0000-01-01' : $_POST['date_1'];
    $date_2 = (empty($_POST['date_2'])) ? '9999-12-31' : $_POST['date_2'];
    $maintenance_sql = $maintenance_sql . " AND DATE(maintenance.maintenance_date) BETWEEN '$date_1' AND '$date_2'";
  }
  
  if (!empty($_POST['search'])) {
    $maintenance_sql = $maintenance_sql . " AND MATCH(address) AGAINST('$_POST[search]*' IN BOOLEAN MODE) OR MATCH(user.name) AGAINST('$_POST[search]*' IN BOOLEAN MODE)";
  }
*/
  $maintenance_sql = $maintenance_sql . " ORDER BY maintenance.seq DESC";
  $maintenance_result = mysqli_query($mysqli, $maintenance_sql);

  //echo $maintenance_sql;

  while ($maintenance_spot_row = mysqli_fetch_array($maintenance_result)) {
    $maintenance_db_data[] = $maintenance_spot_row;
  }

  echo json_encode($maintenance_db_data, JSON_UNESCAPED_UNICODE);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  call_list($mysqli);
}
