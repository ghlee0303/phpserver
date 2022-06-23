<?php

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.49">
  <meta charset="utf-8">
</head>

<style>

</style>

<body>
  <input type="file" id="excel_file">
  <button onclick="dddd()">dddd</button>
</body>

<script type="text/javascript">
  function dddd() {
    var fd = new FormData();
    var files = $("#excel_file")[0].files[0];
    console.log(files);
    fd.append("excel_file", files);
    $.ajax({
      url: './excel-install.php',
      data: fd,
      contentType: false,
      processData: false,
      async: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
      }
    });
  }
</script>
<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</html>