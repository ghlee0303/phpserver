
        $(function () {
            $('#datetimepicker1').datetimepicker({
                locale: moment.locale('ko'),
                format: 'YYYY.MM.DD'
            });
        });
        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: moment.locale('ko'),
                format: 'YYYY.MM.DD'
            });
        });
        function init() {
            var date = document.querySelectorAll('.datetimepicker-input');

            date.forEach(function(e){ 
                e.value = null;
            });
        }