<?php
$uploads_dir = './image';


echo "서버 확인<br>";
if (isset($_FILES["test_file"])) {
  echo "파일 있음<br>";
}


$tmp_name = $_FILES["test_file"]["tmp_name"];
$name = $_FILES["test_file"]["name"];
$modName = basename($name, '.PNG');
$name2 = explode(".", $name);

$file_path = $uploads_dir . $name;

echo $name;
echo " | ";
echo $name2[0];
echo " | ";
echo $tmp_name;
echo "<br>";
if(move_uploaded_file($tmp_name, $file_path)) {
  echo "성공";
} else {
  echo "실패";
}



?>