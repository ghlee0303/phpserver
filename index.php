<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?after">
    <link rel="stylesheet" type="text/css" href="style/mobile.css?after">
  </head>

  <style>
  </style>
  
  <body>
    <?php include "./header.php"; ?>

    <div class="container-sm pb-3">
      <div class="d-grid gap-3" style="grid-template-columns: 1fr;">
        <button type="button" class="bg-light border rounded-3 mt-6 grid_item" onclick="location.replace('/install.php') "> 설치 </button>
        <button type="button" class="bg-light border rounded-3 mt-6 grid_item" onclick="location.replace('/') "> 관리자 메뉴 </button>
        <button type="button" class="bg-light border rounded-3 mt-6 grid_item" onclick="location.replace('/') "> 유지보수 </button>
      </div>
    </div>
  </body>
</html>