<?php
include "./php/db.php";
include "./php/login-ok.php";

$user_sql = "SELECT * FROM user WHERE name = '$_SESSION[name]' AND user_id = '$_SESSION[userid]'";
$user_result = mysqli_query($mysqli, $user_sql);
$user_row = mysqli_fetch_array($user_result);

$user_name = $user_row['name'];
$user_phone = $user_row['phone'];
$user_email = $user_row['email'];
$user_position_db = $user_row['position'];
$user_position = 0;

switch ($user_position_db) {
  case 0:
    $user_position = "관리자";
    break;
  case 1:
    $user_position = "설치자";
    break;
  case 2:
    $user_position = "유지보수자";
    break;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
  <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
  <script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
</head>

<style>
</style>

<body>
  <?php include "./header.php"; ?>

  <div class="container container-mobile-1">
    <div class="fs-mobile-2">마이페이지</div>
    <table class="table install-table table-border fs-4 align-middle">
      <tr>
        <td class="col-3">이름</td>
        <td class="col-5 border-bl text-center h-info_form"><?php echo $user_name ?></td>
      </tr>
      <tr>
        <td class="col-3">연락처</td>
        <td class="col-5 border-bl text-center h-info_form"><?php echo $user_phone ?></td>
      </tr>
      <tr>
        <td class="col-3">이메일</td>
        <td class="col-5 border-bl text-center h-info_form"><?php echo $user_email ?></td>
      </tr>
      <tr>
        <td class="col-3">직책</td>
        <td class="col-5 border-bl text-center h-info_form"><?php echo $user_position ?></td>
      </tr>
    </table>
    <button type="button" class="btn btn-outline-primary me-2 mt-5 btn-mobile-1 f-end" onclick="location.href = '/edit-my.php' ">수정</button>
  </div>
</body>

</html>