<?php
include "./php/db.php";
include "./php/login-ok.php";

$max_count_sql = "SELECT count(*) as count FROM user WHERE delete_yn is null AND master is null";
$max_count_result = mysqli_query($mysqli, $max_count_sql);
$max_count = mysqli_fetch_array($max_count_result)['count'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width">
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

  <!-- Modal -->
  <div class="modal fade" id="change_pwd" tabindex="-1" aria-labelledby="change_pwd_ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-2" id="change_pwd_ModalLabel">비밀번호 변경</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center fs-5">
          <span id="change_pwd_username"></span>씨의 변경할 비밀번호를 입력해주세요
          <input id="change_pwd_input" class="fs-5 mt-2" type="text">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="change_pwd()">변경</button>
        </div>
      </div>
    </div>
  </div>

  <div class=" container container-mobile-1 pb-3">
    <div class="row mb-2">
      <button type="button" onclick="location.href = '/manege-total.php' " class="btn btn-outline-dark rounded-3 col-3 fs-5">현황</button>
      <button type="button" class="btn btn-dark rounded-3 col-3 fs-5">유저관리</button>
      <button type="button" onclick="location.href = '/manege-install.php'" class="btn btn-outline-dark rounded-3 col-3 fs-5">설치관리</button>
      <button type="button" onclick="" class="btn btn-outline-dark rounded-3 col-3 fs-5">유지보수관리</button>
    </div>
  </div>

  <div class="container container-3">
    <div class="d-flex bg-grey justify-content-center p-2" style="width: 240px;">
      <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
        지사 추가
      </button>
      <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        지사 삭제
      </button>
    </div>
    <div id="user_list" class="w-100">
      <section class="d-flex w-100 justify-content-center bg-grey border-bottom-bl">
        <input type="checkbox" class="form-check-input mx-2 my-auto" style='zoom:1.4'>
        <div class="col text-center " style="flex-grow: 0.4;">#</div>
        <div class="col text-center ">이름</div>
        <div class="col text-center ">아이디</div>
        <div class="col text-center " style="flex-grow: 2.4;">이메일</div>
        <div class="col text-center " style="flex-grow: 2;">전화번호</div>
        <div class="col text-center " style="flex-grow: 1.5;">소속</div>
        <div class="col text-center " style="flex-grow: 3.5;">권한</div>
        <div class="col text-center " style="flex-grow: 0.8;">총설치</div>
        <div class="col text-center " style="flex-grow: 0.8;">총유지</div>
        <div class="col text-center " style="flex-grow: 0.8;">A/S</div>
        <div class="col text-center ">비번변경</div>
      </section>

    </div>
    <button type="button" class="btn btn-outline-dark mt-4" onclick="user_delete();">
      삭제
    </button>
  </div>
</body>

<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
<script>
  var branch_list;
  var max = <?php echo $max_count; ?>;
  window.onload = function() {
    dropdown_init();
    call_branch_list();
    call_user_list();
    auth_check_init();
    user_branch_dropdown_init();
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

  function getElementIndex(e, range) {
    if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
  }

  /*
  ################
  기초 설정 함수
  ################
  */

  function list_prepend(ul_tag, data) {
    return ul_tag.prepend(data);
  }

  function list_append(ul_tag, data) {
    return ul_tag.append(data);
  }

  function list_clean(ul_tag) {
    ul_tag.remove();
  }

  /*
  ################
  modal 설정 함수
  ################
  */

  $('#change_pwd').on('hidden.bs.modal', function(e) {
    $("#change_pwd_input").val("");
  });

  $(document).on("click", ".change_pwd_btn", function(e) {
    $("#change_pwd_username").text($(this).siblings(".user_name").text().trim());
    $("#change_pwd_username").attr("value", $(this).parent().attr("value"));
    e.preventDefault();
    $('#change_pwd').modal("show");
  });

  /*
  ################
  branch 함수
  ################
  */
  /*
    function branch_dropdown_init() {
      $(document).on('click', '.branch', function() {
        console.log("ㅇㅇㅇㅇ");
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
          success: function(data) {}
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
*/
  function branch_insert(jud) {
    var fd = new FormData();

    if (jud) {
      fd.append('branch_name', $('#branch_input').val());
    } else {
      fd.append('branch_name', $('#branch_dropdown').text());
    }

    fd.append('jud', jud);
    fd.append('key_branch', 1);

    $.ajax({
      url: './php/manege-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        call_branch_list();
      }
    });
  }

  function call_branch_list() {
    var fd = new FormData();
    fd.append('key_branch', 2);

    $.ajax({
      url: './php/manege-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        var json = JSON.parse(data);
        console.log(json);
        append_branch_list(json);
      }
    });
  }

  function append_branch_list(branch_json) {
    branch_json.forEach(function(value, index) {
      if (!index) {
        branch_list = branch_list_temp(value); // 처음 함수 호출 시 branch_list 내용 초기화
      }
      console.log(index);
      branch_list += branch_list_temp(value);
    });
    console.log(branch_list);
  }

  function user_branch_dropdown_init() {
    $(document).on("click", ".user_branch_list .branch", function() {
      console.log($(this).html());
      var fd = new FormData();

      fd.append('key_branch', 3);
      fd.append('branch_id', $(this).attr("value"));
      fd.append('user_id', $(this).closest(".list_section").attr("value"));

      console.log(`branch id : ${$(this).attr("value")} / user id : ${$(this).closest(".list_section").attr("value")}`);

      $.ajax({
        url: './php/manege-server.php',
        data: fd,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data) {
          console.log(data);
        }
      });
    });
  }

  /*
  ################
  user 함수
  ################
  */

  function call_user_list() {
    var fd = new FormData();
    fd.append('key_user', 2);

    $.ajax({
      url: './php/manege-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        var json = JSON.parse(data);
        append_user_list(json);
      }
    });
  }

  function append_user_list(user_json) {
    user_json.forEach(function(value, index) {
      list_append($("#user_list"), user_list_temp(value, max - index));
      var user_list = $(".list_section:last");

      if (value.admin)
        user_list.find('.auth_check:eq(0)').prop("checked", true);

      if (value.install)
        user_list.find('.auth_check:eq(1)').prop("checked", true);

      if (value.maintenance)
        user_list.find('.auth_check:eq(2)').prop("checked", true);

      if (value.guest)
        user_list.find('.auth_check:eq(3)').prop("checked", true);
    });
  }

  function user_delete() {
    if (!confirm("해당 회원들을 삭제 하시겠습니까?"))
      return;
    var user_delete_array = [];
    var fd = new FormData();

    $(".user_select_check").each(function(index, value) {
      if ($(this).is(":checked")) {
        user_delete_array.push($(this).closest(".list_section").attr("value"));
      }
    });

    fd.append('key_user', 3);
    fd.append('user_delete_array', JSON.stringify(user_delete_array));

    $.ajax({
      url: './php/manege-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  /*
  ################
  auth 함수
  ################
  */

  function auth_check_init() {
    $(document).on("change", ".auth_check", function() {
      var position = "";
      switch ($(this).parent().text().trim()) {
        case "관리":
          position = "admin";
          break;
        case "설치":
          position = "install";
          break;
        case "유지":
          position = "maintenance";
          break;
        case "게스트":
          position = "guest";
          break;
      }
      var index = $(this).closest(".list_section").attr("value");
      var jud = $(this).is(":checked") ? 1 : 0;
      set_user_auth(jud, position, index);
    });
  }

  function set_user_auth(jud, position, index) {

    var fd = new FormData();
    fd.append('key_user', 1);
    fd.append('jud', jud);
    fd.append('position', position);
    fd.append('index', index);

    $.ajax({
      url: './php/manege-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  /*
  ################
  pwd 함수
  ################
  */

  function change_pwd() {
    if (!confirm($("#change_pwd_username").text() + "씨의 비밀번호를 " + $("#change_pwd_input").val() + " 로 변경 하시겠습니까?"))
      return;

    var fd = new FormData();
    fd.append('key_user', 4);
    fd.append('pwd', $("#change_pwd_input").val());
    fd.append('user_index', $("#change_pwd_username").attr("value"));

    $.ajax({
      url: './php/manege-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  /*
  ################
  temp 함수
  ################
  */

  function user_list_temp(user_json, index) {
    var branch = user_json.branch_name ? user_json.branch_name : "지사";
    var temp = `
    <section class=\"list_section d-flex w-100 justify-content-center border-bottom-gr\" value=\"${user_json.u_id}\">
      <input type=\"checkbox\" class=\"form-check-input user_select_check mx-2 my-auto\" style='zoom:1.4'>
      <div class=\"col text-center \" style=\"flex-grow: 0.4;\">${index}</div>
      <div class=\"col text-center user_name\">${user_json.name}</div>
      <div class=\"col text-center \">${user_json.user_id}</div>
      <div class=\"col text-center \" style=\"flex-grow: 2.4;\">${user_json.email}</div>
      <div class=\"col text-center \" style=\"flex-grow: 2;\">${user_json.phone}</div>
      <div class=\"dropdown col text-center p-0\" style=\"flex-grow: 1.5;\">
        <div id=\"branch_dropdown\" class=\" btn dropdown-toggle dropdownMenu p-0\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
          ${branch}
        </div>
        <ul class=\"dropdown-menu dropdown-scroll user_branch_list\">
          ${branch_list}
        </ul>
      </div>
      <div class=\"col text-center  d-flex justify-content-center\" style=\"flex-grow: 3.5;\">
        <div class=\"mx-2\">
          관리
          <input type=\"checkbox\" class=\"form-check-input auth_check my-auto\" style='zoom:1.4'>
        </div>
        <div class=\"me-2\">
          설치
          <input type=\"checkbox\" class=\"form-check-input auth_check my-auto\" style='zoom:1.4'>
        </div>
        <div class=\"me-2\">
          유지
          <input type=\"checkbox\" class=\"form-check-input auth_check my-auto\" style='zoom:1.4'>
        </div>
        <div class=\"me-2\">
          게스트
          <input type=\"checkbox\" class=\"form-check-input auth_check my-auto\" style='zoom:1.4'>
        </div>
      </div>
      <div class=\"col text-center \" style=\"flex-grow: 0.8;\">총설치</div>
      <div class=\"col text-center \" style=\"flex-grow: 0.8;\">총유지</div>
      <div class=\"col text-center \" style=\"flex-grow: 0.8;\">A/S</div>
      <button class=\"btn p-0 col text-center btn-outline-dark change_pwd_btn\">변경</button>
    </section>`

    return temp;
  }

  function branch_list_temp(branch_json) {
    var temp = `<li><button class="dropdown-item branch" value="${branch_json.id}">${branch_json.branch_name}</button></li>`;

    return temp;
  }
</script>