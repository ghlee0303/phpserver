<div class="container-md install" style="display:none">
    <div class="row mt-5 mb-4">
        <div class="col"></div>
        <div class="col-11 fs-3 text-center">지진경보장치 설치완료 확인서</div>
    </div>
    <div class="row mt-1">
        <div class="col-1">
            <input class="form-check-input" type="checkbox" value="" style='zoom:1.4' name="image_delete_check[]">
        </div>
        <div class="filebox col-11" style="display: table;">
            <label class="border-gr align-center image-box-2" style="width:100%; display:table-cell;" for="image1">
                <img class="image_container" style="width:100%; height:100%; display:none" src="" alt="">
            </label>
            <input type="file" id="image1" accept="image/*" onchange="setThumbnail(event, 0);" />
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
    <div class="card-body">
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