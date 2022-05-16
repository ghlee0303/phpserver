<?php
include "./php/db.php";
include "./php/login-ok.php";

$install_db_data = array();
$install_spot_db_data = array();

$user_sql = "SELECT * FROM user WHERE name = '$_SESSION[name]' AND user_id = '$_SESSION[userid]'";
$user_result = mysqli_query($mysqli, $user_sql);
$user_data = mysqli_fetch_array($user_result);

if (empty($_GET['search'])) {
  $install_sql = "SELECT complete, type, count, date_format(install_spot.date, '%Y-%m-%d') as date, install_spot.address_2 as address, install.id as id FROM install JOIN install_spot ON install.install_spot_id = install_spot.id WHERE user_id = $user_data[id] ORDER BY date DESC";
  $install_result = mysqli_query($mysqli, $install_sql);
} else {
  $install_sql = "SELECT complete, type, count, date_format(install_spot.date, '%Y-%m-%d') as date, install_spot.address_2 as address, install.id as id FROM install JOIN install_spot ON install.install_spot_id = install_spot.id JOIN user ON install.user_id = user.id WHERE MATCH(install_spot.address_2) AGAINST('$_GET[search]*' IN BOOLEAN MODE) OR MATCH(user.name) AGAINST('$_GET[search]*' IN BOOLEAN MODE)";
  $install_result = mysqli_query($mysqli, $install_sql);
}

while ($install_spot_row = mysqli_fetch_array($install_result)) {
  $install_spot_db_data[] = $install_spot_row;
}
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
      <tbody>
        <?php
        foreach ($install_spot_db_data as $key => $value) {
          switch ($value['type']) {
            case 0:
              $type_btn = "설치";
              break;
            case 1:
              $type_btn = "연동";
              break;
            case 2:
              $type_btn = "제어기";
              break;
          }
          $complete_color = "blue";
          if (empty($value['complete'])) {
            $complete_color = "red";
          }
          $index = $key + 1;
          $ddd = "
                    <tr onclick=\"location.href='/install-info.php?id=$value[id]' \">
                        <td>$index</td>
                        <td>$value[date]</td>
                        <td>$value[address]</td>
                        <td>홍길동</td>
                        <td style=\"color:$complete_color;\">$type_btn</td>
                        <td class='text-center'>$value[count]/78</td>
                    </tr>";
          echo $ddd;
        }
        ?>
      </tbody>
    </table>
    <div class="d-flex text-end">
      <div class="dropdown">
        <div class="btn dropdown-toggle fs-4 w-10 border-bl dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" name="region">
          설치
        </div>
        <ul class="dropdown-menu dropdown-scroll_2">
          <li><button class="dropdown-item">설치</button></li>
          <li><button class="dropdown-item">연동</button></li>
          <li><button class="dropdown-item">제어기</button></li>
        </ul>
      </div>
      <button type="button" class="btn fs-4 border-bl w-10" onclick="maintenance_new()">글쓰기</button>
    </div>
  </div>
</body>
<script type="text/javascript" src="script/dropdown.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="script/test.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
<script>
  function dropdown_value(dropdown_item, data) {
    dropdown_item.each(function(index, element) {
      if (index == data) {
        element.click();
        return;
      }
    });
  }

  function dropdown_init() {
    $('.dropdownMenu').each(function(index, value) {
      dropdown_setting($(this));
    });
  }

  function dropdown_setting(dropdown_menu) {
    var btn = dropdown_menu.siblings('.dropdown-menu').children();

    btn.each(function(index, value) {
      value.addEventListener("click", function() {
        dropdown_menu.text(value.innerText);
        //dropdown_menu.val(btn.value);
      }, false);
    });
  }

  function getElementIndex(e, range) {
    if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
  }

  function maintenance_new() {
    var type_value = $('.dropdownMenu').eq(1).text();
    //console.log(type_value);
    location.href = '/install-info.php?id=new&type=' + type_value;
  }

  function search_submit() {
    var search_value = document.querySelector('#search').value;
    location.href = "?search=" + search_value;
  }

  window.onload = function() {
    dropdown_init();
  };
</script>

</html>