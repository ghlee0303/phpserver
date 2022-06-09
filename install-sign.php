<?php
include "./php/db.php";
include "./php/login-ok.php";

$sql_sign = "SELECT * FROM sign_list WHERE install_id = '$_GET[install_id]' AND delete_yn is null";
$result_sign = mysqli_query($mysqli, $sql_sign);
$row_sign = mysqli_fetch_array($result_sign);

?>

<!DOCTYPE html>
<html>

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

<style>
  body {
    overscroll-behavior-y: none;
  }
</style>

<body>
  <div class="mx-auto text-center mt-5 sign_div">
    <canvas id="myCanvas" class="" style="background-color:aliceblue " width="500" height="700"></canvas>
  </div>

  <div class="result">

  </div>

  <div class="m-5 d-flex justify-content-center">
    <button class="btn btn-secondary fs-3 mx-4 sign_save">서명저장</button>
    <button class="btn btn-info fs-3 mx-4 sign_clean">새로고침</button>
  </div>
  </div>

  <script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
  <script type="text/javascript" src="script/manege-auth.js?<?php echo time(); ?>"></script>
  <script>
    var canvas, context;

    function init() {
      canvas = document.getElementById("myCanvas");
      context = canvas.getContext("2d");

      context.lineWidth = 2; // 선 굵기를 2로 설정
      context.strokeStyle = "black";

      // 마우스 리스너 등록. e는 MouseEvent 객체
      canvas.addEventListener("touchmove", function(e) {
        move(e)
      }, false);
      canvas.addEventListener("touchstart", function(e) {
        start(e)
      }, false);
      canvas.addEventListener("touchend", function(e) {
        end(e)
      }, false);
    }

    var startX = 0,
      startY = 0; // 드래깅동안, 처음 마우스가 눌러진 좌표
    var drawing = false;

    function draw(curX, curY) {
      context.beginPath();
      context.moveTo(startX, startY);
      context.lineTo(curX, curY);
      context.stroke();
    }

    function start(e) {
      startX = e.changedTouches[0].pageX - 30;
      startY = e.changedTouches[0].pageY - 70;
      drawing = true;
    }

    function end(e) {
      drawing = false;
    }

    function move(e) {

      if (!drawing) return; // 마우스가 눌러지지 않았으면 리턴
      var curX = e.changedTouches[0].pageX - 30,
        curY = e.changedTouches[0].pageY - 70;
      draw(curX, curY);
      startX = curX;
      startY = curY;

      /*
      var endX = e.changedTouches[0].clientX;
      var endY = e.changedTouches[0].clientY;*/
    }

    function searchParam(key) {
      return new URLSearchParams(location.search).get(key);
    };

    function imageSave() {
      if (confirm("서명을 저장하시겠습니까?.")) {
        const imgBase64 = canvas.toDataURL();
        const decodImg = atob(imgBase64.split(',')[1]);

        let array = [];
        for (let i = 0; i < decodImg.length; i++) {
          array.push(decodImg.charCodeAt(i));
        }

        const file = new Blob([new Uint8Array(array)], {
          type: 'image/jpeg'
        });
        let formData = new FormData();
        formData.append('sign', file);
        formData.append('install_id', searchParam('install_id'));

        $.ajax({
          type: 'post',
          url: './php/sign-upload.php',
          cache: false,
          data: formData,
          processData: false,
          contentType: false,
          success: function(data) {
            location.href = `/install-info.php?id=${searchParam('install_id')}`;
          }
        });
      }
    }

    function sign_image_set() {
      var sign_img_name = "<?php echo $row_sign['sign_file_name']; ?>";
      var sign_img_src = "./php/imagecall.php?file=" + sign_img_name;

      var image = new Image();
      image.src = sign_img_src;

      image.onload = function() {
        context.drawImage(image, 0, 0);
      }
    }

    function sign_canvas_clean() {
      context.clearRect(0, 0, canvas.width, canvas.height);
    }

    window.onload = function() {
      init();
      $(".sign_save").on("click", imageSave);
      $(".sign_clean").on("click", sign_canvas_clean);
      sign_image_set();
    }
  </script>
</body>

</html>