<!DOCTYPE html>
<html>
<head>
    <title>Datepicker for Bootstrap By javascriptthai</title>
    <meta charset="utf-8" />

    <script src="/js/jquery-2.1.3.min.js"></script>



   <link href="/css/bootstrap-datepicker.css" rel="stylesheet" />
   <script src="/js/bootstrap-datepicker-custom.js"></script>
   <script src="/js/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>


    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script>
</head>
<body>

    <label for="inputdatepicker" class="col-md-2 control-label">datepicker</label>
    <div class="col-md-3">
        <input id="inputdatepicker" class="datepicker" data-date-format="mm/dd/yyyy">
    </div>
</body>
</html>
