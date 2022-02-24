<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<html>

<head>
  <!-- 한글 깨짐 발생시 인코딩 euc-kr 또는 utf-8로 설정 -->
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
</head>
<title>파일업로드/파일다운로드 페이지</title>

<body>
  <!-- 파일 첨부후 전송전 파일 첨부되었는지 확인하기 위해 fileCheck 스크립트 사용  -->
  <form action="./test_back.php" method="post" enctype="multipart/form-data">
    <input type="file" name="test_file" id="test_file">
    <input type="submit" value="파일 업로드">
  </form>
</body>

</html>


<script>
  function form_submit() {
    var fd = new FormData();

    var fileCheck = document.getElementById("test_file");
    var files = fileCheck.files;

    console.log(fileCheck.value);
    console.log(files);

    fd.append("img", files);


    $.ajax({
      url: './test_back.php',
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