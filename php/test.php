<?php
include "./db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $quarter = 1;
  //$query_sql = "SELECT * FROM post WHERE install_spot_id IN (SELECT id FROM install_spot WHERE quarter(date) = $quarter)";

  $query_sql = "SELECT * FROM post WHERE install_spot_id IN (SELECT id FROM install_spot WHERE quarter(date_format(date, '$_POST[year]-%m-%d')) = $_POST[quarter]) AND delete_yn is null AND maintenance is null";

  echo "$query_sql\n";
  
  $query_result = mysqli_query($mysqli, $query_sql);

  if (!($query_result)) {
    echo "data_array 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
  }

  $query_row = mysqli_fetch_array($query_result);

  while ($query_row != null) {

    print_r($query_row);
    $query_row = mysqli_fetch_array($query_result);
  }
}
?>