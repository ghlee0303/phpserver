<?php 
    include "./php/db.php";

    $post_db_data = array();
    $install_spot_db_data = array();

    $sql = "SELECT id FROM user";
    $result = mysqli_query($mysqli, $sql);
    $user = mysqli_fetch_array($result);
    //echo $row['id'];
    
    /*
    $sql = "SELECT * FROM post WHERE user_id = $user[id]" ;
    $result = mysqli_query($mysqli, $sql);
    
    while($post_row = mysqli_fetch_array($result)) {
        $post_db_data[] = $post_row;
        echo "$post_row[id]<br>";
    }*/

    $post_db_max = mysqli_num_rows($result);

    $sql = "SELECT count, date_format(install_spot.date, '%Y-%m-%d') as date, install_spot.address_2 as address, post.id as id FROM post JOIN install_spot ON post.install_spot = install_spot.id WHERE user_id = $user[id] ORDER BY date DESC";
    //$sql = "SELECT date_format(date, '%Y-%m-%d') as date, address_2 FROM install_spot WHERE id <= $post_db_max ORDER BY date DESC";
    $result = mysqli_query($mysqli, $sql);

    while($install_spot_row = mysqli_fetch_array($result)) {
        $install_spot_db_data[] = $install_spot_row;
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?a">
    <link rel="stylesheet" type="text/css" href="style/mobile.css?<?php echo time(); ?>">
</head>

<body>
    <?php include "./header.php"; ?>
    <div class="container container-mobile-1 pb-3">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between pb-4 mt-4 nav_bottom_line">
            <div class="row">
                <div class="col dropdown">
                    <div class="col btn btn-secondary dropdown-toggle fs-3 w-dropdown" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false" name="region">
                        지역
                    </div>
                    <ul class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenu1">
                        <li><button class="dropdown-item item_1">서울특별시</button></li>
                        <li><button class="dropdown-item item_1">부산특별시</button></li>
                        <li><button class="dropdown-item item_1">대구특별시</button></li>
                        <li><button class="dropdown-item item_1">서울특별시</button></li>
                        <li><button class="dropdown-item item_1">부산특별시</button></li>
                        <li><button class="dropdown-item item_1">대구특별시</button></li>
                        <li><button class="dropdown-item item_1">서울특별시</button></li>
                        <li><button class="dropdown-item item_1">부산특별시</button></li>
                        <li><button class="dropdown-item item_1">대구특별시</button></li>
                    </ul>
                </div>
            </div>

            <div class="col d-flex align-items-center">
                <form class="me-3" id="search-form">
                    <input type="search" class="form-control float-end w-75 fs-4" placeholder="검색">
                </form>
                <button type="submit" form="search-form" class="w-25 btn btn-outline-primary me-2 px-0 fs-4">검색</button>
            </div>
        </header>
        <table class="table table-striped table-scroll">
            <thead>
                <tr>
                    <th scope="col" class="pt-4 fs-5 ">#</th>
                    <th scope="col" class="pt-4 fs-5 text-center">방문 장소</th>
                    <th scope="col" class="pt-4 fs-5 text-center">설치일자</th>
                    <th scope="col" class="pt-4 fs-5 text-center">입력</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($install_spot_db_data as $key => $value) {
                    $index = $key+1;
                    $ddd = "
                    <tr onclick=\"location.href='/install-info.php?id=$value[id]' \">
                        <td>$index</td>
                        <td>$value[address]</td>
                        <td>$value[date]</td>
                        <td class='text-center'>$value[count]/66</td>
                    </tr>";
                    echo $ddd;
                }
                ?>
            </tbody>
        </table>
        <div class="mt-5 ">
            <button type="button" class="btn btn-light border rounded-3 float-end col-3 fs-2 h-5r " onclick="location.href='/install-info.php?id=new' "> 글쓰기 </button>
        </div>
    </div>
</body>
<script type="text/javascript" src="script/info-edit.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="script/test.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ko.min.js"></script>

</html>