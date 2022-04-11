<?php
include "./php/db.php";
include "./php/login-ok.php";

/*
class table_set {
  private $user_name;
  private $user_id;
  private $user_pwd;
  private $user_phone;
  private $user_email;

  public function __construct($user_name, $user_id, $user_pwd, $user_phone, $user_email) {
    $this->user_name = $user_name;
    $this->user_id = $user_id;
    $this->user_pwd = $user_pwd;
    $this->user_phone = $user_phone;
    $this->user_email = $user_email; 
  }

  public function spec_table_temp_set() {
    $temp = "<table class=\"w-100 border-bl spec_user_table\">
          <tr class=\"manege_table_border_bottom\">
            <td class=\"px-2\">$this->user_name</td>
            <td class=\"manege_table_border_x px-2\">$this->user_id</td>
            <td class=\"px-2\">$this->user_pwd</td>
          </tr>
          <tr class=\"manege_table_border_bottom\">
            <td class=\"px-2\" colspan=\"2\">$this->user_phone</td>
            <td class=\"px-2 text-center manege_table_border_x h-3r dropdown\" colspan=\"3\">
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
          <tr class=\"manege_table_border_bottom\">
            <td class=\"px-2\" colspan=\"2\">$this->user_email</td>
            <td class=\"p-0 text-center manege_table_border_x\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">권한<br>초기화</button>
            </td>
          </tr>
        </table>";

    return $temp;
  }
}*/

function spec_table_temp_set($user_name, $user_id, $user_pwd, $user_phone, $user_email)
{
  $temp = "
      <table class=\"w-100 border-bl mb-3 user_table\">
        <tr class=\"manege_table_border_bottom\">
          <td class=\"px-2\">$user_name</td>
          <td class=\"manege_table_border_x px-2\">$user_id</td>
          <td class=\"px-2\">$user_pwd</td>
        </tr>
        <tr class=\"manege_table_border_bottom\">
          <td class=\"px-2\" colspan=\"2\">$user_phone</td>
          <td class=\"px-2 text-center manege_table_border_x h-3r dropdown\" colspan=\"3\">
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
        <tr class=\"manege_table_border_bottom\">
          <td class=\"px-2\" colspan=\"2\">$user_email</td>
          <td class=\"p-0 text-center manege_table_border_x\" colspan=\"3\">
            <button class=\"btn text-primary p-0 w-100\">권한<br>초기화</button>
          </td>
        </tr>
      </table>";

  return $temp;
}

$spec_tables = array();
for ($index_b = 0; $index_b <= 3; $index_b = $index_b + 1) {
  $spec_table_set = "<div class=\"spec_user_table\">";
  for ($index_a = 0; $index_a <= 3; $index_a = $index_a + 1) {
    $spec_table_set = $spec_table_set . spec_table_temp_set("홍길동", "wwwww" . $index_a . $index_b, "*****", "010-8888-7777", "eeeee@eewwq");
  }
  $spec_table_set = $spec_table_set . "</div>";
  $spec_tables[$index_b] = $spec_table_set;
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
  <?php include "./header.php" ?>
  <div class=" container container-mobile-1 pb-3">
    <div class="row mb-3">
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-3 fs-5 h-5r">관리 현황</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-3 fs-5">권한</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-3 fs-5">설치</button>
      <button type="button" onclick="top_menu(3)" class="btn btn-outline-dark rounded-3 col-3 fs-5">유지보수</button>
    </div>
    <div class="row mt-5 d-flex ">
      <div class="col-44 p-0">
        <div class="flex-center fs-4 h-4r border-bl mb-3">미지정</div>
        <table class="w-100 border-bl unspec_user_table">
          <tr class="manege_table_border_bottom">
            <td class="px-2">홍길동</td>
            <td class="manege_table_border_x px-2">fdfdf</td>
            <td class="px-2">*******</td>
          </tr>
          <tr class="manege_table_border_bottom">
            <td class="px-2" colspan="2">010-0000-0000</td>
            <td class="p-0 text-center manege_table_border_x" colspan="3">
              <button class="btn text-primary p-0 w-100">비번<br>초기화</button>
            </td>
          </tr>
          <tr class="manege_table_border_bottom">
            <td class="px-2" colspan="2">pjh1343@naver.com</td>
            <td class="p-0 text-center manege_table_border_x" colspan="3">
              <button class="btn text-primary p-0 w-100">정보<br>삭제</button>
            </td>
          </tr>
        </table>
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
              <li><button class="dropdown-item" value="a01" onclick="test(0);">관리권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a02" onclick="test(1);">설치권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a03" onclick="test(2);">유지보수권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a04" onclick="test(3);">게스트권한&nbsp</button></li>
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
<script>
  var btn = [];
  var menu = [];
  var auth_val = 0;

  var user_table = document.querySelectorAll('.user_table');
  user_table.forEach(function(table, index) {
    table.onclick = function() {
      alert('클릭');
    }
  })

  document.querySelectorAll('.spec_user_table').forEach(function(table, index) {
    if (index >= 1) {
      table.style.display = "none";
    }
  })

  function dropdown_init() {
    document.querySelectorAll('.dropdownMenu').forEach(function(a, index) {
      console.log(index);
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

  function top_menu(index) {
    console.log("top : " + index);
    document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
    document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');
  }

  function test(index) {
    if (auth_val != index) {
      var view = document.querySelectorAll('.spec_user_table');
      view[index].style.display = '';
      view[auth_val].style.display = 'none';

      auth_val = index;
    }
  }
</script>

</html>