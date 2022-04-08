<?php
include "./php/db.php";
include "./php/login-ok.php";

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
  <?php include "./header.php" ?>
  <div class=" container container-mobile-1 pb-3">
    <div class="row mb-3">
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-3 fs-5 h-5r">관리 현황</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-3 fs-5">권한</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-3 fs-5">설치</button>
      <button type="button" onclick="top_menu(3)" class="btn btn-outline-dark rounded-3 col-3 fs-5">유지보수</button>
    </div>
    <p>Right arrow: <i class="arrow right"></i></p>
    <p>Left arrow: <i class="arrow left"></i></p>
    <p>Up arrow: <i class="arrow up"></i></p>
    <p>Down arrow: <i class="arrow down"></i></p>
    <div class="row mt-5 d-flex ">
      <div class="col-44 p-0">
        <div class="flex-center fs-4 h-4r border-bl mb-3">미지정</div>
        <table class="w-100 border-bl">
          <tr class="manege_table_border_bottom">
            <td class="px-2">홍길동</td>
            <td class="manege_table_border_x px-2">fdfdf</td>
            <td class="px-2">*******</td>
          </tr>
          <tr class="manege_table_border_bottom">
            <td class="px-2" colspan="2">010-0000-0000</td>
            <td class="px-2 text-center manege_table_border_x h-3r" colspan="3">비번<br>초기화</td>
          </tr>
          <tr class="manege_table_border_bottom">
            <td class="px-2" colspan="2">pjh1343@naver.com</td>
            <td class="px-2 text-center manege_table_border_x h-3r" colspan="3">정보<br>삭제</td>
          </tr>
        </table>
      </div>
      <div class="col p-0">
        <div class="vh-2"></div>
        <div class="border-bl h-5r flex-center">
          <button class="btn totop_arrow2" type="button">위로 올리기</button>
        </div>
      </div>
      <div class="col-44 border-bl flex-center fs-4 h-4r">
        ddd
      </div>
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
  var btn = [];
  var menu = [];

  function dropdown_setting(index) {
    menu[index] = document.querySelectorAll('.dropdownMenu')[index];
    btn[index] = document.querySelectorAll('.dropdown-scroll')[index].querySelectorAll('.dropdown-item');

    [].forEach.call(btn[index], function(e) {
      e.addEventListener("click", function() {
        var key = getElementIndex(btn[index], e);
        menu[index].innerText = btn[index][key].innerText;
        menu[index].value = btn[index][key].value;
      }, false);
    });
  }

  function getElementIndex(e, range) {
    if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
  }

  function top_menu(index) {
    document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
    document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');

  }
</script>

</html>