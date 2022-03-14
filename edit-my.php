<?php
include "./php/db.php";
include "./php/login-ok.php";

$user_sql = "SELECT * FROM user WHERE name = '$_SESSION[name]' AND user_id = '$_SESSION[userid]'";
$user_result = mysqli_query($mysqli, $user_sql);
$user_row = mysqli_fetch_array($user_result);

$user_name = $user_row['name'];
$user_phone = $user_row['phone'];
$user_email = $user_row['email'];
$user_index = $user_row['id'];
$user_position_db = $user_row['position'];
$user_position = 0;
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
</head>

<style>

</style>

<body>
    <?php include "./header.php"; ?>
    <div class="container container-mobile-1">
        <div class="fs-mobile-3">내 정보 수정</div>
        <form class="mypage" action="" method="post" onsubmit="return false">
            <table class="table install-table table-border fs-4 align-middle">
                <tr class="">
                    <td class="">이름</td>
                    <td class="col-8 p-0" colspan="2">
                        <input type="text" class="form-control fs-4 border-0 h-info_form border-bl text-center" id="name" name="name" value="<?php echo $user_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="">현재 비밀번호</td>
                    <td class="col-8 p-0">
                        <input type="text" class="form-control fs-4 h-info_form border-bl text-center pwd" name="pwd[]">
                    </td>
                </tr>
                <tr>
                    <td colspan="1">새 비밀번호</td>
                    <td class="col-8 p-0">
                        <input type="text" class="form-control fs-4 h-info_form border-bl text-center pwd" name="pwd[]">
                    </td>
                </tr>
                <tr>
                    <td colspan="1">새 비밀번호 확인</td>
                    <td class="col-8 p-0">
                        <input type="text" class="form-control fs-4 h-info_form border-bl text-center pwd" name="pwd[]">
                    </td>
                </tr>
                <tr class="">
                    <td class="">연락처</td>
                    <td class="col-8 p-0" colspan="2">
                        <input type="text" class="form-control fs-4 border-0 h-info_form border-bl text-center" id="phone" name="phone" value="<?php echo $user_phone; ?>">
                    </td>
                </tr>
                <tr class="">
                    <td class="">이메일</td>
                    <td class="col-8 p-0" colspan="2">
                        <input type="text" class="form-control fs-4 border-0 h-info_form border-bl text-center" id="email" name="email" value="<?php echo $user_email; ?>">
                    </td>
                </tr>
            </table>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-outline-primary btn-mobile col-4" onclick="edit_mypage_submit()">저장</button>
            </div>
        </form>
    </div>
</body>

<script>
    function pwd_verify(pwd) {
        var fd = new FormData();
        var output = 0;

        fd.append("input_pwd", pwd);
        fd.append("user_pwd", "<?php echo $user_row['user_pwd']; ?>");

        $.ajax({
            url: './php/mypage-edit.php?mode=pwdcheck',
            data: fd,
            async: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data) {
                output = data;
            }
        });
        return output;
    }

    function edit_mypage_submit() {
        var pwd = document.querySelectorAll(".pwd");

        if (pwd[0].value != null) {
            if (pwd_verify(pwd[0].value) == 1) {
                if (pwd[1].value != pwd[2].value) {
                    alert("새 비밀번호가 다릅니다.");
                    return;
                }
                var fd = new FormData();

                $.each($('.mypage').serializeArray(), function(key, input) {
                    fd.append(input.name, input.value);
                });

                fd.append("user_index", <?php echo $user_index ?>);

                $.ajax({
                    url: './php/mypage-edit.php?mode=update',
                    data: fd,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data) {
                        console.log(data);
                    }
                });
            } else {
                alert("현재 비밀번호가 틀렸습니다.");
                return;
            }
        } else {
            alert("현재 비밀번호를 입력해주세요.");
            return;
        }

        /*$.each($('mypage').serializeArray(), function(key, input) {
                fd.append(input.name, input.value);
            });

            fd.append("user_index", );

            $.ajax({
                url: './php/mypage-edit.php?mode=pwdcheck',
                data: fd,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    console.log(data);
                }
            });*/
    }
</script>

</html>