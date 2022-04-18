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
    $temp = "<table class=\"w-100 border-bl spec_user_form\">
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

function unspec_table_temp_set($user_name, $user_id, $user_pwd, $user_phone, $user_email)
{
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

$spec_tables = array();

for ($index_b = 0; $index_b <= 3; $index_b = $index_b + 1) {
  $spec_table_set = "<div class=\"spec_user_form\">";
  for ($index_a = 0; $index_a <= 3; $index_a = $index_a + 1) {
    $spec_table_set = $spec_table_set . spec_table_temp_set("홍길동", "wwwww" . $index_a . $index_b, "*****", "010-8888-7777", "eeeee@eewwq");
  }
  $spec_table_set = $spec_table_set . "</div>";
  $spec_tables[$index_b] = $spec_table_set;
}

$unspec_table_set = "<div id=\"unspec_user_form\">";
for ($index_a = 0; $index_a <= 3; $index_a = $index_a + 1) {
  $unspec_table_set = $unspec_table_set . unspec_table_temp_set("홍길동", "wwwww" . $index_a, "*****", "010-8888-7777", "eeeee@eewwq");
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
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-3 fs-5 h-5r">관리 현황</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-3 fs-5">권한</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-3 fs-5">설치</button>
      <button type="button" onclick="top_menu(3)" class="btn btn-outline-dark rounded-3 col-3 fs-5">유지보수</button>
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
  class table_data {
    constructor(name, id, pwd, phone, email) {
      this.name = name;
      this.id = id;
      this.pwd = pwd;
      this.phone = phone;
      this.email = email;
    }

    get name() {
      return this._name;
    }
    get id() {
      return this._id;
    }
    get pwd() {
      return this._pwd;
    }
    get phone() {
      return this._phone;
    }
    get email() {
      return this._email;
    }

    set name(value) {
      this._name = value;
    }
    set id(value) {
      this._id = value;
    }
    set pwd(value) {
      this._pwd = value;
    }
    set phone(value) {
      this._phone = value;
    }
    set email(value) {
      this._email = value;
    }
  }

  var table_data_array = []; // table_data class 배열
  var btn = [];
  var menu = [];
  var unspec_array = []; // 미지정 index 배열
  var spec_array = []; // 권한 지정된 index 배열
  var auth_val = 0; // 권한 dropdown 클릭 했던 index값 저장

  function arrow_click_event_init() {
    $('.toright_arrow').click(function() {
      table_data_insert(1);
      table_insert(1);
    });

    $('.toleft_arrow').click(function() {
      table_data_insert(0);
      table_insert(0);
    });
  }

  $('.table_click').each(function(index) {
    table_click_event_init($(this));
  });

  function table_click_event_init($table) {
    $table.click(function() {
      var $table_clicked = $table.closest('table');

      //색 변경
      if ($table_clicked.is(".manege_table_clicked")) {
        $table_clicked.removeClass('manege_table_clicked');
      } else {
        $table_clicked.addClass('manege_table_clicked');
      }

      //배열에 index 삽입
      if ($table_clicked.closest('div').is("#unspec_user_form")) {
        console.log("2-1");
        unspec_array.array_insert($(".unspec_manege_table").index($table_clicked));
      } else if ($table_clicked.closest('div').is(".spec_user_form")) {
        console.log("2-2");
        spec_array.array_insert($(".spec_manege_table").index($table_clicked));
      }
    });
  }

  document.querySelectorAll('.spec_user_form').forEach(function(table, index) {
    if (index >= 1) {
      table.style.display = "none";
    }
  });

  Array.prototype.array_insert = function(num) {
    var index = $.inArray(num, this);
    if (index != -1) {
      this.splice(index, 1);
    } else {
      this.push(num);
    }
    console.log(this);
  };

  function top_menu(index) {
    console.log("top : " + index);
    document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
    document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');
  }

  function test(index) {
    if (auth_val != index) {
      var view = document.querySelectorAll('.spec_user_form');
      view[index].style.display = '';
      view[auth_val].style.display = 'none';

      auth_val = index;
    }
  }

  function table_data_insert(jud) {
    if (jud) {
      unspec_array.sort();
      while (unspec_array.length) {
        var index = unspec_array.pop();
        var table = $(`.unspec_manege_table:eq(${index})`);

        console.log("이름 : " + table.find(`.name`).text() + "index : " + index);
        table_data_array.push(new table_data(table.find(`.name`).text(), table.find(`.id`).text(), table.find(`.pwd`).text(), table.find(`.phone`).text(), table.find(`.email`).text()));
        table.detach();
      }
    } else {
      spec_array.sort();
      while (spec_array.length) {
        var index = spec_array.pop();
        var table = $(`.spec_manege_table:eq(${index})`);

        console.log("이름 : " + table.find(`.name`).text() + "index : " + index);
        table_data_array.push(new table_data(table.find(`.name`).text(), table.find(`.id`).text(), table.find(`.pwd`).text(), table.find(`.phone`).text(), table.find(`.email`).text()));
        table.detach();
      }
    }
    console.log(table_data_array);
  }

  function table_insert(jud) {
    if (jud) {
      while (table_data_array.length) {
        var unspec_table_data = table_data_array.pop();
        $(".spec_user_form").eq(auth_val).prepend(spec_table_temp_set(unspec_table_data));
        table_click_event_init($(".spec_manege_table").eq(0));
      }
    } else {
      while (table_data_array.length) {
        var spec_table_data = table_data_array.pop();
        $("#unspec_user_form").prepend(unspec_table_temp_set(spec_table_data));
        table_click_event_init($(".unspec_manege_table").eq(0));
      }
    }
  }

  function unspec_table_temp_set(spec_table_data) {
    $temp = `<table class=\"w-100 unspec_manege_table manege_table_border mb-3\">
          <tr class=\"table_click\">
            <td id=\"name\" class=\"px-2 manege_table_border name\">${spec_table_data.name}</td>
            <td id=\"id\" class=\"px-2 manege_table_border id\">${spec_table_data.id}</td>
            <td id=\"phone\" class=\"px-2 manege_table_border pwd\">${spec_table_data.pwd}</td>
          </tr>
          <tr class=\"\">
            <td id=\"phone\" class=\"px-2 manege_table_border table_click phone\" colspan=\"2\">${spec_table_data.phone}</td>
            <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">비번<br>초기화</button>
            </td>
          </tr>
          <tr class=\"\">
            <td id=\"email\" class=\"px-2 manege_table_border table_click email\" colspan=\"2\">${spec_table_data.email}</td>
            <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">정보<br>삭제</button>
            </td>
          </tr>
        </table>`;

    return $temp;
  }

  function spec_table_temp_set(unspec_table_data) {
    $temp = `
      <table class=\"w-100 spec_manege_table manege_table_border mb-3\">
        <tr class=\"table_click\">
          <td id=\"name\" class=\"px-2 manege_table_border name\">${unspec_table_data.name}</td>
          <td id=\"id\" class=\"px-2 manege_table_border id\">${unspec_table_data.id}</td>
          <td id=\"pwd\" class=\"px-2 manege_table_border pwd\">${unspec_table_data.pwd}</td>
        </tr>
        <tr class=\"\">
          <td id=\"phone\" class=\"px-2 table_click manege_table_border phone\" colspan=\"2\">${unspec_table_data.phone}</td>
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
          <td id=\"email\" class=\"px-2 table_click manege_table_border email\" colspan=\"2\">${unspec_table_data.email}</td>
          <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
            <button class=\"btn text-primary p-0 w-100\">권한<br>초기화</button>
          </td>
        </tr>
      </table>`;

    return $temp;
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
  arrow_click_event_init();
</script>

</html>