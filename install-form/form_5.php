<div class="container-md install" style="display:none">
    <div class="row mt-5 mb-4">
        <div class="col"></div>
        <div class="col-11 fs-3 text-center">지진경보장치 설치완료 확인서</div>
    </div>
    <table class="w-100 install-table fs-5 align-middle table-border-0 confirm_install">
        <tr class="border-bl py-1">
            <td class="bg-check border-bl-90 text-center">소속 교육청/지역</td>
            <td class="p-0" colspan="2">
                <input type="text" id="confirm_region" class="fs-5 border-bl-90 text-center w-100 m-0" value="">
            </td>
        </tr>
        <tr class="py-1">
            <td class="bg-check border-bl-90 text-center">방문장소</td>
            <td class="p-0" colspan="2">
                <input type="text" id="confirm_spot" class="fs-5 border-bl-90 text-center w-100 m-0" value="">
            </td>
        </tr>
        <tr class="py-1">
            <td class="bg-check border-bl-90 text-center">주소</td>
            <td class="p-0" colspan="2">
                <input type="text" id="confirm_address" class="fs-5 border-bl-90 text-center w-100 m-0" value="">
            </td>
        </tr>
        <tr>
            <td class="bg-check border-bl-90 text-center py-1" colspan="3">
                작동방법안내
            </td>
        </tr>
    </table>
    <table class="fs-5 mb-5">
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">1. 지진경보장치 연결 확인 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="1" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">2. 지진경보장치 IP 확인 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="2" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">3. 경보방송 설정 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="3" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">4. 훈련 방송 송출 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="4" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">5. 지진경보장치 WEB 접속 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="5" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">6. 지진 수신 단계 및 멘트 설정 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="6" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
        <tr class="border-bl-90">
            <td class="w-100 px-4" colspan="2">7. 훈련방송 멘트 설정 및 방송송출 방법 안내</td>
            <td class="">
                <input class="form-check-input check_list me-4" type="checkbox" value="7" style='zoom:1.4' name="confirm_check[]">
            </td>
        </tr>
    </table>
    <div class="mx-auto fs-4 text-center mt-5">
        상기 제품 설치완료 및 안내를 확인하여 주시길 바랍니다.
    </div>
    <div class="mx-auto row w-75 fs-5 my-5">
        <div class="col-3 text-center">
            설치일자 :
        </div>
        <div class="col-2 confirm_data">

        </div>
        <div class="col-1">
            년
        </div>
        <div class="col-2 confirm_data">

        </div>
        <div class="col-1">
            월
        </div>
        <div class="col-2 confirm_data">

        </div>
        <div class="col-1">
            일
        </div>
    </div>
    <div class="mx-auto fs-4 text-center my-5">
        상기 제품이 설치완료 및 안내를 확인합니다.
    </div>
    <div class="me-5 fs-4 text-end mt-5">
        방송장치관리자
    </div>
    <div class="fs-4 text-end mt-3 mb-5">
        서명:
        <button class="border-bottom-2 w-25p bg-white border-top-0 border-start-0 border-end-0 <?php echo $sign_color_tag ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo $sign_text ?></button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-2" id="exampleModalLabel">서명</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="mx-auto text-center fs-4 my-4">
                    임시저장 후 서명 페이지로 이동합니다.<br>임시저장 하시겠습니까?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary" onclick="sign_ok()" data-bs-dismiss="modal">저장</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    for ($index = 0; $index < $comment_count; $index = $index + 1) {
        $ddd = "
                <div class=\"d-flex my-5 comments\">
                    <div class=\"ms-4 w-100\">
                        <div class=\"fw-bold fs-sm-2 mb-1 commenter\">
                            $installer_name
                            <span class=\"fw-normal fs-sm-1 comments_purpose\">$comments_purpose[$index]</span>
                            <span class=\"fw-normal fs-sm-1 comments_time\">$comments_date[$index]</span>
                        </div>
                        <div>$comments_contents[$index]</div>
                    </div>
                    <div>
                        <a class=\"btn btn-outline-info fw-normal fs-sm-1 p-1 commments_file w-100\" href=\"$image_download_link[$index]\" download>첨부파일</a>
                        <div class=\"btn btn-outline-info fw-normal fs-sm-1 p-1 w-100\" onclick=\"commments_delete($comments_index[$index])\">삭제</div>
                    </div>
                </div>
                ";
        echo $ddd;
    }
    ?>
    <div class=" card-body">
        <form class="comment_form" class="mb-4 row" action="" method="post" onsubmit="return false">
            <div class="align-center mb-3 row mt-2 align-center">
                <div class="col-2 fs-sm-2 border-bl p-2 ms-3" id="comment_purpose">설치</div>
                <div class="col-3 fs-sm-2 border-bl p-2 ms-3"><?php echo $user_name; ?></div>
                <div class="input-group date col me-auto" id="datetimepicker_comment" data-target-input="nearest" data-bs-auto-close="inside">
                    <input type="text" id="calendar_text_comment" class="form-control datetimepicker-input border-bl bg-white fs-sm-2" data-target="#datetimepicker_comment" name="comment_date" readOnly />
                    <div class="input-group-append" data-target="#datetimepicker_comment" data-toggle="datetimepicker">
                        <div class="input-group-text btn_calendar_2" id="comment_calendar" onclick="calendar_btn(1)"><i class="fa fa-calendar m-auto"></i></div>
                    </div>
                </div>
            </div>
            <textarea class="form-control col" rows="3" placeholder="Join the discussion and leave a comment!" id="comment_text" name="comment_text"></textarea>
            <div class="my-3 row align-center">
                <button type="submit" class="btn btn-outline-primary fs-sm-2 col-3 mx-3" onclick="comment_submit()">작성</button>
                <input type="text" id="comment_file_label" class="col me-3 border-bl fs-sm-2" readonly="readonly">
                <label class="btn btn-outline-info fs-sm-2 col-2" for="comment_file_input">
                    파일
                </label>
                <input type="file" id="comment_file_input" style="display:none" onchange="javascript:document.getElementById('comment_file_label').value = this.value.split('\\')[this.value.split('\\').length-1]" />
            </div>
        </form>
    </div>
    <div class="mt-3 d-flex">
        <button type="button" class="btn btn-danger btn-mobile d-block w-75" onclick="form_submit(1)"><?= $type_btn ?> 완료</button>
        <button type="button" class="btn btn-outline-primary btn-mobile d-block ms-auto w-23" onclick="form_submit(0)">임시저장</button>
    </div>
</div>