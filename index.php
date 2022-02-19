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

  <div class="container-sm pb-3">
    <div class="d-grid gap-3" style="grid-template-columns: 1fr;">
      <button type="button" class="bg-light border rounded-3 mt-5 grid_item" onclick="location.href='/install.php' "> 설치 </button>
      <button type="button" class="bg-light border rounded-3 mt-5 grid_item" onclick="location.href='/' "> 관리자 메뉴 </button>
      <button type="button" class="bg-light border rounded-3 mt-5 grid_item" onclick="location.href='/' "> 유지보수 </button>
    </div>
  </div>
</body>

</html>