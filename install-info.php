<?php
include "./php/db.php";
include "./php/login-ok.php";

if ($_GET['id'] == 'new') {
  $user_id = $_SESSION['userid'];
  $user_name = $_SESSION['name'];

  $user_sql = "SELECT * FROM user WHERE name = '$user_name' AND user_id = '$user_id'";
  $user_result = mysqli_query($mysqli, $user_sql);
  $user_row = mysqli_fetch_array($user_result);

  $installer_name = $user_row['name'];
  $installer_phone = $user_row['phone'];
  $installer_email = $user_row['email'];
} else {
  $post_sql = "SELECT menu.id AS m_id, post.id AS id, check_list, count, date, region, address_1, address_2, office_edu, location, maneger_name, maneger_phone, maneger_email, network_ip, network_subnet, network_gateway, network_dns, server_ip, server_id, server_port, server_pwd, latitude, longitude, name, phone, email FROM post JOIN install_spot AS spot ON spot.id = post.install_spot JOIN menu_list AS menu ON menu.id = post.menu_setting JOIN user AS installer ON installer.id = post.user_id WHERE post.id = $_GET[id]";
  $post_result = mysqli_query($mysqli, $post_sql);
  $post_row = mysqli_fetch_array($post_result);

  $check = $post_row['check_list'];
  $date = $post_row['date'];
  $region = $post_row['region'];
  $address_1 = $post_row['address_1'];
  $address_2 = $post_row['address_2'];
  $office_edu = $post_row['office_edu'];
  $location = $post_row['location'];
  $maneger_name = $post_row['maneger_name'];
  $maneger_phone = $post_row['maneger_phone'];
  $maneger_email = $post_row['maneger_email'];
  $network_ip = $post_row['network_ip'];
  $network_subnet = $post_row['network_subnet'];
  $network_gateway = $post_row['network_gateway'];
  $network_dns = $post_row['network_dns'];
  $server_ip = $post_row['server_ip'];
  $server_port = $post_row['server_port'];
  $server_id = $post_row['server_id'];
  $server_pwd = $post_row['server_pwd'];
  $lat = $post_row['latitude'];
  $lon = $post_row['longitude'];
  $installer_name = $post_row['name'];
  $installer_phone = $post_row['phone'];
  $installer_email = $post_row['email'];

  $brod_sql = "SELECT scale1, scale2, distance FROM brodcast WHERE menu_id = $post_row[m_id]";
  $brod_result = mysqli_query($mysqli, $brod_sql);

  $brod = array();
  $brod[0] = mysqli_fetch_array($brod_result);
  $brod[1] = mysqli_fetch_array($brod_result);
  $brod[2] = mysqli_fetch_array($brod_result);
  $brod[3] = mysqli_fetch_array($brod_result);

  $image_sql = "SELECT photo, num FROM photo_name WHERE post_id = $post_row[id]";
  $image_result = mysqli_query($mysqli, $image_sql);
  $image_query = mysqli_fetch_array($image_result);
  $images = array();
  $images_num = array();

  while ($image_query) {
    $images[] = $image_query['photo'];
    $images_num[] = $image_query['num'];
    $image_query = mysqli_fetch_array($image_result);
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
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
      <button type="button" onclick="top_menu(4)" class="btn btn-outline-dark rounded-3 col-20 fs-5">설치완료</button>
    </div>
    <?php include "./install-form/form_1.php" ?>
    <?php include "./install-form/form_2.php" ?>
    <?php include "./install-form/form_3.php" ?>
    <?php include "./install-form/form_4.php" ?>
    <?php include "./install-form/form_5.php" ?>
    <?php
    if ($jud) {
      include "install-comment.php";
    } ?>

  </div>

</body>

<script type="text/javascript">
  window.onbeforeunload = function() {
    return '메세지 내용';
  };
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
    image_set();

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

      console.log("top 2 : " + index + "/" + menu_val);
      view[index].style.display = '';
      view[menu_val].style.display = 'none';

      menu_val = index;
    }
  }

  function sub_form(index) {
    if (sub_form_val != index) {
      var view = document.querySelectorAll('.photo_form');

      console.log("form : " + index + "/" + menu_val);
      view[index].style.display = '';
      view[sub_form_val].style.display = 'none';

      sub_form_val = index;
    }
  }

  function calendar_btn() {
    document.getElementById("calendar_text").readOnly = false;
  }
  document.getElementById('calendar_text').addEventListener('blur', function() {
    document.getElementById("calendar_text").readOnly = true;
  });

  function image_set() {
    var images = <?php echo json_encode($images); ?>;
    var images_num = <?php echo json_encode($images_num); ?>;

    images.forEach((image_file, index) => {
      var img = document.querySelectorAll(".image_container")[images_num[index] - 1];
      var image_src = "./php/imagecall.php?file=" + image_file;
      img.style.display = '';
      img.src = image_src;

      console.log(img.src + " / " + images_num[index]);
    });
  }

  function setThumbnail(event, index) {
    var v = document.querySelectorAll(".image_container")[index];
    var reader = new FileReader();
    reader.onload = function(event) {
      v.style.display = '';
      v.src = event.target.result;
    }
    if (!(event.target.files[0] == null))
      reader.readAsDataURL(event.target.files[0]);
  }

  function form_submit(index) {
    var fd = new FormData();
    var img_count = 0;
    fd.append('user_id', '<?php echo $_SESSION['userid'] ?>');
    fd.append('user_name', '<?php echo $_SESSION['name'] ?>');
    fd.append('query', searchParam('id'));

    for (var i = 1; i <= 4; i++) {
      var other_data = $('#form_' + i).serializeArray();
      $.each(other_data, function(key, input) {
        fd.append(input.name, input.value);
      });
    }

    $.each($('input[type="file"]'), function(index, file_data) {
      var img = document.querySelectorAll(".image_container")[index];
      var files = file_data.files[0];

      if (!(files == null)) {
        fd.append("img[]", files);
        fd.append("file_id[]", index + 1);
      }

      if (img.style.display == '')
        img_count++;

      fd.append("img_count", img_count);
    })

    $.ajax({
      url: './php/install-new.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }
</script>
<script type="text/javascript" src="script/info-edit.js?<?php echo time(); ?>"></script>

</html>