<?php
include "./php/db.php";
include "./php/login-ok.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
    <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
</head>
<style>
</style>

<body>
    <?php include "./header.php"; ?>

    <div class="container container-mobile-1 pb-3">
        <div class="row mb-2">
            <div class="btn btn-dark rounded-3 col-3 fs-5 dropdown align-center">
                <div class="dropdown-toggle dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    현황
                </div>
                <ul class="dropdown-menu dropdown-scroll">
                    <li><button class="dropdown-item" onclick="top_menu(0)">구역별 현황&nbsp</button></li>
                    <li><button class="dropdown-item" onclick="top_menu(1)">인원별 현황&nbsp</button></li>
                    <li><button class="dropdown-item" onclick="top_menu(2)">메일/인쇄/다운&nbsp</button></li>
                </ul>
            </div>
            <button type="button" onclick="location.href = '/manege-user.php'" class="btn btn-outline-dark rounded-3 col-3 fs-5">유저관리</button>
            <button type="button" onclick="location.href = '/manege-install.php'" class="btn btn-outline-dark rounded-3 col-3 fs-5">설치관리</button>
            <button type="button" onclick="" class="btn btn-outline-dark rounded-3 col-3 fs-5">유지보수관리</button>
        </div>
        <div class="bg_manege_view p-2">
            <div class="text-center mx-auto mt-4 fs-3 fw-bold">관리현황</div>
            <div class="d-flex justify-content-between mx-5">
                <div class="dropdown text-center border-bl">
                    <div class="btn dropdown-toggle fs-5 dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" value="a01">
                        전체
                    </div>
                    <ul class="dropdown-menu dropdown-scroll">
                        <li><button class="dropdown-item" value="a01">전남교육청&nbsp</button></li>
                        <li><button class="dropdown-item" value="a02">00교육청&nbsp</button></li>
                        <li><button class="dropdown-item" value="a03">11교육청&nbsp</button></li>
                        <li><button class="dropdown-item" value="a04">22교육청&nbsp</button></li>
                    </ul>
                </div>
                <button class="btn fs-5 border-bl">www</button>
            </div>
            <button id="test1">테스트</button>
            <div class="text-center mx-auto fs-4 mt-4 mb-3">설치</div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    총설치완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
                <div class="col-4">
                    총설치예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    기기설치완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
                <div class="col-4">
                    기기설치예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    연동완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
                <div class="col-4">
                    연동예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    제어기완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
                <div class="col-4">
                    제어기예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 install">&nbsp</span>
                </div>
            </div>

            <div class="mx-5 mt-5 mb-3">
                <div class="fs-4 flex-center manege_sub_header">유지보수</div>
                <div class="row">
                    <div class="col-3 dropdown text-center border-bl ">
                        <div class="btn dropdown-toggle fs-5 dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" value="a01">
                            2022
                        </div>
                        <ul class="dropdown-menu dropdown-scroll">
                            <?php
                            for ($index = 2022; $index < 2033; $index = $index + 1) {
                                echo "<li><button class=\"dropdown-item\">$index&nbsp</button></li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-3 dropdown text-center border-bl ">
                        <div class="btn dropdown-toggle fs-5 dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" value="1">
                            1차
                        </div>
                        <ul class="dropdown-menu dropdown-scroll">
                            <?php
                            for ($index = 1; $index < 11; $index = $index + 1) {
                                $var = $index . "차";
                                echo "<li><button class=\"dropdown-item maintenance_date\" value=\"$index\">$var&nbsp</button></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    총유지완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
                <div class="col-4">
                    총유지보수예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    총설치유지완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
                <div class="col-4">
                    설치유지보수예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    연동유지완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
                <div class="col-4">
                    연동유지보수예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
            </div>
            <div class="d-flex justify-content-around fs-4 text-center mb-3">
                <div class="col-4">
                    제어기유지완료<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
                <div class="col-4">
                    제어기유지보수예정<br>
                    <span class="d-inline-block text-center w-33 border-bl bg-light mt-1 maintenance">&nbsp</span>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>
<script type="text/javascript" src="script/manege-auth.js?<?php echo time(); ?>"></script>
<script>
    function install_setting(result) {
        var i = 0;
        result.forEach(function(array) {
            array.forEach(function(data) {
                $(`.install:eq(${i++})`).text(data);
                //console.log(i++);
            });
        });
    }

    function maintenance_setting(result) {
        var i = 0;
        result.forEach(function(array) {
            array.forEach(function(data) {
                $(`.maintenance:eq(${i++})`).text(data);
                //console.log(i++);
            });
        });
    }

    function install_call() {
        var fd = new FormData();
        var result = [];
        fd.append('jud', 1);

        $.ajax({
            url: './php/manege_view_count.php',
            data: fd,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data) {
                install_setting(JSON.parse(data));
                //console.log(data);
            }
        });
    }

    function maintenance_call(quarter) {
        console.log(quarter);
        var fd = new FormData();
        var result = [];
        fd.append('jud', 2);
        fd.append('quarter', quarter);
        fd.append('year', 2022);

        $.ajax({
            url: './php/manege_view_count.php',
            data: fd,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data) {
                //console.log(data);
                maintenance_setting(JSON.parse(data));
                console.log(data);
            }
        });
    }

    $(`.maintenance_date`).click(function() {
        maintenance_call($(this).val());
    });

    $(`#test1`).click(function() {
        install_call();
        /*
        var fd = new FormData();
        var result = [];
        fd.append('quarter', 2);
        fd.append('year', 2022);

        $.ajax({
            url: './php/test.php',
            data: fd,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data) {
                console.log(data);
            }
        });*/
    });

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
    install_call();
    maintenance_call(1);
</script>

</html>