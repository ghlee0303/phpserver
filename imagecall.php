<?php

header('Content-Type: image/' . $_GET['ext']);

$file_path = "./image" . $_GET['name'] . "." . $_GET['ext'];
$fp = fopen($file_path, 'r'); /* 파일크기를 filesize 만큼 읽어들여 $arr 변수에 저장 */
$arr = fread($fp, filesize($file_path));
echo $arr;
fclose($fp);
 
 ?>