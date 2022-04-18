
<?php
  include "./php/db.php";

  if($_SERVER['REQUEST_METHOD']=='POST') {
    $userid = $_POST['id'];
    $userpwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $username = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO user(name, user_id, user_pwd, phone, email) VALUES('$username', '$userid' ,'$userpwd' ,'$phone' ,'$email')";
                            
    $result = mysqli_query($mysqli, $sql);
             
    if($result) {
      echo "<script>alert('회원가입 성공');</script>";
      echo "<script>location.href='/login.php';</script>";
    }
    else { 
      echo "<script>alert('회원가입 실패');</script>";
      echo "<script>location.href='#!';</script>";
    }
  }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <meta charset="utf-8">
    <title></title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <style>
    </style>
  </head>
  <body class="text-center">
    
  <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form class="mb-md-5 mt-md-4 pb-5" action="" method="post">

              <h2 class="fw-bold mb-2 text-uppercase mb-5">Login</h2>

              <div class="form-outline form-white mb-4">
                <input type="text" id="typeName" class="form-control form-control-lg" name="name"/>
                <label class="form-label" for="typeName">이름</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="typeUserID" class="form-control form-control-lg" name="id"/>
                <label class="form-label" for="typeUserID">아이디</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" name="pwd"/>
                <label class="form-label" for="typePasswordX">비밀번호</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"/>
                <label class="form-label" for="typeEmailX">이메일</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="typeEmailX" class="form-control form-control-lg" name="phone"/>
                <label class="form-label" for="typeEmailX">전화번호</label>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">회원가입</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    
  </body>
</html>
