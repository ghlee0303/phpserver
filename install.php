<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css?after">
    <link rel="stylesheet" type="text/css" href="style/mobile.css?after">
    <script type="text/javascript" src="script/bootstrap.bundle.min.js"></script>
  </head>

  <style>
    .dropdown-scroll{
        width: 12vw;
        height:20vh;
        overflow-y:auto;
    } 
  </style>
  
  <body>
    <?php include "./header.php"; ?>
    <div class="container container-mobile-1 pb-3">

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between pb-4 mt-4 nav_bottom_line">
            <div>
                <span class="fs-1 align-center me-3">분류</span>
                <span class="dropdown w-dropdown">
                    <div class="btn btn-secondary dropdown-toggle w-dropdown fs-4" type="button" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown button
                    </div>
                    <ul class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenu1">
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                        <li><button class="dropdown-item">Action</button></li>
                        <li><button class="dropdown-item">Another action</button></li>
                        <li><button class="dropdown-item">Something else here</button></li>
                    </ul>
                </span>
            </div>
            <div class="d-flex align-items-center"> 
                <form class="me-3" id="search-form">
                    <input type="search" class="form-control float-end w-75 fs-4" placeholder="검색">
                </form>
                <button type="submit" form="search-form" class="btn btn-outline-primary me-2 fs-4">검색</button>
            </div>
        </header>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="py-4 fs-5">#</th>
                    <th scope="col" class="py-4 fs-5">CODE</th>
                    <th scope="col" class="py-4 fs-5">방문 장소명</th>
                    <th scope="col" class="py-4 fs-5">설치일자</th>
                    <th scope="col" class="py-4 fs-5">설치장소</th>
                    <th scope="col" class="py-4 fs-5">메뉴설정</th>
                    <th scope="col" class="py-4 fs-5">체크 리스트</th>
                    <th scope="col" class="py-4 fs-5">사진 업로드</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>아이초등학교1</td>
                    <td>2022.02.06</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>Thornton</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>아이초등학교1</td>
                    <td>2022.02.06</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>Thornton</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Mark</td>
                    <td>아이초등학교1</td>
                    <td>2022.02.06</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Thornton</td>
                </tr>
            </tbody>
        </table>
    </div>
  </body>
  <script type="text/javascript" src="script/dropdown.js"></script>
</html>