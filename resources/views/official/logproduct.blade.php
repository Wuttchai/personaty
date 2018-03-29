@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >
     <div class="card card-default ">
         <div class="card-header card text-center bg-info">จัดการข้อมูลเจ้าหน้าที่</div>

<div class="card-header card ">



</div>


         <div class="card-body" >

<div class="row">
<div class="col-md-12" style="overflow-x:auto;">




  <table id="example" class="display nowrap" cellspacing="0" width="120%">
      <thead>
          <tr>
            <th>ชื่อผู้จัดการ</th>
            <th>ข้อมูลสินค้า</th>
            <th>ราคาสินค้า</th>
            <th>จำนวนสินค้า</th>
            <th>วันที่จัดการข้อมูล</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th>ชื่อผู้จัดการ</th>
              <th>ข้อมูลสินค้า</th>
              <th>ราคาสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>วันที่จัดการข้อมูล</th>

          </tr>
      </tfoot>
      <tbody>





          @foreach($logfile as $value)
                          <tr >
                            <td>{{$value->official_Name}}</td>
                            <td>{{$value->Pro_Name}}</td>
                            <td>{{$value->Pro_Price}}</td>
                            <td>{{$value->Pro_Count}}</td>
                            <td>{{$value->proupdated_at}}</td>

                          </tr>
                          @endforeach





      </tbody>
  </table>





                      </div>
                     </div>
         </div>
       </div>
   </div>

</div>

@endsection

@push('scripts')
<script>
pdfMake.fonts = {
   THSarabun: {
     normal: 'THSarabun.ttf',
     bold: 'THSarabun-Bold.ttf',
     italics: 'THSarabun-Italic.ttf',
     bolditalics: 'THSarabun-BoldItalic.ttf'
   }
}
document.getElementById("loader").style.display = "none";

$(document).ready(function() {
    $('#example').DataTable( {
      "dom": 'Bfrtip',
"buttons": [
    'copy', 'excel',
    { // กำหนดพิเศษเฉพาะปุ่ม pdf
        "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
        "text": 'PDF', // ข้อความที่แสดง
        "pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4
        "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
            // กำหนด style หลัก
            doc.defaultStyle = {
                font:'THSarabun',
                fontSize:16
            };
            // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ

            console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
        }
    }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
    'print' , 'pageLength'
]
    } );
} );
</script>
@endpush
