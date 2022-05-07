class user_table_data {
  constructor(index, name, id, pwd, phone, email) {
    this.index = index;
    this.name = name;
    this.id = id;
    this.pwd = pwd;
    this.phone = phone;
    this.email = email;
  }

  get index() {
    return this._index;
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

  set index(value) {
    this._index = value;
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

class install_table_data {
  constructor(region, address, user_id) {
    this.region = region;
    this.address = address;
    this.user_id = user_id;
  }

  get address() {
    return this._address;
  }
  get region() {
    return this._region;
  }
  get user_id() {
    return this._user_id;
  }

  set address(value) {
    this._address = value;
  }
  set region(value) {
    this._region = value;
  }
  set user_id(value) {
    this._user_id = value;
  }
}

var top_menu_val = 0;
var branch_list;
var auth_menu_val = 0;
var install_menu_val = 0;

var change_auth_user_array = [];

function arrow_click_event(jud) {
  switch (top_menu_val) {
    case 0:
      user_auth_table_insert(jud, user_auth_table_data_insert(jud));
      break;
    case 1:
      install_table_insert(jud, install_table_data_insert(jud));
      break;
  }
}
// 중간 좌우 화살표 클릭 시 실행 이벤트
function arrow_click_event_init() {
  $('.toright_arrow').click(function () {
    arrow_click_event(1);
  });

  $('.toleft_arrow').click(function () {
    arrow_click_event(0);
  });
}

function dropdown_init() {
  $('.dropdown').on('click', '.dropdown-item', function () {
    var parent = $(this).parents(".dropdown-menu").siblings(".dropdownMenu");
    parent.text($(this).text());
    parent.attr("value", $(this).attr("value"));
  });
}

function table_click_event_init() {
  $('.auth').on('click', '.table_click', function () {
    var table_clicked = $(this).closest('table');

    //색 변경
    if (table_clicked.is(".manege_table_clicked")) {
      table_clicked.removeClass('manege_table_clicked');
    } else {
      table_clicked.addClass('manege_table_clicked');
    }
  });
}

function auth_dropdown() {
  $(".dropdown-menu").on('click', '.auth_dropdown', function () {
    var focus = $(this).parent();
    var pre_focus = focus.parent().children();
    var index = pre_focus.index(focus);

    var view = $(".spec_user_form");
    view.eq(index).css("display", '');
    view.eq(auth_menu_val).css("display", 'none');

    console.log(auth_menu_val + " / " + index);
    auth_menu_val = index;
  });
}

function install_dropdown_init() {
  $(".dropdown-menu").on('click', '.installer_dropdown', function () {
    var focus = $(this).parent();
    var pre_focus = focus.parent().children();
    var index = pre_focus.index(focus);

    var view = $(".spec_install_form");
    view.eq(index).css("display", '');
    view.eq(install_menu_val).css("display", 'none');

    console.log(install_menu_val + " / " + index);
    install_menu_val = index;
  });
}

function install_table_data_insert(jud) {
  var table_data_array = [];
  if (jud) {
    $(`.unspec_install_table`).each(function (index, value) {
      if (value.classList.contains("manege_table_clicked")) {
        var table = $(`.unspec_install_table:eq(${index})`);

        //console.log("이름 : " + table.find(`.name`).text() + " / index : " + index);
        table_data_array.push(new install_table_data(table.find(`.region`).text(), table.find(`.address`).text(), table.attr(`value`)));
        console.log(table_data_array);
      }
    });
    $(`.unspec_install_table.manege_table_clicked`).each(function (index, value) {
      value.remove();
    });
  } else {
    $(`.spec_install_table`).each(function (index, value) {
      if (value.classList.contains("manege_table_clicked")) {
        var table = $(`.spec_install_table:eq(${index})`);

        //console.log("이름 : " + table.find(`.name`).text() + " / index : " + index);
        table_data_array.push(new install_table_data(table.find(`.region`).text(), table.find(`.address`).text(), table.attr(`value`)));
        console.log(table_data_array);
      }
    });
    $(`.spec_install_table.manege_table_clicked`).each(function (index, value) {
      value.remove();
    });
  }

  return table_data_array;
}

function install_table_insert(jud, table_data_array) {
  if (jud) {
    while (table_data_array.length) {
      $(".spec_install_form").eq(auth_menu_val).prepend(spec_install_table_temp(table_data_array.pop()));
      var table = $(".spec_install_table").eq(0);

      //sortable_add(table);
    }
  } else {
    while (table_data_array.length) {
      $("#unspec_install_form").prepend(unspec_install_table_temp(table_data_array.pop()));
    }
  }
}

function user_auth_table_data_insert(jud) {
  var table_data_array = [];
  if (jud) {
    $(`.unspec_auth_table`).each(function (index, value) {
      if (value.classList.contains("manege_table_clicked")) {
        var table = $(`.unspec_auth_table:eq(${index})`);

        console.log("index : " + table.attr("value"));
        table_data_array.push(new user_table_data(table.attr("value"), table.find(`.name`).text(), table.find(`.id`).text(), table.find(`.pwd`).text(), table.find(`.phone`).text(), table.find(`.email`).text()));
      }
    });
    $(`.unspec_auth_table.manege_table_clicked`).each(function (index, value) {
      value.remove();
    });
  } else {
    $(`.spec_auth_table`).each(function (index, value) {
      if (value.classList.contains("manege_table_clicked")) {
        var table = $(`.spec_auth_table:eq(${index})`);

        console.log("index : " + table.attr("value"));
        table_data_array.push(new user_table_data(table.attr("value"), table.find(`.name`).text(), table.find(`.id`).text(), table.find(`.pwd`).text(), table.find(`.phone`).text(), table.find(`.email`).text()));
      }
    });
    $(`.spec_auth_table.manege_table_clicked`).each(function (index, value) {
      value.remove();
    });
  }

  return table_data_array;
}

function user_auth_table_insert(jud, table_data_array) {
  send_user_auth_data(jud, table_data_array);

  if (jud) {
    table_data_array.forEach(function (table_data) {
      $(".spec_user_form").eq(auth_menu_val).prepend(spec_auth_table_temp(table_data));
      var table = $(".spec_auth_table").eq(0);

      list_prepend(table.find(".branch_list"), branch_list);
      sortable_add(table);
    }); 
  } else {
    table_data_array.forEach(function (table_data) {
      $("#unspec_user_form").prepend(unspec_auth_table_temp(table_data));
    });
  }
}

function send_user_auth_data(jud, table_data_array) {
  var fd = new FormData();
  var auth = auth_menu_val + 1;
  fd.append('table_data_array', JSON.stringify(table_data_array));
  fd.append('jud', jud);
  fd.append('key', 0);
  fd.append('auth', auth);

  console.log ("auth : " + auth + " / jud : " + jud);
  $.ajax({
    url: './php/user-auth.php',
    data: fd,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function (data) {
      switch (auth) {
        case 1 : //관리자

          break;
        case 2 : //설치자
          table_data_array.forEach(function (value) {
            console.log(value.index + " / " + value.name);
            call_installer_list(value.index, jud);
          });
          break;
      }
    }
  });
}

function list_prepend(ul_tag, data) {
  ul_tag.prepend(data);
}

function list_append(ul_tag, data) {
  ul_tag.append(data);
}

function list_clean(ul_tag, id) {
  console.log("삭제할거");
  ul_tag.find(`button[value='${id}']`).remove();
}

function branch_insert(jud) {
  var fd = new FormData();

  if (jud) {
    fd.append('branch_name', $('#branch_input').val());
  } else {
    fd.append('branch_name', $('#branch_dropdown').text());
  }

  fd.append('jud', jud);
  fd.append('key', 1);

  $.ajax({
    url: './php/user-auth.php',
    data: fd,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function (data) {
      call_branch_list();
    }
  });
}

function call_branch_list() {
  /*
      $(`.branch_list`).each(function (index, value) {
        branch_list = data;
        list_prepend($(this), data);
      });*/

  var fd = new FormData();
  fd.append('key', 3);

  $.ajax({
    url: './php/user-auth.php',
    data: fd,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function (data) {
      console.log(data);
    }
  });
}

function call_installer_list(id, jud) {
  if (!(jud)) {
    var target = $(".installer");
    list_clean(target, id);

    return 0;
  }
  var fd = new FormData();

  fd.append('key', 3);
  fd.append('id', id);

  $.ajax({
    url: './php/user-auth.php',
    data: fd,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function (data) {
      var target = $(".installer");
      var installer_data = JSON.parse(data);

      if (id) { // 한번에 한개씩
        console.log(installer_data);
        list_prepend(target, installer_li_temp(installer_data[0]));
        call_install_data(installer_data[0]['id']);
      } else { // 한번에 싹다
        installer_data = installer_data.reverse();
        for (key in installer_data) {
          list_prepend(target, installer_li_temp(installer_data[key]));
          call_install_data(installer_data[key]['id']);
        }
        call_install_data("NULL"); // NULL install 조회
      }
    }
  });
}


//여기 고치시오
function install_table_init(install_data_class_array) {

  if (install_data_class_array == 0) {
    return 0;
  }

  for (key in install_data_class_array) {
    var install_data_class = install_data_class_array[key];

    if (!(install_data_class.user_id)) {
      break;
    }

    var $install_data = $(`.installer_dropdown[value="${install_data_class.user_id}"]`).parent();
    var $installer_table = $install_data.closest(".installer").children();
    var installer_index = $installer_table.index($install_data);

    console.log($install_data);
    console.log($installer_table);
    console.log(installer_index);
    
  }/*
  $(".installer").find(".installer_dropdown").each(function (index, value) {
    var user_id = install_data_class.user_id;
    console.log(`${$(this).attr("value")} / ${user_id}`);

    
    if ($(this).attr("value") == user_id) {
      console.log("ㅇㅇㅇㅇㅇㅇ1");
      console.log(install_data_class);

      var installer_table = $(".spec_install_table");
      var installer_index = installer_table.index($(this));

      installer_table.eq(installer_index).prepend(spec_install_table_temp(install_data_class))
    } else if (user_id == null) {
      console.log("ㅇㅇㅇㅇㅇㅇ2");
      console.log(install_data_class);

      return 0;
    }
  });*/
}

function install_data_list_init(install_data) {
  var install_data_class = [];
  var install_data_key = Object.keys(install_data)[0];
  install_data = install_data[install_data_key];

  for (key in install_data) {
    if (install_data[key].length == 0) {
      return 0;
    }
    
    install_data_class.push(new install_table_data(install_data[key]['region'], install_data[key]['address'], install_data[key]['user_id']));
  }
  
  return install_data_class;
}

function call_install_data(id) {
  if (id == "NULL") {
    var target = $(`#unspec_install`);
    var install_form = `<div id="unspec_install_form">${id}</div>`;
  } else {
    var target = $(`#spec_install`);
    var install_form = `<div class="spec_install_form" style="display: none">${id}</div>`;
  }
  list_append(target, install_form);

  var fd = new FormData();

  fd.append('key', 4);
  fd.append('id', id);

  $.ajax({
    url: './php/user-auth.php',
    data: fd,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function (data) {
      //console.log(data);
      var install_data = JSON.parse(data);
      install_table_init(install_data_list_init(install_data));
    }
  });
}

function unspec_auth_table_temp(spec_auth_table_data) {
  $temp = `<table class=\"mw-360 unspec_auth_table manege_table_border mb-3\" value=\"${spec_auth_table_data.index}\">
          <tr class=\"table_click\">
            <td id=\"name\" class=\"px-2 manege_table_border name\">${spec_auth_table_data.name}</td>
            <td id=\"id\" class=\"px-2 manege_table_border id\">${spec_auth_table_data.id}</td>
            <td id=\"phone\" class=\"px-2 manege_table_border pwd\">${spec_auth_table_data.pwd}</td>
          </tr>
          <tr class=\"\">
            <td id=\"phone\" class=\"px-2 manege_table_border table_click phone\" colspan=\"2\">${spec_auth_table_data.phone}</td>
            <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">비번<br>초기화</button>
            </td>
          </tr>
          <tr class=\"\">
            <td id=\"email\" class=\"px-2 manege_table_border table_click email\" colspan=\"2\">${spec_auth_table_data.email}</td>
            <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
              <button class=\"btn text-primary p-0 w-100\">정보<br>삭제</button>
            </td>
          </tr>
        </table>`;

  return $temp;
}

function spec_auth_table_temp(unspec_auth_table_data) {
  $temp = `
      <table class=\"mw-360 spec_auth_table manege_table_border mb-3\" value=\"${unspec_auth_table_data.index}\">
        <tr class=\"table_click\">
          <td id=\"name\" class=\"px-2 manege_table_border name\">${unspec_auth_table_data.name}</td>
          <td id=\"id\" class=\"px-2 manege_table_border id\">${unspec_auth_table_data.id}</td>
          <td id=\"pwd\" class=\"px-2 manege_table_border pwd\">${unspec_auth_table_data.pwd}</td>
        </tr>
        <tr class=\"\">
          <td id=\"phone\" class=\"px-2 table_click manege_table_border phone\" colspan=\"2\">${unspec_auth_table_data.phone}</td>
          <td class=\"px-2 text-center manege_table_border h-3r w-13 dropdown\" colspan=\"3\">
            <div class=\"btn text-info dropdownMenu dropdown-toggle p-0 w-100\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
              소속
            </div>
            <ul class=\"dropdown-menu dropdown-scroll branch_list\">
              
            </ul>
          </td>
        </tr>
        <tr class=\"\">
          <td id=\"email\" class=\"px-2 table_click manege_table_border email\" colspan=\"2\">${unspec_auth_table_data.email}</td>
          <td class=\"p-0 text-center manege_table_border w-13\" colspan=\"3\">
            <button class=\"btn text-primary p-0 w-100\">권한<br>초기화</button>
          </td>
        </tr>
      </table>`;

  return $temp;
}

function unspec_install_table_temp(spec_install_table_data) {
  $temp = `<table class=\"mw-360 unspec_install_table manege_table_border mb-3\" value=\"${spec_install_table_data.user_id}\">
            <tr class=\"table_click\">
              <td class=\"px-2 manege_table_border region\">${spec_install_table_data.region}</td>
              <td class=\"px-2 manege_table_border id\">버튼1</td>
            </tr>
            <tr class=\"table_click\">
              <td class=\"px-2 manege_table_border address\">${spec_install_table_data.address}</td>
              <td class=\"px-2 manege_table_border id\">버튼2</td>
            </tr>
          </table>`;

  return $temp;
}

function spec_install_table_temp(unspec_install_table_data) {
  $temp = `<table class=\"mw-360 spec_install_table manege_table_border mb-3\" value=\"${unspec_install_table_data.user_id}\">
            <tr class=\"table_click\">
              <td class=\"px-2 manege_table_border region\">${unspec_install_table_data.region}</td>
              <td class=\"px-2 manege_table_border id\">버튼1</td>
            </tr>
            <tr class=\"table_click\">
              <td class=\"px-2 manege_table_border address\">${unspec_install_table_data.address}</td>
              <td class=\"px-2 manege_table_border id\">버튼2</td>
            </tr>
          </table>`;

  return $temp;
}

function installer_li_temp(installer_data) {
  $temp = `<li><button class=\"dropdown-item installer_dropdown\" value=${installer_data['id']}>${installer_data['name']}</button></li>`;

  return $temp;
}