<?php
/*다운로드, 검색 버튼 클릭 시 날짜 판별 코드 작성할 것*/
?>

<div class="row text-center">
    <span class="col-sm-4 ">
        <div class="form-group" data-bs-auto-close="inside">
            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input fs-5" data-target="#datetimepicker1"/>
                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                    <div class="input-group-text btn_calendar" onclick="date_compare()"><i class="fa fa-calendar m-auto"></i></div>
                </div>
            </div>
        </div>
    </span>
    <span class="col-sm-4">
        <div class="form-group">
            <div class="input-group date" id="datetimepicker2" data-target-input="nearest" data-bs-auto-close="inside">
                <input type="text" class="form-control datetimepicker-input fs-5" data-target="#datetimepicker2"/>
                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                    <div class="input-group-text btn_calendar" onclick="date_compare()"><i class="fa fa-calendar m-auto"></i></div>
                </div>
            </div>
        </div>
    </span>
    <span class="float-end col"></span>
        <button type="button" class="btn btn-warning me-2 fs-4 w-btn" onclick="init()">초기화</button>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'L'
            });
        });
        $(function () {
            $('#datetimepicker2').datetimepicker({
                format: 'L'
            });
        });
        function init() {
            var date = document.querySelectorAll('.datetimepicker-input');

            date.forEach(function(e){ 
                e.value = null;
            });
        }
        
    </script>
</div>