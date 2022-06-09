<?php
include "./php/db.php";
include "./php/login-ok.php";

$user_id = $_SESSION['userid'];
$user_name = $_SESSION['name'];
$type_btn = "";

if ($_GET['id'] == 'new') {
  $user_sql = "SELECT * FROM user WHERE name = '$user_name' AND user_id = '$user_id'";
  $user_result = mysqli_query($mysqli, $user_sql);
  $user_row = mysqli_fetch_array($user_result);

  $installer_name = $user_row['name'];
  $installer_phone = $user_row['phone'];
  $installer_email = $user_row['email'];
  $install_type = $_GET['type'];
} else {
  //$install_sql = "SELECT menu.id AS m_id, install.id AS id, check_list, count, date, location, maneger_name, maneger_phone, maneger_email, network_ip, network_subnet, network_gateway, network_dns, server_ip, server_id, server_port, server_pwd, latitude, longitude, name, phone, email, type FROM install JOIN install_spot AS spot ON spot.id = install.install_spot_id JOIN menu_list AS menu ON menu.id = install.menu_list_id JOIN user AS installer ON installer.id = install.user_id JOIN WHERE install.id = $_GET[id]";
  $region_sub_sql = "(SELECT region FROM region WHERE spot.region_id = region.id) AS region";
  $install_sql = "SELECT menu.id AS m_id, install_spot_id AS ins_id, " . $region_sub_sql . ", install.id AS id, check_list, count, date, address_1, address_2, office_edu, location, maneger_name, maneger_phone, maneger_email, network_ip, network_subnet, network_gateway, network_dns, server_ip, server_id, server_port, server_pwd, latitude, longitude, name, phone, email, type FROM install JOIN install_spot AS spot ON spot.id = install.install_spot_id JOIN menu_list AS menu ON menu.id = install.menu_list_id JOIN user AS installer ON installer.id = install.user_id WHERE install.id = $_GET[id]";
  $install_result = mysqli_query($mysqli, $install_sql);
  $install_row = mysqli_fetch_array($install_result);

  $check = $install_row['check_list'];
  $date = $install_row['date'];
  $region = $install_row['region'];
  $address_1 = $install_row['address_1'];
  $address_2 = $install_row['address_2'];
  $office_edu = $install_row['office_edu'];
  $location = $install_row['location'];
  $maneger_name = $install_row['maneger_name'];
  $maneger_phone = $install_row['maneger_phone'];
  $maneger_email = $install_row['maneger_email'];
  $network_ip = $install_row['network_ip'];
  $network_subnet = $install_row['network_subnet'];
  $network_gateway = $install_row['network_gateway'];
  $network_dns = $install_row['network_dns'];
  $server_ip = $install_row['server_ip'];
  $server_port = $install_row['server_port'];
  $server_id = $install_row['server_id'];
  $server_pwd = $install_row['server_pwd'];
  $lat = $install_row['latitude'];
  $lon = $install_row['longitude'];
  $install_type = $install_row['type'];
  $installer_name = $install_row['name'];
  $installer_phone = $install_row['phone'];
  $installer_email = $install_row['email'];

  $brod_sql =
    "SELECT 
    scale1, 
    scale2, 
    distance 
  FROM brodcast 
  WHERE menu_id = $install_row[m_id]";
  $brod_result = mysqli_query($mysqli, $brod_sql);

  $brod = array();
  $brod[0] = mysqli_fetch_array($brod_result);
  $brod[1] = mysqli_fetch_array($brod_result);
  $brod[2] = mysqli_fetch_array($brod_result);
  $brod[3] = mysqli_fetch_array($brod_result);

  $image_sql =
    "SELECT 
    image_file_name, 
    num 
  FROM image_list 
  WHERE install_id = $install_row[id] AND num is not null AND delete_yn is null";
  $image_result = mysqli_query($mysqli, $image_sql);
  $image_query = mysqli_fetch_array($image_result);
  $images = array();
  $images_num = array();

  while ($image_query) {
    $images[] = $image_query['image_file_name'];
    $images_num[] = $image_query['num'];
    $image_query = mysqli_fetch_array($image_result);
  }

  $sql_sign = "SELECT count(*) AS count FROM sign_list WHERE install_id = '$_GET[id]' AND delete_yn is null";
  $result_sign = mysqli_query($mysqli, $sql_sign);
  $row_sign = mysqli_fetch_array($result_sign);

  $comment_total_sql =
    "SELECT 
    COUNT(CASE WHEN purpose='추가설치' THEN 1 END) as '설치',
    COUNT(CASE WHEN purpose='설치' THEN 1 END) as '설치2',
    COUNT(CASE WHEN purpose='연동설치' THEN 1 END) as '연동',
    COUNT(CASE WHEN purpose='제어기설치' THEN 1 END) as '제어기'
  FROM comment";
  $comment_total_result = mysqli_query($mysqli, $comment_total_sql);
  $comment_total_row = mysqli_fetch_array($comment_total_result);
  $comment_total[0] = $comment_total_row['설치'] + $comment_total_row['설치2'];
  $comment_total[1] = $comment_total_row['연동'];
  $comment_total[2] = $comment_total_row['제어기'];

  if ($row_sign['count'] == 0) {
    $sign_color_tag = "text-danger";
    $sign_text = "미서명";
  } else {
    $sign_color_tag = "text-success";
    $sign_text = "서명완료";
  }
}

