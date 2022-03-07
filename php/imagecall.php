<?php
$file = $_GET['file'];

$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
$file_path = "../image/".$file;
/* 이미지 읽기를 위한 컨텐츠 타입 설정을 위해 헤더함수를 사용 */
header('Content-Type: image/' . $ext);

$fp = fopen($file_path, 'r'); /* 파일크기를 filesize 만큼 읽어들여 $arr 변수에 저장 */
$arr = fread($fp, filesize($file_path));
 
echo $arr;
?>