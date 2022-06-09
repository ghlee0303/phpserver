<?php
include "./php/db.php";
include "./php/login-ok.php";
//  maintenance

$user_sql = "SELECT * FROM user WHERE name = '$_SESSION[name]' AND user_id = '$_SESSION[userid]'";
$user_result = mysqli_query($mysqli, $user_sql);
$user_data = mysqli_fetch_array($user_result);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta charset="utf-8">
  <title></title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
  <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />
</head>

<body>
  <?php include "./header.php"; ?>
  <button onclick="call_maintenance_list()">eeeee</button>
  <div class="container container-mobile-1 pb-3">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between pb-4 mt-4 nav_bottom_line">
      <div class="row">
        <div class="col dropdown">
          <div class="col btn btn-secondary dropdown-toggle fs-3 w-dropdown dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" name="region">
            지역
          </div>
          <ul class="dropdown-menu dropdown-scroll">
            <li><button class="dropdown-item">서울특별시</button></li>
            <li><button class="dropdown-item">부산특별시</button></li>
            <li><button class="dropdown-item">대구특별시</button></li>
            <li><button class="dropdown-item">서울특별시</button></li>
            <li><button class="dropdown-item">부산특별시</button></li>
            <li><button class="dropdown-item">대구특별시</button></li>
            <li><button class="dropdown-item">서울특별시</button></li>
            <li><button class="dropdown-item">부산특별시</button></li>
            <li><button class="dropdown-item">대구특별시</button></li>
          </ul>
        </div>
      </div>

      <div class="col d-flex align-items-center">
        <form class="me-3" id="search-form" onsubmit="return false">
          <input type="search" id="search" class="form-control float-end w-75 fs-4" placeholder="검색">
        </form>
        <button type="submit" class="w-25 btn btn-outline-primary me-2 px-0 fs-4" onclick="search_submit()">검색</button>
      </div>
    </header>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between pb-4 mt-4 nav_bottom_line">
      <?php include "./calendar.php"; ?>
    </header>
    <table class="table table-striped table-scroll">
      <thead>
        <tr>
          <th scope="col" class="pt-4 fs-5 ">#</th>
          <th scope="col" class="pt-4 fs-5 ">설치일자</th>
          <th scope="col" class="pt-4 fs-5 ">방문 장소</th>
          <th scope="col" class="pt-4 fs-5 ">성명</th>
          <th scope="col" class="pt-4 fs-5 ">상태</th>
          <th scope="col" class="pt-4 fs-5 ">입력</th>
        </tr>
      </thead>
      <tbody id="maintenance_list_tbody">

      </tbody>
    </table>
    <div class="d-flex text-end">
      <div class="dropdown">
        <div class="btn dropdown-toggle fs-4 w-10 border-bl maintenance_type dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" name="type">
          유지보수 종류
        </div>
        <ul class="dropdown-menu dropdown-scroll">
          <li><button class="dropdown-item" value="0">설치</button></li>
          <li><button class="dropdown-item" value="1">연동</button></li>
          <li><button class="dropdown-item" value="2">제어기</button></li>
        </ul>
      </div>
      <button type="button" class="btn fs-4 border-bl w-10" onclick="maintenance_new()">글쓰기</button>
    </div>
  </div>
</body>
<script type="text/javascript" src="script/test.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
<script>
  var called = 0;
  window.onload = function() {
    dropdown_init();
    call_maintenance_list();
  }

  function dropdown_init() {
    $(document).on('click', '.dropdown-item', function() {
      console.log($(this));
      var parent = $(this).parents(".dropdown-menu").siblings(".dropdownMenu");
      parent.text($(this).text());
      parent.attr("value", $(this).attr("value"));
    });
  }

  function maintenance_new() {
    var type_value = document.querySelector('.dropdownMenu')[1].value;
    console.log(type_value);
    location.href = '/maintenance-info.php?id=new&type=' + type_value;
  }

  function search_submit() {
    var search_value = document.querySelector('#search').value;
    var date_1 = $(".datetimepicker-input:eq(0)").val();
    var date_2 = $(".datetimepicker-input:eq(1)").val();
    location.href = `?search=${search_value}&date1=${date_1}&date2=${date_2}`;
  }

  function call_maintenance_list() {
    var fd = new FormData();

    fd.append('type', $(".maintenance_type").attr("value"));
    fd.append('date_1', $(".datetimepicker-input:eq(0)").val());
    fd.append('date_2', $(".datetimepicker-input:eq(1)").val());
    fd.append('search', $("#search").val());
    fd.append('name', "<?php echo $name; ?>");
    fd.append('userid', "<?php echo $userid; ?>");

    $.ajax({
      url: './php/maintenance-list.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(JSON.parse(data));
        //console.log(data);
        set_maintenance_table(JSON.parse(data));
      }
    });
  }

  function remove_maintenance_table() {
    $("#maintenance_list_tbody").children().each(function() {
      $(this).remove();
    });
  }

  function set_maintenance_table(db_data) {
    console.log("dd " + called);
    if (!called == 0) {
      remove_maintenance_table();
      console.log("eeee");
    }
    called = 1;
    db_data.forEach(function(value, index) {
      var type_btn;
      //console.log("type : " + value.type);
      switch (value.type) {
        case "0":
          //console.log("1번");
          type_btn = "설치";
          break;
        case "1":
          //console.log("2번");
          type_btn = "연동";
          break;
        case "2":
          //console.log("3번");
          type_btn = "제어기";
          break;
      }

      var complete_color = "blue";
      if (!value.complete)
        complete_color = "red";

      var date = value.date;
      if (!value.date)
        date = "";

      var address = value.address;
      if (!value.address)
        address = "";

      var period = value.period + "차";
      if (!value.period)
        period = "A/S";

      var ddd = ` 
            <tr onclick=\"location.href='/maintenance-info.php?id=${value.id}' \">
                <td>${index+1}</td>
                <td>${date}</td>
                <td>${address}</td>
                <td>${value.name}</td>
                <td style=\"color:${complete_color};\">${type_btn}</td>
                <td>${period}</td>
            </tr>`;
      $("#maintenance_list_tbody").append(ddd);
    });
  }
</script>

</html>