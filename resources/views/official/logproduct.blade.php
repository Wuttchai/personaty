@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >
     <div class="card card-default ">
         <div class="card-header card text-center bg-info">รายงานข้อมูลการสั่งซื้อสินค้า</div>

<div class="card-header card ">



</div>


         <div class="card-body" >

<div class="row">
<div class="col-md-12" style="overflow-x:auto;">

  <table id="example" class="display nowrap" cellspacing="0" >
      <thead>
          <tr>
            <th class="text-center">ชื่อผู้ซื้อ</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวนสินค้า</th>
            <th>ราคารวม</th>
            <th>วันที่ส่งสินค้า</th>
          </tr>
      </thead>
    
      <tbody>

<?php $totalprice = 0 ;?>

          @foreach($logfile as $value)
                          <tr>
                            <td class="text-center">{{$value->address_name}}</td>
                            <td class="text-center">{{$value->Pro_Name}}</td>
                            <td class="text-center">{{$value->Det_Num}} ชิ้น</td>
                            <td class="text-center">{{number_format($value->Pro_Price * $value->Det_Num)}} บาท</td>
                            <td class="text-center">{{$value->Prosell_senddate}}</td>
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
