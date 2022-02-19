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
    <?php include "./header.php"; ?>
    <div class="container container-mobile-1">
    <div class="fs-mobile-2">내 정보 수정</div>
        <form action="" method="post" onsubmit="return false">
            <table class="table install-table table-border fs-4 align-middle">
                <tr>
                    <td class="">이름</td>
                    <td colspan="2" class="col-5 border-bl text-center h-info_form">홍길동</td>
                </tr>
                <tr>
                    <td class="col-3">비밀번호</td>
                    <td class="">현재 비밀번호</td>
                    <td class="col-5 border-bl text-center p-0">
                        <input type="text" class="form-control fs-4 border-0 h-info_form" id="pre_pwd" name="pwd1">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="1">새 비밀번호</td>
                    <td class="col-5 border-bl text-center p-0">
                        <input type="text" class="form-control fs-4 border-0 h-info_form" id="new_pwd_1" name="pwd2">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="col-5" colspan="1">새 비밀번호 확인</td>
                    <td class="col-5 border-bl text-center p-0">
                        <input type="text" class="form-control fs-4 border-0 h-info_form" id="new_pwd_2" name="pwd3">
                    </td>
                </tr>
                <tr>
                    <td class="">연락처</td>
                    <td colspan="2" class="col-5 border-bl text-center p-0">
                        <input type="text" class="form-control fs-4 border-0 h-info_form" id="phoneNumber" name="phone">
                    </td>
                </tr>
                <tr>
                    <td class="">이메일</td>
                    <td colspan="2" class="col-5 border-bl text-center p-0">
                        <input type="text" class="form-control fs-4 border-0 h-info_form" id="email" name="email">
                    </td>
                </tr>
            </table>
            <input type="submit" class="btn btn-outline-primary mt-5 fs-mobile f-end" value="저장">
        </form>
    </div>
  </body>
</html>