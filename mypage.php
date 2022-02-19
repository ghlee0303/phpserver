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

    <div class="container-sm">
        <div class="fs-mobile-2" >마이페이지</div>
        <table class="table install-table table-border fs-4 align-middle">
          <tr>
            <td class="col-3">이름</td>
            <td class="col-5 border-bl text-center h-info_form">이름</td>
          </tr>
          
          <tr>
            <td class="col-3">비밀번호</td>
            <td class="col-5 border-bl text-center h-info_form">*******</td>
          </tr>
          <tr>
            <td class="col-3">연락처</td>
            <td class="col-5 border-bl text-center h-info_form">01099998888</td>
          </tr>
          <tr>
            <td class="col-3">이메일</td>
            <td class="col-5 border-bl text-center h-info_form">abcdefghijk@asssdass</td>
          </tr>
        </table>
        <button type="button" class="btn btn-outline-primary me-2 mt-5 btn-mobile-1 f-end" onclick="location.replace('/edit-my.php') ">수정</button>
    </div>
  </body>
</html>