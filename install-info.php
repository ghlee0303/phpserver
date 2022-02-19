<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
  <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
  <script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />
</head>

<style>

</style>

<body>
  <?php include "./header.php" ?>
  <div class="container container-mobile-1 pb-3">
    <div class="row mb-3">
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-3 fs-5">설치 장소</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-3 fs-5">메뉴 설정</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-3 fs-5">체크리스트</button>
      <button type="button" onclick="top_menu(3)" class="btn btn-outline-dark rounded-3 col-3 fs-5">사진첨부</button>
    </div>
    <?php include "./install-form/form_1.php" ?>
    <?php include "./install-form/form_2.php" ?>
    <?php include "./install-form/form_3.php" ?>
    <?php include "./install-form/form_4.php" ?>
    <?php include "install-comment.php" ?>

  </div>

</body>
<script type="text/javascript">
  $(function() {
    $('#datetimepicker').datetimepicker({
      locale: moment.locale('ko'),
      format: 'YYYY.MM.DD HH:mm:ss'
    });
  });
  var menu_val = 0;
  var edit_val = 0;

  function edit_btn(index, val) {
    var edit = document.querySelectorAll('.edit');
    var view = document.querySelectorAll('.install');

    if (val) {
      console.log("edit_btn 1 : " + index + "/" + edit_val);
      edit[index].style.display = '';
      view[index].style.display = 'none';
      edit_val = index + 1;
    } else {
      console.log("edit_btn 2 : " + index + "/" + edit_val);
      edit[--edit_val].style.display = 'none';
      view[index].style.display = '';
      edit_val = 0;
    }
  }

  function top_menu(index) {
    if (menu_val != index) {
      document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
      document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');

      var view = document.querySelectorAll('.install');

      if (edit_val > 0) {
        console.log("top 1 : " + index + "/" + edit_val);
        edit_btn(index, 0);
      } else {
        console.log("top 2 : " + index + "/" + edit_val);
        view[index].style.display = '';
        view[menu_val].style.display = 'none';
      }
      menu_val = index;
    }
  }

  function calendar_btn() {
    document.getElementById("calendar_text").readOnly = false;
  }
  document.getElementById('calendar_text').addEventListener('blur', function() {
    document.getElementById("calendar_text").readOnly = true;
  });
</script>
<script type="text/javascript" src="script/info-edit.js"></script>

</html>