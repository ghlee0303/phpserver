<div class="d-flex my-5 comments">
    <div class="ms-4">
        <div class="fw-bold fs-sm-2 mb-1 commenter">
            홍길동wwww
            <span class="fw-normal fs-sm-1 comments_purpose">설치</span>
            <span class="fw-normal fs-sm-1 comments_time">2022.02.16</span>
            <span class="btn btn-outline-info fw-normal fs-sm-1 float-end p-1 commments_file">첨부파일</span>
        </div>
        If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
    </div>
</div>

<div class="card-body">
    <form id="comment_form" class="mb-4 row" action="" method="post" onsubmit="return false">
        <div class="align-center mb-3 row mt-2 align-center">
            <div class="col-2 fs-sm-2 border-bl p-2 ms-3" name="comment_purpose">설치</div>
            <div class="col-3 fs-sm-2 border-bl p-2 ms-3"><?php echo $user_name; ?></div>
            <div class="input-group date col me-auto" id="datetimepicker_comment" data-target-input="nearest" data-bs-auto-close="inside">
                <input type="text" name="calendar_text_comment" class="form-control datetimepicker-input border-bl bg-white fs-sm-2" data-target="#datetimepicker_comment" name="comment_date" readOnly />
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