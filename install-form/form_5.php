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
    <form class="install_form" action="" method="post" onsubmit="return false">
        <table class="fs-5 mb-5">
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">1. 지진경보장치 연결 확인 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="23" style='zoom:1.4' name="check[]">
                </td>
            </tr>
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">2. 지진경보장치 IP 확인 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="24" style='zoom:1.4' name="check[]">
                </td>
            </tr>
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">3. 경보방송 설정 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="25" style='zoom:1.4' name="check[]">
                </td>
            </tr>
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">4. 훈련 방송 송출 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="26" style='zoom:1.4' name="check[]">
                </td>
            </tr>
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">5. 지진경보장치 WEB 접속 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="27" style='zoom:1.4' name="check[]">
                </td>
            </tr>
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">6. 지진 수신 단계 및 멘트 설정 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="28" style='zoom:1.4' name="check[]">
                </td>
            </tr>
            <tr class="border-bl-90">
                <td class="w-100 px-4" colspan="2">7. 훈련방송 멘트 설정 및 방송송출 방법 안내</td>
                <td class="">
                    <input class="form-check-input check_list me-4" type="checkbox" value="29" style='zoom:1.4' name="check[]">
                </td>
            </tr>
        </table>
    </form>
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

    <div class="mx-3">
        <section class="d-flex bg-grey">
            <div class="">설치</div>
            <div class="border-bl-90 text-center mx-2" style="width: 100px;"><?php echo $comment_total[0] ?></div>
            <div class="">연동</div>
            <div class="border-bl-90 text-center mx-2" style="width: 100px;"><?php echo $comment_total[1] ?></div>
            <div class="">제어기</div>
            <div class="border-bl-90 text-center mx-2" style="width: 100px;"><?php echo $comment_total[2] ?></div>
            <div class="ms-auto dropdown">
                <div id="search_purpose" class="dropdown-toggle dropdownMenu border-bl-90 text-center" style="width: 90px;" value="0" data-bs-toggle="dropdown" aria-expanded="false">
                    전체
                </div>
                <ul class="dropdown-menu dropdown-scroll">
                    <li><button class="dropdown-item search_purpose_item">전체</button></li>
                    <li><button class="dropdown-item search_purpose_item">설치</button></li>
                    <li><button class="dropdown-item search_purpose_item">추가설치</button></li>
                    <li><button class="dropdown-item search_purpose_item">연동설치</button></li>
                    <li><button class="dropdown-item search_purpose_item">제어기설치</button></li>
                    <li><button class="dropdown-item search_purpose_item">교체</button></li>
                    <li><button class="dropdown-item search_purpose_item">반품</button></li>
                </ul>
            </div>
        </section>
        <section class="d-flex justify-content-center w-100 fs-5 bg-grey">
            <div class="col text-center">#</div>
            <div class="col text-center">목적</div>
            <div class="col text-center">차수</div>
            <div class="col text-center">날짜</div>
            <div class="col text-center">시간</div>
            <div class="col text-center">성명</div>
            <div class="col text-center">사진</div>
        </section>
        <div id="comment_list">

        </div>
        <div class="card-body">
            <form class="comment_form" class="mb-4 row" action="" method="post" onsubmit="return false">
                <div class="align-center mb-3 row mt-2 align-center mx-5">
                    <section class="d-flex justify-content-between w-100 fs-5">
                        <div class="dropdown">
                            <div id="comment_purpose" class="dropdown-toggle dropdownMenu border-bl-90 p-1 text-center" style="width: 130px;" data-bs-toggle="dropdown" aria-expanded="false">
                                설치
                            </div>
                            <ul class="dropdown-menu dropdown-scroll purpose_menu">
                                <li><button class="dropdown-item purpose_item">설치</button></li>
                                <li><button class="dropdown-item purpose_item">추가설치</button></li>
                                <li><button class="dropdown-item purpose_item">연동설치</button></li>
                                <li><button class="dropdown-item purpose_item">제어기설치</button></li>
                                <li><button class="dropdown-item purpose_item">교체</button></li>
                                <li><button class="dropdown-item purpose_item">반품</button></li>
                            </ul>
                        </div>

                        <div id="product_div" class="d-flex">
                            <div class="p-1">제품번호</div>
                            <input type="text" class="col border-bl-90 ms-2 me-4 p-1 product" style="width: 100px;">
                        </div>
                    </section>
                </div>
                <textarea class="form-control col" rows="2" placeholder="특이사항" id="comment_text" name="comment_text"></textarea>

                <section class="d-flex justify-content-center w-100 fs-5 mt-3">
                    <input type="text" id="comment_file_label" class="me-3 border-bl-90" style="flex-grow: 2;" readonly="readonly">
                    <label class="btn btn-outline-info" for="comment_file_input">
                        파일
                    </label>
                    <input type="file" id="comment_file_input" style="display:none" onchange="javascript:document.getElementById('comment_file_label').value = this.value.split('\\')[this.value.split('\\').length-1]" />
                    <button type="submit" class="btn btn-outline-primary ms-3" onclick="comment_submit()">작성</button>
                </section>
            </form>
        </div>
    </div>
    <div class="mt-3 d-flex">
        <button type="button" class="btn btn-danger btn-mobile d-block w-75" onclick="form_submit(1, 1)"><?= $type_btn ?> 완료</button>
        <button type="button" class="btn btn-outline-primary btn-mobile d-block ms-auto w-23" onclick="form_submit(0, 1)">임시저장</button>
    </div>
</div>