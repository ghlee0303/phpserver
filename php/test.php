<?php
include "./db.php";

$sql = "SELECT * FROM install WHERE delete_yn is null";
$result = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_array($result);
$array = array();
$start = 0;

while ($data != null) {
  if (strpos($data['next'], "a") !== false) {
    $start = $data['id'];
    $data['next'] = explode("a", $data['next'])[1];
  }
  $array[$data['id']] = $data;
  $data = mysqli_fetch_array($result);
}

//print_r($array);
$return = array();

foreach($array as $val) {
  echo "id : $start";
  echo " / ";  
  echo "next : ";
  echo $array[$start]['next'];
  echo "\n";
  //echo $array[$start]['id'];
  $return[] = $array[$start];
  $start = $array[$start]['next'];
}

//print_r($return);
echo "\n";
echo "\n";
echo "\n";
echo "\n";
  echo "\n";
  echo "\n";
  echo "\n";
  echo "\n";
  echo "\n";
echo "\n";

if ($_POST['ddd']) {
  $prev = array();
  $change = array();

  $prev[] = prev($return[7]);
  $prev[] = $return[7];

  $change[] = prev($return[13]);
  $change[] = $return[13];

  $element = current($return[7]);
  print_r($element);
  print_r(prev($return));
/*
  print_r($prev);
  echo "dddd\n";
  print_r($change);*/
  //change_seq($return[7])
}

function change_seq($prev, $change) {
  $save = $prev;
  $prev[0]['next'] = $change[0]['next'];
  $prev[1]['next'] = $change[1]['next'];
  $change[0]['next'] = $save[0]['next'];
  $change[1]['next'] = $save[1]['next'];

  print_r($prev);
  echo "dddd\n";
  print_r($change);
}

?>