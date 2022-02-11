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
    <div class="container-md mt-6">
        <form class="needs-validation" novalidate>
            <div class="mb-3 row my-5">
                <div class="col-5 fs-mobile-3">이름</div>
                <div class="col-7 fs-mobile-3">홍길동</div>
            </div>
            <div class="mb-3 row my-5">
                <div class="col-5 fs-mobile-3">아이디</div>
                <div class="col-7 fs-mobile-3">abcde123</div>
            </div>
            <div class="mb-3 row my-5">
                <label for="inputPassword" class="col-5 col-form-label fs-mobile-3 ">기존 비밀번호</label>
                <div class="col-7">
                    <input type="password" class="form-control fs-mobile-3" id="prePassword" name="pre-pwd">
                </div>
            </div>
            <div class="mb-3 row my-5">
                <label for="inputPassword" class="col-5 col-form-label fs-mobile-3">새 비밀번호</label>
                <div class="col-7">
                    <input type="password" class="form-control fs-mobile-3" id="newPassword" name="new-pwd">
                </div>
            </div>
            <div class="mb-3 row my-5">
                <label for="inputPassword" class="col-5 col-form-label fs-mobile-3">새 비밀번호 확인</label>
                <div class="col-7">
                    <input type="password" class="form-control fs-mobile-3" id="newconPassword" name="new-pwd-con">
                </div>
            </div>
            <div class="mb-3 row my-5">
                <label for="inputPassword" class="col-5 col-form-label fs-mobile-3">연락처</label>
                <div class="col-7">
                    <input type="text" class="form-control fs-mobile-3" id="phoneNumber" name="phone-num">
                </div>
            </div>
            <div class="mb-3 row my-5">
                <label for="inputPassword" class="col-5 col-form-label fs-mobile-3">이메일</label>
                <div class="col-7">
                    <input type="text" class="form-control fs-mobile-3" id="Email" name="email">
                </div>
            </div>
            <button class="btn btn-primary d-grid col-4 mx-auto mt-6 fs-mobile" type="button">저장</button>
        </form>

    </div>
  </body>
</html>