<?php
include "./php/db.php";
include "./php/login-ok.php";

function auth_ok($mysqli)
{
  $userid = $_SESSION['userid'];
  $name = $_SESSION['name'];

  $auth_sql = "SELECT * FROM user WHERE name = '$name' AND user_id = '$userid'";
  $auth_result = mysqli_query($mysqli, $auth_sql);
  $auth_data = mysqli_fetch_array($auth_result);

  if (!($auth_data['position'] == 1 || 99)) {
    echo "<script>location.replace('index.php');</script>";
  }
}

auth_ok($mysqli);

function spec_table_temp_set($user_index, $user_name, $user_id, $user_pwd, $user_phone, $user_email, $branch)
{
  $temp = "
      <table class=\"mw-360 spec_auth_table manege_table_border mb-3\" value=\"$user_index\">
        <tr class=\"table_click\">
          <td class=\"px-2 manege_table_border name\">$user_name</td>
          <td class=\"px-2 manege_table_border id\">$user_id</td>
          <td class=\"px-2 manege_table_border pwd\">$user_pwd</td>
        </tr>
        <tr class=\"\">
          <td class=\"px-2 table_click manege_table_border phone\" colspan=\"2\">$user_phone</td>
          <td class=\"px-2 text-center manege_table_border h-3r w-13 dropdown\" colspan=\"3\">
            <div class=\"btn dropdown-toggle text-info dropdownMenu p-0 w-100\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
              소속
            </div>
            <ul class=\"dropdown-menu dropdown-scroll branch_list\" value=\"$branch\">
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

function unspec_table_temp_set($user_index, $user_name, $user_id, $user_pwd, $user_phone, $user_email, $branch)
{
  $temp = "<table class=\"mw-360 unspec_auth_table manege_table_border mb-3\" value=\"$user_index\">
          <tr class=\"table_click\">
            <td class=\"px-2 manege_table_border name\" value=\"$branch\">$user_name</td>
            <td class=\"px-2 manege_table_border id\">$user_id</td>
            <td class=\"px-2 manege_table_border pwd\">$user_pwd</td>
          </tr>
          <tr class=\"\">
            <td class=\"px-2 manege_table_border table_click phone\" colspan=\"2\">$user_phone</td>
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

function spec_table_set($data_list)
{
  $spec_table_set = "<div class=\"spec_user_form\">";
  foreach ($data_list as $index => $value) {
    $spec_table_set = $spec_table_set . spec_table_temp_set($value["id"], $value["name"], $value["user_id"], "*****", $value["phone"], $value["email"], $value["branch_id"]);
  }
  $spec_table_set = $spec_table_set . "</div>";

  return $spec_table_set;
}

function spec_table_init($mysqli, &$admin_list, &$installer_list, &$maintainer_list)
{
  $spec_tables = array();

  $spec_tables[] = spec_table_set($admin_list);
  $spec_tables[] = spec_table_set($installer_list);
  $spec_tables[] = spec_table_set($maintainer_list);

  return $spec_tables;
}

function unspec_table_init($mysqli, &$unspec_list)
{

  $unspec_table_set = "<div id=\"unspec_user_form\">";
  foreach ($unspec_list as $index => $value) {
    $unspec_table_set = $unspec_table_set . unspec_table_temp_set($value["id"], $value["name"], $value["user_id"], "*****", $value["phone"], $value["email"], $value["branch_id"]);
  }
  $unspec_table_set = $unspec_table_set . "</div>";

  return $unspec_table_set;
}

function user_list_data_sql($mysqli, &$admin_list, &$installer_list, &$maintainer_list, &$unspec_list)
{
  $user_sql = "SELECT * FROM user WHERE not position in('99') OR position is null";
  $user_result = mysqli_query($mysqli, $user_sql);
  $user_data = mysqli_fetch_array($user_result);

  while ($user_data != null) {
    switch ($user_data['position']) {
      case 1:
        $admin_list[] = $user_data;
        break;
      case 2:
        $installer_list[] = $user_data;
        break;
      case 3:
        $maintainer_list[] = $user_data;
        break;
        /*
      case 4 :
        $guest_list[] = $user_data;
        break;*/
      default:
        $unspec_list[] = $user_data;
        break;
    }
    $user_data = mysqli_fetch_array($user_result);
  }
}

$admin_list = array();
$installer_list = array();
$maintainer_list = array();
$unspec_list = array();

user_list_data_sql($mysqli, $admin_list, $installer_list, $maintainer_list, $unspec_list);

$spec_tables = spec_table_init($mysqli, $admin_list, $installer_list, $maintainer_list);
$unspec_table_set = unspec_table_init($mysqli, $unspec_list);

$qqq = array();
test($qqq);
//print_r($qqq);
function test(&$qqq)
{
  $index = 0;
  while ($index < 10) {
    $qqq[] = "1";
    $index = $index + 1;
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
  <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />
</head>

<body>
  <?php include "./header.php" ?>
  <div class=" container container-mobile-1 pb-3">
    <div class="row mb-5">
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-4 fs-5 h-5r">권한</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-4 fs-5">설치</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-4 fs-5">유지보수</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fs-2" id="exampleModalLabel">지사 추가</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body fs-4">
            추가할 지사 명을 입력 해 주세요.
            <input id="branch_input" class="fs-4 mt-2" type="text">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="branch_insert(1)">추가</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fs-2" id="exampleModalLabel">지사 삭제</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center fs-4">
            삭제할 지사를 선택해 주세요.
            <div class="mx-auto w-75 text-center manege_table_border dropdown">
              <div id="branch_dropdown" class=" btn dropdown-toggle dropdownMenu fs-5" data-bs-toggle="dropdown" aria-expanded="false">
                지사
              </div>
              <ul class="dropdown-menu dropdown-scroll branch_list">

              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="branch_insert(0)">삭제</button>
          </div>
        </div>
      </div>
    </div>


    <div class="eeeee">
      <button class="test">dddd</button>
    </div>
    <div class="qqqqq">
      <button class="test2">dddd</button>
    </div>
    <div class="wwwww">
      <button class="test3">33333</button>
    </div>

    <div class="row mt-0 d-flex auth">
      <div class="row mb-0 mx-0 d-flex">
        <div class="col-44"></div>
        <div class="col-9"></div>
        <div class="text-center col ms-3">
          <button type="button" class="btn btn-outline-dark m-0 w-49" data-bs-toggle="modal" data-bs-target="#exampleModal">
            지사 추가
          </button>
          <button type="button" class="btn btn-outline-dark m-0 w-49" data-bs-toggle="modal" data-bs-target="#exampleModal2">
            지사 삭제
          </button>
        </div>
      </div>
      <div class="col-44 p-0">
        <div class="flex-center fs-4 h-4r mb-3 border-bl">미지정</div>
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
            <div class="btn dropdown-toggle fs-4 dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" value="a01">
              관리권한
            </div>
            <ul class="dropdown-menu dropdown-scroll">
              <li><button class="dropdown-item auth_dropdown" value="a01">관리권한&nbsp</button></li>
              <li><button class="dropdown-item auth_dropdown" value="a02">설치권한&nbsp</button></li>
              <li><button class="dropdown-item auth_dropdown" value="a03">유지보수권한&nbsp</button></li>
              <li><button class="dropdown-item auth_dropdown" value="a04">게스트권한&nbsp</button></li>
            </ul>
          </div>
        </div>
        <?php
        foreach ($spec_tables as $key => $value) {
          echo $value;
        }
        ?>
      </div>
    </div>

    <div class="row mt-5 d-flex d-none auth">
      <div class="col-44 p-0">
        <div class="flex-center fs-4 h-4r mb-3 manege_table_border">미지정</div>
        <div id="unspec_install">

        </div>
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
              설치자
            </div>
            <ul class="dropdown-menu dropdown-scroll installer">

            </ul>
          </div>
        </div>
        <div id="spec_install">

        </div>
      </div>
    </div>

    <div class="row mt-5 d-flex auth d-none">
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
              유지보수자
            </div>
            <ul class="dropdown-menu dropdown-scroll">
              <li><button class="dropdown-item" value="a01">관리권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a02">설치권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a03">유지보수권한&nbsp</button></li>
              <li><button class="dropdown-item" value="a04">게스트권한&nbsp</button></li>
            </ul>
          </div>
        </div>
        <?php
        foreach ($spec_tables as $key => $table) {
        }
        ?>
      </div>
    </div>

  </div>
</body>

<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
<script type="text/javascript" src="script/manege-auth.js?<?php echo time(); ?>"></script>
<script>
  function top_menu(index) {
    document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
    document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');

    var view = $('.auth');

    view.eq(index).removeClass('d-none');
    view.eq(top_menu_val).addClass('d-none');

    top_menu_val = index;
  }

  function dropdown_value(dropdown_item, data) {
    dropdown_item.each(function(index, element) {
      if (index == data) {
        element.click();
        return;
      }
    });
  }

  function dropdown_init() {
    $(document).on('click', '.dropdown-item', function() {
      var parent = $(this).parents(".dropdown-menu").siblings(".dropdownMenu");
      parent.text($(this).text());
      parent.attr("value", $(this).attr("value"));
    });
  }

  function branch_dropdown_init() {
    $(document).on('click', '.branch', function() {
      var fd = new FormData();
      
      fd.append('key', 5);
      fd.append('branch_id', $(this).attr("value"));
      fd.append('user_id', $(this).closest("table").attr("value"));

      console.log(`branch id : ${$(this).attr("value")} / user id : ${$(this).closest("table").attr("value")}`);

      $.ajax({
        url: './php/user-auth.php',
        data: fd,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {
        }
      });
    });
  }

  function branch_value_set(table) {
    var branch_list = table.find(`.branch[value='${table.find(`.branch_list`).attr("value")}']`);
    var branch_dropdown = table.find(`.dropdownMenu`);

    if (branch_list.attr("value")) {
      
      branch_dropdown.text(branch_list.text());
      branch_dropdown.attr("value", branch_list.attr("value"));
      console.log(table.find(`.dropdownMenu`).html());
      console.log(branch_list.text());
      console.log(branch_list.attr("value"));

    }
  }

  function getElementIndex(e, range) {
    if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
  }

  function sortable_add(target) {
    target.each(function (index, value) {
      $(this).sortable({
        start:function(event, ui){
          install_seq = ui.item.index();
        },
        stop:function(event, ui){
          install_set_seq(ui.item.index());
        },
      });
    });
  }

  window.onload = function() {
    document.querySelectorAll('.spec_user_form').forEach(function(table, index) {
      if (index >= 1) {
        table.style.display = "none";
      }
    });

    document.querySelectorAll('.spec_install_form').forEach(function(table, index) {
      if (index >= 1) {
        table.style.display = "none";
      }
    });

    arrow_click_event_init();
    dropdown_init();
    call_installer_list(0, 1);
    table_click_event_init();
    auth_dropdown_init();
    install_dropdown_init();
    branch_dropdown_init();
    call_branch_list();
    
    $(".test1").on("click", function() {
      $(`.spec_install_form`).sortable('refresh');
    });

    $(".test2").on("click", function() {
      sortable_add($(`.spec_install_form`));
    });

    $(".test3").on("click", function() {
      $(`.spec_install_form`).each(function(index, value) {
        $(this).sortable('refresh');
      });
    });
  }
</script>

</html>