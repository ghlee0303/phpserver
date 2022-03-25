<div class="container-md install">
    <form class="post_form" action="" method="post" onsubmit="return false">
        <input type="hidden" name="iden" value="1">
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-3">설치일자</td>
                <td class="form-group col p-0" colspan="2">
                    <div class="input-group date" id="datetimepicker" data-target-input="nearest" data-bs-auto-close="inside">
                        <input type="text" id="calendar_text" class="form-control datetimepicker-input fs-4 border-bl h-info_form" data-target="#datetimepicker" name="date" value="<?php echo $date; ?>" readOnly />
                        <div class="input-group-append " data-target="#datetimepicker" data-toggle="datetimepicker">
                            <div class="input-group-text btn_calendar" id="calendar_q" onclick="calendar_btn(0)"><i class="fa fa-calendar m-auto"></i></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-3">주소</td>
                <td class="col-3">시/도</td>
                <td class="col-6 p-0">
                    <div class="dropdown text-center border-bl h-info_form">
                        <input type="hidden" id="val_1" name="region">
                        <div class="btn btn-white dropdown-toggle fs-3 h-info_form col" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false">
                            지역
                        </div>
                        <ul class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenu1">
                            <li><button class="dropdown-item item_1" value="a01">서울특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a02">부산특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a03">대구특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a04">서울특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a05">부산특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a06">대구특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a07">서울특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a08">부산특별시</button></li>
                            <li><button class="dropdown-item item_1" value="a09">대구특별시</button></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">상세주소</td>
                <td class="col-5 p-0">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="detail_address" name="address[]" value="<?php echo $address_1; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">장소명</td>
                <td class="col-5 p-0">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="spot_address" name="address[]" value="<?php echo $address_2; ?>">
                </td>
            </tr>
            <tr class="h-info-form">
                <td class="col-3">소속 교육청</td>
                <td class="col-3 p-0" colspan="2">
                    <div class="dropdown text-center border-bl h-info_form">
                        <input type="hidden" id="val_2" name="office_edu">
                        <div class="btn btn-white dropdown-toggle fs-3 h-info_form col" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            교육청
                        </div>
                        <ul class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenu2">
                            <li><button class="dropdown-item item_2" value="b01">서울특별시</button></li>
                            <li><button class="dropdown-item item_2" value="b02">부산광역시</button></li>
                            <li><button class="dropdown-item item_2" value="b03">대구광역시</button></li>
                            <li><button class="dropdown-item item_2" value="b04">서울특별시</button></li>
                            <li><button class="dropdown-item item_2" value="b05">부산광역시</button></li>
                            <li><button class="dropdown-item item_2" value="b06">대구광역시</button></li>
                            <li><button class="dropdown-item item_2" value="b07">서울특별시</button></li>
                            <li><button class="dropdown-item item_2" value="b08">부산광역시</button></li>
                            <li><button class="dropdown-item item_2" value="b09">대구광역시</button></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr class="col-6 h-info-form">
                <td class="">설치위치</td>
                <td class="col-8 p-0" colspan="2">
                    <input type="text" class="form-control fs-4 border-0 h-info_form border-bl text-center" id="location" name="location" value="<?php echo $location; ?>">
                </td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-3">현장 설치자</td>
                <td class="col-3">이름</td>
                <td class="col-6 border-bl text-center h-info_form" id="installer_name"><?php echo $installer_name ?></td>
            </tr>
            <tr>
                <td></td>
                <td class=" col-3" colspan="1">연락처</td>
                <td class="col-6 border-bl text-center h-info_form" id="installer_phone"><?php echo $installer_phone ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="col-3" colspan="1">메일주소</td>
                <td class="col-6 border-bl text-center h-info_form" id="installer_email"><?php echo $installer_email ?></td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-3">장치 관리자</td>
                <td colspan="1">이름</td>
                <td class="col-6 p-0">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="maneger_name" name="maneger[]" value="<?php echo $maneger_name; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">연락처</td>
                <td class="col-6 p-0" colspan="2">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="maneger_phone" name="maneger[]" value="<?php echo $maneger_phone; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">메일주소</td>
                <td class="col-6 p-0" colspan="2">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="maneger_email" name="maneger[]" value="<?php echo $maneger_email; ?>">
                </td>
            </tr>
        </table>
        <div class="text-end mt-3">
            <button type="button" class="btn btn-outline-primary btn-mobile col-4" onclick="form_submit()">임시저장</button>
        </div>
    </form>
</div>