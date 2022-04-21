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

  var btn = [];
  var menu = [];
  var auth_val = 0; // 권한 dropdown 클릭 했던 index값 저장

  // 중간 좌우 화살표 클릭 시 실행 이벤트
  function arrow_click_event_init() {
    var table_data_array = [];
    $('.toright_arrow').click(function() {
      table_insert(1, table_data_insert(1, table_data_array));
    });

    $('.toleft_arrow').click(function() {
      table_insert(0, table_data_insert(0, table_data_array));
    });
  }

  $('.table_click').each(function(index) {
    table_click_event_init($(this));
  });

  // 테이블 항목 클릭 시 실행될 이벤트
  function table_click_event_init($table) {
    $table.click(function() {
      var $table_clicked = $table.closest('table');

      //색 변경
      if ($table_clicked.is(".manege_table_clicked")) {
        $table_clicked.removeClass('manege_table_clicked');
      } else {
        $table_clicked.addClass('manege_table_clicked');
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

  function auth_dropdown(index) {
    if (auth_val != index) {
      var view = document.querySelectorAll('.spec_user_form');
      view[index].style.display = '';
      view[auth_val].style.display = 'none';

      auth_val = index;
    }
  }

  function table_data_insert(jud, table_data_array) {
    var index_array = [];
    if (jud) {
      $(`.unspec_manege_table`).each(function(index, value) {
        if(value.classList.contains("manege_table_clicked")) {
          index_array.push(index);
          var table = $(`.unspec_manege_table:eq(${index})`);

          //console.log("이름 : " + table.find(`.name`).text() + " / index : " + index);
          table_data_array.push(new table_data(table.find(`.name`).text(), table.find(`.id`).text(), table.find(`.pwd`).text(), table.find(`.phone`).text(), table.find(`.email`).text()));
        }
      });
      $(`.unspec_manege_table.manege_table_clicked`).each(function(index, value) {
        value.remove();
      });
    } else {
      $(`.spec_manege_table`).each(function(index, value) {
        if(value.classList.contains("manege_table_clicked")) {
          index_array.push(index);
          var table = $(`.spec_manege_table:eq(${index})`);

          //console.log("이름 : " + table.find(`.name`).text() + " / index : " + index);
          table_data_array.push(new table_data(table.find(`.name`).text(), table.find(`.id`).text(), table.find(`.pwd`).text(), table.find(`.phone`).text(), table.find(`.email`).text()));
        }
      });
      $(`.spec_manege_table.manege_table_clicked`).each(function(index, value) {
        value.remove();
      });
    }
    return table_data_array;
  }

  function table_insert(jud, table_data_array) {
    auth_ajax_send(jud, table_data_array);
    if (jud) {
      while (table_data_array.length) {
        $(".spec_user_form").eq(auth_val).prepend(spec_table_temp_set(table_data_array.pop()));
        table_click_event_init($(`.spec_user_form:eq(${auth_val})`).find(`.spec_manege_table`).eq(0));
      }
    } else {
      while (table_data_array.length) {
        $("#unspec_user_form").prepend(unspec_table_temp_set(table_data_array.pop()));
        table_click_event_init($(".unspec_manege_table").eq(0));
      }
    }
  }

  function auth_ajax_send(jud, table_data_array) {
    
    var fd = new FormData();
    fd.append('table_data_array', JSON.stringify(table_data_array));
    fd.append('jud', jud);
    fd.append('auth', auth_val);

    $.ajax({
      url: './php/user-auth.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
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
  
  arrow_click_event_init();