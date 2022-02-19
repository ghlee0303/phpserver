<div class="container-md install">
    <form id="form_1" action="" method=" post" onsubmit="return false">
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-3">설치일자</td>
                <td class="form-group col p-0" colspan="2">
                    <div class="input-group date" id="datetimepicker" data-target-input="nearest" data-bs-auto-close="inside">
                        <input type="text" id="calendar_text" class="form-control datetimepicker-input fs-4 border-bl h-info_form" data-target="#datetimepicker" name="date" readOnly />
                        <div class="input-group-append " data-target="#datetimepicker" data-toggle="datetimepicker">
                            <div class="input-group-text btn_calendar" id="calendar_q" onclick="calendar_btn()"><i class="fa fa-calendar m-auto"></i></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-3">주소</td>
                <td class="col-3">시/도</td>
                <td class="col-6 p-0">
                    <div class="dropdown text-center border-bl h-info_form">
                        <div class="btn btn-white dropdown-toggle fs-3 h-info_form col" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false" name="address">
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
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">상세주소</td>
                <td class="col-5 p-0">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="detail_address" name="address">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">장소명</td>
                <td class="col-5 p-0">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="spot_address" name="address">
                </td>
            </tr>
            <tr class="h-info-form">
                <td class="col-3">소속 교육청</td>
                <td class="col-3 p-0" colspan="2">
                    <div class="dropdown text-center border-bl h-info_form">
                        <div class="btn btn-white dropdown-toggle fs-3 h-info_form col" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" name="region">
                            교육청
                        </div>
                        <ul class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenu2">
                            <li><button class="dropdown-item item_2">서울특별시</button></li>
                            <li><button class="dropdown-item item_2">부산광역시</button></li>
                            <li><button class="dropdown-item item_2">대구광역시</button></li>
                            <li><button class="dropdown-item item_2">서울특별시</button></li>
                            <li><button class="dropdown-item item_2">부산광역시</button></li>
                            <li><button class="dropdown-item item_2">대구광역시</button></li>
                            <li><button class="dropdown-item item_2">서울특별시</button></li>
                            <li><button class="dropdown-item item_2">부산광역시</button></li>
                            <li><button class="dropdown-item item_2">대구광역시</button></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr class="col-6 h-info-form">
                <td class="">설치위치</td>
                <td class="col-8 p-0" colspan="2">
                    <input type="text" class="form-control fs-4 border-0 h-info_form border-bl text-center" id="location" name="location">
                </td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-3">현장 설치자</td>
                <td class="col-3">이름</td>
                <td class="col-6 border-bl text-center h-info_form">홍길동</td>
            </tr>
            <tr>
                <td></td>
                <td class="col-3" colspan="1">연락처</td>
                <td class="col-6 border-bl text-center h-info_form">01099998888</td>
            </tr>
            <tr>
                <td></td>
                <td class="col-3" colspan="1">메일주소</td>
                <td class="col-6 border-bl text-center h-info_form">abcdefghijk@asssdass</td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-3">장치 관리자</td>
                <td colspan="1">이름</td>
                <td class="col-6 p-0">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="manager_name" name="manager">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">연락처</td>
                <td class="col-6 p-0" colspan="2">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="manager_phone" name="manager">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">메일주소</td>
                <td class="col-6 p-0" colspan="2">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="manager_email" name="manager">
                </td>
            </tr>
        </table>
        <div class="text-end mt-3">
            <button type="button" class="btn btn-outline-primary btn-mobile col-4">저장</button>
        </div>
    </form>
</div>