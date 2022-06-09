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

  $brod_sql = "SELECT scale1, scale2, distance FROM brodcast WHERE menu_id = $install_row[m_id]";
  $brod_result = mysqli_query($mysqli, $brod_sql);

  $brod = array();
  $brod[0] = mysqli_fetch_array($brod_result);
  $brod[1] = mysqli_fetch_array($brod_result);
  $brod[2] = mysqli_fetch_array($brod_result);
  $brod[3] = mysqli_fetch_array($brod_result);

  $image_sql = "SELECT image_file_name, num FROM image_list WHERE install_id = $install_row[id] AND num is not null AND delete_yn is null";
  $image_result = mysqli_query($mysqli, $image_sql);
  $image_query = mysqli_fetch_array($image_result);
  $images = array();
  $images_num = array();

  while ($image_query) {
    $images[] = $image_query['image_file_name'];
    $images_num[] = $image_query['num'];
    $image_query = mysqli_fetch_array($image_result);
  }

  $comment_sql = "SELECT * FROM comment WHERE install_id = $install_row[id] AND delete_yn is NULL";
  $comment_result = mysqli_query($mysqli, $comment_sql);
  $comment_query = mysqli_fetch_array($comment_result);
  $comments_date = array();
  $comments_purpose = array();
  $comments_contents = array();
  $comments_image = array();
  $comments_index = array();
  $image_download_link = array();
  $comments_count = 0;

  while ($comment_query) {
    $comments_index[] = $comment_query['id'];
    $comments_date[] = date("Y-m-d", strtotime($comment_query['date']));
    $comments_purpose[] = $comment_query['purpose'];
    $comments_contents[] = $comment_query['contents'];
    $comments_image[] = $comment_query['image_file_name'];

    $image_sql = "SELECT image_file_name FROM image_list WHERE comment_id = '$comment_query[id]'";
    $image_result = mysqli_query($mysqli, $image_sql);
    $image_row = mysqli_fetch_array($image_result);
    $image_download_link[] = "./image/" . $image_row['image_file_name'];

    $user_sql = "SELECT * FROM user WHERE name = '$user_name' AND user_id = '$user_id'";
    $user_result = mysqli_query($mysqli, $user_sql);
    $user_row = mysqli_fetch_array($user_result);

    $installer_name = $user_row['name'];
    $comment_query = mysqli_fetch_array($comment_result);
    $comment_count = $comment_count + 1;
  }

  $sql_sign = "SELECT count(*) AS count FROM sign_list WHERE install_id = '$_GET[id]' AND delete_yn is null";
  $result_sign = mysqli_query($mysqli, $sql_sign);
  $row_sign = mysqli_fetch_array($result_sign);

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

  function dropdown_init(classname, data) {
    var dropdown_item = document.querySelectorAll('.' + classname);

    dropdown_item.forEach((element) => {
      if (element.value == data) {
        console.log(element);
        element.click();
        return;
      }
    })
  }

  function check_list_init(data) {
    var check_array = data.split('a');
    var check_list_input = document.querySelectorAll('.check_list');

    check_array.forEach(element => {
      check_list_input[element].click();
    });
  }

  window.onload = function() {
    $(window).on('beforeunload', function() {
      return "값이 저장되지 않았습니다. 나가시겠습니까?";
    });

    confirm_menu_click();
    setThumbnail();
    if (searchParam('id') != 'new') {
      image_set();
    }

    if (<?php echo isset($region) ? 1 : 0; ?>) {
      dropdown_init('item_1', "<?php echo $region; ?>");
    }
    if (<?php echo isset($office_edu) ? 1 : 0; ?>) {
      dropdown_init('item_2', "<?php echo $office_edu; ?>");
    }
    if (<?php echo isset($check) ? 1 : 0; ?>) {
      check_list_init("<?php echo $check; ?>");
    }
  }

  function searchParam(key) {
    return new URLSearchParams(location.search).get(key);
  };

  var menu_val = 0;
  var sub_form_val = 0;

  function top_menu(index) {
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

  function sub_form(index) {
    console.log("form : " + index + "/" + menu_val + "/" + sub_form_val);
    if (sub_form_val != index) {
      var view = document.querySelectorAll('.image_form');

      view[index].style.display = '';
      view[sub_form_val].style.display = 'none';

      sub_form_val = index;
    }
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

  function image_set() {
    var images = <?php echo json_encode($images); ?>;
    var images_num = <?php echo json_encode($images_num); ?>;

    images.forEach((image_file, index) => {
      var img = document.querySelectorAll(".image_container")[images_num[index] - 1];
      var image_src = "./php/imagecall.php?file=" + image_file;
      img.style.display = '';
      img.src = image_src;
    });
  }

  function clicked_index(target, parent) {
    console.log("ㅇㅇ");
    return $(parent).index(target.closest($(parent)));
  }

  function setThumbnail() {
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

  function form_submit(complete) {
    var fd = new FormData();
    var img_count = 0;
    var total_count = 0;
    var install_type = <?php echo $install_type; ?>;
    console.log(install_type);
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
      if (!(install_type) && (total_count != 78)) {
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

  function comment_submit() {
    if (searchParam('id') == 'new') {
      alert("새 글쓰기 중에는 댓글을 작성할 수 없습니다.");
      return;
    }

    var fd = new FormData();
    var comment_file = document.querySelector('#comment_file_input').files[0];
    var comment_data = $('.comment_form').serializeArray();

    $.each(comment_data, function(key, input) {
      if (!input.value) {
        alert("항목이 비어있습니다.");
        return;
      }
      fd.append(input.name, input.value);
    });

    var query = searchParam('id');
    fd.append('install_id', query);
    fd.append('comment_type', "upload");
    fd.append('commenter_id', '<?php echo $user_id; ?>');
    fd.append('commenter_name', '<?php echo $user_name; ?>');
    fd.append('comment_file', comment_file);
    fd.append('comment_purpose', document.querySelector('#comment_purpose').innerText);

    $.ajax({
      url: './php/comment-upload.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }

  function comment_file(index) {
    var image_file_name = <?php echo json_encode($image_download_link); ?>;
    if (image_file_name[index]) {
      console.log(image_file_name[index] + "/" + index);
    } else {
      console.log("비었음");
    }

  }

  function commments_delete(index) {
    var fd = new FormData();

    fd.append('comment_id', index);
    fd.append('comment_type', "delete");
    $.ajax({
      url: './php/comment-upload.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
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

  async function sign_ok() {
    console.log("한조 대기중");
    await form_submit(0);
    location.href = `/install-sign.php?install_id=${searchParam('id')}`;
  }
</script>
<script type="text/javascript" src="script/info-edit.js?<?php echo time(); ?>"></script>

</html>