switch ($install_type) {
  case 0:
    $type_btn = "설치";
    break;
  case 1:
    $type_btn = "연동";
    break;
  case 2:
    $type_btn = "제어기";
    break;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.49">
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
  <?php include "./header.php" ?>
  <div class=" container container-mobile-1 pb-3">
    <div class="row mb-3">
      <button type="button" onclick="top_menu(0)" class="btn btn-dark rounded-3 col-20 fs-5">설치 장소</button>
      <button type="button" onclick="top_menu(1)" class="btn btn-outline-dark rounded-3 col-20 fs-5">메뉴 설정</button>
      <button type="button" onclick="top_menu(2)" class="btn btn-outline-dark rounded-3 col-20 fs-5">체크<br>리스트</button>
      <button type="button" onclick="top_menu(3)" class="btn btn-outline-dark rounded-3 col-20 fs-5">사진첨부</button>
      <button type="button" onclick="top_menu(4)" class="btn btn-outline-dark rounded-3 col-20 fs-5 confirm">설치완료</button>
    </div>

    <?php include "./install-form/form_1.php"; ?>
    <?php include "./install-form/form_2.php"; ?>
    <?php include "./install-form/form_3.php"; ?>
    <?php include "./install-form/form_4.php"; ?>
    <?php include "./install-form/form_4_sub.php"; ?>
    <?php include "./install-form/form_5.php"; ?>


  </div>

</body>

<script type="text/javascript">
  var menu_val = 0;
  var sub_form_val = 0;
  var comment_product_val = 1;

  window.onload = function() {
    $(window).on('beforeunload', function() {
      return "값이 저장되지 않았습니다. 나가시겠습니까?";
    });

    confirm_menu_click();
    setThumbnail();
    dropdown_init();
    calendar_init();
    comment_purpose_dropdown_change_click();
    search_purpose_item_click();
    call_comment_list("전체");

    if (searchParam('id') != 'new') {
      image_set();
    }

    if (<?php echo isset($check) ? 1 : 0; ?>) {
      check_list_init("<?php echo $check; ?>");
    }
  }

  /*
  ################
  범용 함수
  ################
  */

  function searchParam(key) { // get 파라미터
    return new URLSearchParams(location.search).get(key);
  };

  function clicked_index(target, parent) {
    console.log("ㅇㅇ");
    return $(parent).index(target.closest($(parent)));
  }
    //text로 시작하는 html을 가진 Element 찾기
  $.fn.findByStartText = function(text) {
    return this.filter(function() {
      return this.innerHTML.indexOf(text) == 0;
    });
  };

  /*
  ################
  설치일자 설정
  ################
  */
  function calendar_init() {
    document.getElementById('calendar_text').addEventListener('blur', function() {
      document.getElementById("calendar_text").readOnly = true;
    });

    if (document.getElementById('calendar_text_comment')) {
      document.getElementById('calendar_text_comment').addEventListener('blur', function() {
        document.getElementById("calendar_text_comment").readOnly = true;
      });

      $(function() {
        $('#datetimepicker_comment').datetimepicker({
          locale: moment.locale('ko'),
          format: 'YYYY.MM.DD'
        });
      });
    }

    $(function() {
      $('#datetimepicker').datetimepicker({
        locale: moment.locale('ko'),
        format: 'YYYY.MM.DD HH:mm:ss'
      });
    });
  }

  function calendar_btn(index) {
    switch (index) {
      case 0: {
        document.getElementById("calendar_text").readOnly = false;
        break;
      }
      case 1: {
        document.getElementById("calendar_text_comment").readOnly = false;
        break;
      }
    }
  }

  /*
  ################
  기초 설정
  ################
  */
  function dropdown_init() { // dropdown item 클릭 시 해당 text 값으로 변경
    $(document).on('click', '.dropdown-item', function() {
      var parent = $(this).parents(".dropdown-menu").siblings(".dropdownMenu");
      parent.text($(this).text());
      parent.attr("value", $(this).attr("value"));
    });
  }

  function check_list_init(data) { // 클릭한 check의 index + "a" 로 배열을 만들어 저장 시 DB에 저장
    var check_array = data.split('a');
    var check_list_input = document.querySelectorAll('.check_list');

    check_array.forEach(element => {
      check_list_input[element].click();
    });
  }

  function top_menu(index) { // 상위 메뉴
    if (menu_val != index) {
      document.querySelector('.btn-dark').classList.replace('btn-dark', 'btn-outline-dark');
      document.querySelectorAll('.btn-outline-dark')[index].classList.replace('btn-outline-dark', 'btn-dark');

      var view = document.querySelectorAll('.install');

      if (sub_form_val == 1) {
        sub_form(0);
      }

      view[index].style.display = '';
      view[menu_val].style.display = 'none';

      menu_val = index;
    }
  }

    //상단 메뉴 중 설치완료 클릭 시
  function confirm_menu_click() {
    $(".confirm").on("click", function() {
      $("#confirm_region").val($("#region").val());
      $("#confirm_spot").val($("#spot_address").val());
      $("#confirm_address").val($("#detail_address").val());
      var date = $("#calendar_text").val().split(" ")[0].split(".");
      $(".confirm_data:eq(0)").text(date[0]);
      $(".confirm_data:eq(1)").text(date[1]);
      $(".confirm_data:eq(2)").text(date[2]);
    });
  }

  function sub_form(index) { // 보조 나중에 지울거
    console.log("form : " + index + "/" + menu_val + "/" + sub_form_val);
    if (sub_form_val != index) {
      var view = document.querySelectorAll('.image_form');

      view[index].style.display = '';
      view[sub_form_val].style.display = 'none';

      sub_form_val = index;
    }
  }

  /*
  ################
  이미지 함수
  ################
  */

  function image_set() { // DB로부터 받아온 이미지 설정
    var images = <?php echo json_encode($images); ?>;
    var images_num = <?php echo json_encode($images_num); ?>;

    images.forEach((image_file, index) => {
      var img = document.querySelectorAll(".image_container")[images_num[index] - 1];
      var image_src = "./php/imagecall.php?file=" + image_file;
      img.style.display = '';
      img.src = image_src;
    });
  }

  function setThumbnail() { // 업로드 한 이미지를 label에 띄움
    $(".image_input").change(function() {
      var index = clicked_index($(this), ".image_block");
      var view = document.querySelectorAll(".image_container")[index];
      var reader = new FileReader();

      reader.onload = function(event) {
        view.style.display = '';
        view.src = event.target.result;
      }
      if (!(event.target.files[0] == null))
        reader.readAsDataURL(event.target.files[0]);
    });
  }

  function image_delete() {
    var fd = new FormData();
    var image_delete_btn = $('.image_delete').filter(':checked');
    var image_input = document.querySelectorAll(".image_container");

    $.each(image_delete_btn, function(key, input) {
      var delete_index = clicked_index($(this), ".image_block");

      console.log(window.location.href);
      if (window.location.href != image_input[delete_index].src) {
        image_input[delete_index].style.display = 'none';
        fd.append("image_delete_check[]", delete_index + 1);
        fd.append('install_id', searchParam('id'));
      }
    });

    $.ajax({
      url: './php/image_delete.php',
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
  저장 함수
  ################
  */

  function form_submit(complete) { // 저장함수 (complete = 1 저장 / 0 임시저장)
    var fd = new FormData();
    var img_count = 0;
    var total_count = 0;
    var install_type = <?php echo $install_type; ?>;
    //console.log(install_type);
    fd.append('user_id', '<?php echo $_SESSION['userid'] ?>');
    fd.append('user_name', '<?php echo $_SESSION['name'] ?>');
    fd.append('type', '<?php echo $install_type ?>');
    fd.append('query', searchParam('id'));

    //사용자가 입력한 데이터들을 formdata에 넣음
    var install_data = $('.install_form').serializeArray();
    $.each(install_data, function(key, input) {
      if (input.value) {
        total_count++;
      }
      fd.append(input.name, input.value);
    });

    //사용자가 추가한 이미지들을 formdata에 넣음
    $.each($('.image_input'), function(index, file_data) {
      var img = document.querySelectorAll(".image_container")[index];
      var files = file_data.files[0];

      if (!(files == null)) {
        fd.append("img[]", files);
        fd.append("file_id[]", index + 1);
      }
      if (img.style.display == '')
        img_count++;
    });

    fd.append("img_count", img_count);
    total_count = total_count + img_count;
    fd.append("total_count", total_count);
    console.log("count : " + total_count);

    if (complete) { // 설치,연동,제어기 완료 버튼 클릭 시
      if (!(install_type) && (total_count != 78)) { // 설치의 경우 비어있는 항목 없이 모든 항목을 채워야함
        alert("입력이 덜 된 부분이 있습니다.");
        return;
      }
      fd.append("complete", complete);
      console.log("eeee");
    }

    $.ajax({
      url: './php/install-new.php',
      data: fd,
      contentType: false,
      processData: false,
      async: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
        /*
        $(window).off('beforeunload');
        alert('message');
        window.location = '/install.php';*/
      }
    });
  }

  /*
  ################
  댓글 함수
  ################
  */

  function comment_purpose_dropdown_change_click() { // 댓글 작성 시 "교체" 항목 일 경우 제품번호 입력 div 변경
    $('.purpose_item').on("click", function() {
      if ($(this).text() == "교체") {
        comment_product_div_control(0);
        return;
      }
      comment_product_div_control(1);
    });
  }

  function comment_product_div_control(jud) {
    console.log(`comment_product_val = ${comment_product_val} / jud = ${jud}`);
    if (comment_product_val == jud)
      return;

    comment_product_val = jud;
    var target = $("#product_div");
    target.empty();

    if (jud) { // 제품번호 입력
      console.log("1번");
      target.append(comment_product_number_temp());
    } else { // 제품번호 교체
      console.log("2번");
      target.append(comment_product_change_temp());
    }
  }

  function comment_submit() {
    if (searchParam('id') == 'new') {
      alert("새 글쓰기 중에는 댓글을 작성할 수 없습니다.");
      return;
    }

    var fd = new FormData();
    var comment_file = document.querySelector('#comment_file_input').files[0];
    var query = searchParam('id');

    fd.append('install_id', query);
    fd.append('comment_type', "upload");
    fd.append('comment_file', comment_file);
    fd.append('comment_text', document.querySelector('#comment_text').value);
    fd.append('comment_purpose', document.querySelector('#comment_purpose').innerText.trim());
    fd.append('comment_product_val', comment_product_val); // 교체일 경우 두 개를, 아닐경우 한 개만

    if (comment_product_val) {
      fd.append('product[]', document.querySelectorAll('.product')[0].value);
    } else {
      fd.append('product[]', document.querySelectorAll('.product')[0].innerText);
      fd.append('product[]', document.querySelectorAll('.product')[1].value);
    }

    fd.append('commenter_id', '<?php echo $user_id; ?>');
    fd.append('commenter_name', '<?php echo $user_name; ?>');

    $.ajax({
      url: './php/comment-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  function comment_file(index) { // 댓글 파일 나중에 고쳐야함
    var image_file_name = <?php echo json_encode($image_download_link); ?>;
    if (image_file_name[index]) {
      console.log(image_file_name[index] + "/" + index);
    } else {
      console.log("비었음");
    }
  }

  function commments_delete(index) { // 안쓴다던데 고쳐야하나
    var fd = new FormData();

    fd.append('comment_id', index);
    fd.append('comment_type', "delete");
    $.ajax({
      url: './php/comment-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  function call_comment_list(search_purpose) { // 댓글 리스트 요청
    var fd = new FormData();

    fd.append('search_purpose', search_purpose);
    fd.append('install_id', searchParam('id'));
    fd.append('comment_type', "call");

    $.ajax({
      url: './php/comment-server.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      async: true,
      success: function(data) {
        //console.log(data);
        var comment_list_data = JSON.parse(data);   
        var target = $("#comment_list");
        target.empty();
        comment_list_data.forEach(function (value, index) {
          console.log(value);
          target.append(comment_list_temp(index+1, value));
        });
      }
    });
  }

  function search_purpose_item_click() {
    document.querySelectorAll(".search_purpose_item").forEach(function (value, index) {
      value.addEventListener('click', function() {
        console.log("테스트 : " + index );
        var search_purpose = value.innerText.trim();
        console.log(search_purpose);
        call_comment_list(search_purpose);
      });
    })
  }
  
  /*
  ################
  싸인 함수
  ################
  */

  async function sign_ok() {
    await form_submit(0);
    location.href = `/install-sign.php?install_id=${searchParam('id')}`;
  }

  function comment_product_change_temp() {
    var temp = `
      <div class="me-2 p-1">교체</div>
      <div class="dropdown">
        <div class="dropdown-toggle dropdownMenu border-bl-90 p-1 text-center product" style="width: 120px;" data-bs-toggle="dropdown" aria-expanded="false">
          제품번호
        </div>
          <ul class="dropdown-menu dropdown-scroll">
            <li><button class="dropdown-item">00700</button></li>
            <li><button class="dropdown-item">00701</button></li>
            <li><button class="dropdown-item">10700</button></li>
          </ul>
      </div>
      <div class="ms-2 p-1">></div>
      <input type="text" class="col border-bl-90 p-1 product" style="width: 100px;">`

    return temp;
  }

  function comment_product_number_temp() {
    var temp = `
    <div class="p-1">제품번호</div>
    <input type="text" class="col border-bl-90 ms-2 me-4 p-1 product" style="width: 100px;">`;

    return temp;
  }
  
  function comment_list_temp(index, comment_list_data) {
    var temp = `
    <section class=\"d-flex justify-content-center border-bottom-gr w-100 fs-5\">
      <div class=\"col text-center\">${index}</div>
      <div class=\"col text-center\">${comment_list_data.purpose}</div>
      <div class=\"col text-center\"></div>
      <div class=\"col text-center\">${comment_list_data.date}</div>
      <div class=\"col text-center\">${comment_list_data.time}</div>
      <div class=\"col text-center\">${comment_list_data.name}</div>
      <div class=\"col text-center\">사진</div>
    </section>`;
    
    if (comment_list_data.contents) {
      var sub = `<div class="mx-auto border-bl-90" style="width: 580px;">${comment_list_data.contents}</div>`;
      temp = temp+sub;
    }

    return temp;
  }
</script>
<script type="text/javascript" src="script/info-edit.js?<?php echo time(); ?>"></script>

</html>