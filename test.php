<?php
/*함수의 매개변수로는 파일 이름의 $name 변수와 확장자의 $ext 변수를 설정 */
$src = "";
function read_img($file)
{
  /* GET 메서드로 보낼 값들을 $src 변수에 저장*/
  $src = "./php/imagecall.php?file=" . $file;

  return $src;
}

function th() {
  return 100;
}
$var = 50;
$jud = $var < 10 ? 1 : th();
echo $jud;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta charset="utf-8">
  <title></title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<style>

</style>

<body>

  <img id="img_test" src="./php/imagecall.php?file=1c8jU2263563231.jpg" width="120" height="120" />

</body>

<script>

</script>

</html>