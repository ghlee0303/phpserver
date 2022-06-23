<?php
include "./php/db.php";
include "./php/login-ok.php";

$installer_array = array();
$installer_sql = "SELECT * FROM user WHERE install = 1 AND delete_yn is null";
$installer_result = mysqli_query($mysqli, $installer_sql);
$installer_data = mysqli_fetch_array($installer_result);

while ($installer_data != null) {
  $installer_array[] = $installer_data;
  $installer_data = mysqli_fetch_array($installer_result);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width">
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
  <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />
</head>

<style>
  .layout {
    width: 1600px;
    display: grid;
    grid-template-rows: repeat(1, 1fr);
    grid-template-columns: repeat(8, 1fr);
    gap: 8px;
  }
</style>

<body>
  <?php include "./header.php" ?>

  <div class=" container container-mobile-1 pb-3">
    <div class="row mb-2">
      <button type="button" onclick="location.href = '/manege-total.php' " class="btn btn-outline-dark rounded-3 col-3 fs-5">현황</button>
      <button type="button" onclick="location.href = '/manege-user.php' " class="btn btn-outline-dark rounded-3 col-3 fs-5">유저관리</button>
      <button type="button" class="btn btn-dark rounded-3 col-3 fs-5">설치관리</button>
      <button type="button" onclick="" class="btn btn-outline-dark rounded-3 col-3 fs-5">유지보수관리</button>
    </div>
  </div>
  <button onclick="testt();">ddd</button>
  <button onclick="testtt();">ddeeed</button>

  <ul class="selector">
    <li class="selectorr" value="1">1</li>
    <li class="selectorr" value="2">2</li>
    <li class="selectorr" value="3">3</li>
    <li class="selectorr" value="4">4</li>
    <li class="selectorr" value="5">5</li>
  </ul>
  <section class="layout mx-auto">
    <div class="align-center ">
      <div class="border-top-bl border-bottom-bl p-3">
        <div class="dropdown border-bl-90">
          <div class="dropdown-toggle dropdownMenu text-center installer_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            작업자
          </div>
          <ul class="dropdown-menu dropdown-scroll installer_scroll">

          </ul>
        </div>
        <div class="dropdown border-bl-90 mt-3">
          <div class="dropdown-toggle dropdownMenu text-center upload_count_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            수동
          </div>
          <ul class="dropdown-menu dropdown-scroll">
            <li><button class="dropdown-item upload_count">수동</button></li>
            <li><button class="dropdown-item upload_count">자동 01</button></li>
            <li><button class="dropdown-item upload_count">자동 02</button></li>
            <li><button class="dropdown-item upload_count">자동 03</button></li>
            <li><button class="dropdown-item upload_count">자동 04</button></li>
            <li><button class="dropdown-item upload_count">자동 05</button></li>
            <li><button class="dropdown-item upload_count">자동 06</button></li>
            <li><button class="dropdown-item upload_count">자동 07</button></li>
            <li><button class="dropdown-item upload_count">자동 08</button></li>
            <li><button class="dropdown-item upload_count">자동 09</button></li>
            <li><button class="dropdown-item upload_count">자동 10</button></li>
          </ul>
        </div>
      </div>
      <div class="d-grid align-center grid_set mt-3">
        <input class="ms-1" style="grid-area: sidebar; margin-top: 5px;" type="checkbox" name="" id="">
        전체
      </div>
      <div class="d-grid align-center grid_set">
        <input class="ms-1" style="grid-area: sidebar; margin-top: 5px;" type="checkbox" name="" id="">
        전체
      </div>
      <div class="d-grid align-center grid_set">
        <input class="ms-1" style="grid-area: sidebar; margin-top: 5px;" type="checkbox" name="" id="">
        전체
      </div>
      <div class="d-grid align-center grid_set">
        <input class="ms-1" style="grid-area: sidebar; margin-top: 5px;" type="checkbox" name="" id="">
        전체
      </div>
      <div class="d-grid align-center grid_set">
        <input class="ms-1" style="grid-area: sidebar; margin-top: 5px;" type="checkbox" name="" id="">
        전체
      </div>
    </div>

  </section>
</body>

<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
<script>
  var installer_json = JSON.parse(`<?php echo json_encode($installer_array); ?>`);
  var temp;
  var i = 0;

  $('.selector').sortable({
    item: $('.selectorr'),
    start: function(event, ui) {
      console.log("######start######");
      console.log("index : " + ui.item.index());
      console.log(ui.item.prev().attr('value'));
      console.log("###############");
    },
    stop: function(event, ui) {
      console.log("######stop#####");
      console.log("index : " + ui.item.index());
      console.log(ui.item.prev().attr('value'));
      console.log("###############");
    }
  })

  installer_json.forEach(function(json) {
    temp += `<li><button class="dropdown-item installer">${json.name}</button></li>`;
    if (!i) {
      temp = `<li><button class="dropdown-item installer">${json.name}</button></li>`;
    }
    i += 1;
  });
  console.log(temp);

  function test() {
    $(".installer_scroll").each(function(index, value) {
      $(this).append(temp);
    });
  }

  function testt() {
    var fd = new FormData();

    $.ajax({
      url: './php/test.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  function testtt() {
    var fd = new FormData();
    fd.append("ddd", 1);

    $.ajax({
      url: './php/test.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }
</script>