<div class="container-md install photo_form" style="display:none">
    <form id="form_4" action="" enctype="multipart/form-data" method="post" onsubmit="return false">
        <input type="hidden" name="iden" value="4">
        <div class="row mt-5 mb-4">
            <div class="col"></div>
            <div class="col-11 fs-3 text-center">설치완료 증명서류승룡</div>
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
        <div class="border-bottom-bl mt-5 mb-2"></div>
        <div class="card-body">
            <form class="mb-4 row" action="" method="post" onsubmit="return false">
                <div class="align-center mb-3 row mt-2 align-center">
                    <div class="col-3 fs-sm-2 border-bl p-2 ms-3">설치</div>
                    <div class="col-3 fs-sm-2 border-bl p-2 ms-3">작성자</div>
                    <div class="input-group date col me-auto" id="datetimepicker_comment" data-target-input="nearest" data-bs-auto-close="inside">
                        <input type="text" id="calendar_text_comment" class="form-control datetimepicker-input border-bl bg-white fs-sm-2" data-target="#datetimepicker_comment" name="date" value="<?php echo $date; ?>" readOnly />
                        <div class="input-group-append" data-target="#datetimepicker_comment" data-toggle="datetimepicker">
                            <div class="input-group-text btn_calendar_2" id="calendar_comment" onclick="calendar_btn(1)"><i class="fa fa-calendar m-auto"></i></div>
                        </div>
                    </div>
                </div>
                <textarea class="form-control col" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                <div class="text-end mb-3 col-3 align-center">
                    <button type="submit" class="btn btn-outline-primary fs-7 w-100 h-100 mt-1">작성</button>
                </div>
                <div class="my-3 row">
                    <input type="text" id="file_comment" class="col me-3 border-bl fs-sm-2 p-1" readonly="readonly">
                    <label class="btn btn-outline-info fs-sm-2 col-2" for="input-file">
                        업로드
                    </label>
                    <input type="file" id="input-file" style="display:none" onchange="javascript:document.getElementById('file_comment').value = this.value.split('\\')[this.value.split('\\').length-1]" />
                </div>
            </form>
            <!-- Single comment-->
            <div class="d-flex mt-4 comments">
                <div class="ms-4">
                    <div class="fw-bold fs-sm-2 mb-1 commenter">
                        홍길동
                        <span class="fw-normal fs-sm-1 comments_purpose">설치</span>
                        <span class="fw-normal fs-sm-1 comments_time">2022.02.16</span>
                        <span class="btn btn-outline-info fw-normal fs-sm-1 float-end p-1 commments_file">첨부파일</span>
                    </div>
                    If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                </div>
            </div>
        </div>

        <script>
        </script>
    </form>
</div>