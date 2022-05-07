<?php
include "./php/db.php";
include "./php/login-ok.php";

$userid = $_SESSION['userid'];
$name = $_SESSION['name'];

$auth_sql = "SELECT * FROM user WHERE name = '$name' AND user_id = '$userid'";
$auth_result = mysqli_query($mysqli, $auth_sql);
$auth_data = mysqli_fetch_array($auth_result);

if(!($auth_data['position'] == 1 || 99)) {
  echo "<script>location.replace('index.php');</script>";   
}

function spec_table_temp_set($user_name, $user_id, $user_pwd, $user_phone, $user_email) {
  $temp = "
      <table class=\"w-100 spec_manege_table manege_table_border mb-3\">
        <tr class=\"table_click\">
          <td id=\"name\" class=\"px-2 manege_table_border name\">$user_name</td>
          <td id=\"id\" class=\"px-2 manege_table_border id\">$user_id</td>
          <td id=\"pwd\" class=\"px-2 manege_table_border pwd\">$user_pwd</td>
        </tr>
        <tr class=\"\">
          <td id=\"phone\" class=\"px-2 table_click manege_table_border phone\" colspan=\"2\">$user_phone</td>
          <td class=\"px-2 text-center manege_table_border h-3r w-13 dropdown\" colspan=\"3\">
            <div class=\"btn text-info dropdownMenu p-0 w-100\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
              소속
            </div>
            <ul class=\"dropdown-menu dropdown-scroll\">
              <li><button class=\"dropdown-item\" value=\"b01\">본사</button></li>
              <li><button class=\"dropdown-item\" value=\"b02\">지사A</button></li>
              <li><button class=\"dropdown-item\" value=\"b03\">지사B</button></li>
              <li><button class=\"dropdown-item\" value=\"b04\">지사C</button></li>
            </ul>
          </td>
        </tr>
        <tr class=\"\">
          <td id=\"email\" class=\"px-2 table_click manege_table_border email\" colspan=\"2\">$user_email</td>
          <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
            <button class=\"btn text-primary p-0 w-100\">권한<br>초기화</button>
          </td>
        </tr>
      </table>";

  return $temp;
}

function unspec_table_temp_set($user_name, $user_id, $user_pwd, $user_phone, $user_email) {
  $temp = "<table class=\"w-100 unspec_manege_table manege_table_border mb-3\">
          <tr class=\"table_click\">
            <td id=\"name\" class=\"px-2 manege_table_border name\">$user_name</td>
            <td id=\"id\" class=\"px-2 manege_table_border id\">$user_id</td>
            <td id=\"phone\" class=\"px-2 manege_table_border pwd\">$user_pwd</td>
          </tr>
          <tr class=\"\">
            <td id=\"phone\" class=\"px-2 manege_table_border table_click phone\" colspan=\"2\">$user_phone</td>
            <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">비번<br>초기화</button>
            </td>
          </tr>
          <tr class=\"\">
            <td id=\"email\" class=\"px-2 manege_table_border table_click email\" colspan=\"2\">$user_email</td>
            <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">정보<br>삭제</button>
            </td>
          </tr>
        </table>";

  return $temp;
}

$user_sql = "SELECT * FROM user WHERE not position in('99') OR position is null";
$user_result = mysqli_query($mysqli, $user_sql);
$user_data = mysqli_fetch_array($user_result);
$unspec_data = array();
$spec_data = array();

while($user_data != null) {
  if(!isset($user_data["position"])) {
    $unspec_data[] = $user_data;
  } else {
    $spec_data[] = $user_data;
  }
  $user_data = mysqli_fetch_array($user_result);
}

$spec_tables = array();

for ($index_b = 0; $index_b <= 3; $index_b = $index_b + 1) {
  $spec_table_set = "<div class=\"spec_user_form\">";
  foreach($spec_data as $index => $value) {
    if($value["position"] == $index_b)
      $spec_table_set = $spec_table_set . spec_table_temp_set($value["name"], $value["user_id"], "*****", $value["phone"], $value["email"]);
  }
  $spec_table_set = $spec_table_set . "</div>";
  $spec_tables[] = $spec_table_set;
}

$unspec_table_set = "<div id=\"unspec_user_form\">";
foreach($unspec_data as $index => $value) {
  $unspec_table_set = $unspec_table_set . unspec_table_temp_set($value["name"], $value["user_id"], "*****", $value["phone"], $value["email"]);
}
$unspec_table_set = $unspec_table_set . "</div>";
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
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-4 fs-5 h-5r">권한</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-4 fs-5">설치</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-4 fs-5">유지보수</button>
    </div>
    <div class="row mt-5 d-flex ">
      <div class="col-44 p-0">
        <div class="flex-center fs-4 h-4r mb-3 manege_table_border">미지정</div>
        <?php
        echo $unspec_table_set;
        ?>
      </div>
      <div class="col-9 p-0 mx-2">
        <div class="vh-24"></div>
        <div class="border-bl h-4r flex-center">
          <button class="btn toright_arrow" type="button">오른쪽</button>
        </div>
        <div class="border-bl h-4r flex-center">
          <button class="btn toleft_arrow" type="button">왼쪽</button>
        </div>
      </div>

      <div class="col-44 p-0">
        <div class="flex-center fs-4 h-4r border-bl mb-3">
          <div class="dropdown text-center">
            <div class="btn btn-white dropdown-toggle fs-4 dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" value="a01">
              관리권한
            </div>
            <ul class="dropdown-menu dropdown-scroll">
              <li><button class="dropdown-item" value="a01" onclick="auth_dropdown(0);">관리권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a02" onclick="auth_dropdown(1);">설치권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a03" onclick="auth_dropdown(2);">유지보수권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a04" onclick="auth_dropdown(3);">게스트권한&nbsp</button></li>
            </ul>
          </div>
        </div>
        <?php
        foreach ($spec_tables as $key => $table) {
          echo $table;
        }
        ?>
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
<script type="text/javascript" src="script/manege-auth.js?<?php echo time(); ?>"></script>
<script>
  function top_menu(index) {
    console.log("top : " + index);
    document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
    document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');
  }

  function dropdown_init() {
    document.querySelectorAll('.dropdownMenu').forEach(function(a, index) {
      dropdown_setting(index);
    });
  }

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

  dropdown_init();
</script>

</html>