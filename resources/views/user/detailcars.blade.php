@extends('layouts.app')

@section('content')
<div class="container"  id="information"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">



          <div class="row">
      			<div class="col-md-6 col-md-offset-3">
      				<div class="text-center">
      					<h2>รายละเอียดการสั่งซื้อสินค้า</h2>
      				</div>
      				<hr>
      			</div>
      		</div>
          <!-- /.row -->
          <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <i class="fa fa-globe"></i> ใบสั่งซื้อสินค้า
                      <small class="pull-right">วันที่: {{ Session::get('date') }}</small>
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    จาก
                    <address>
                      <strong>เรือนจำจังหวัดพระนครศรีอยุธยา.</strong><br>
                      เลขที่ 123, หมู่ที่ 3<br>
                      ต.หันตรา, อ.พระนครศรีอยุธยา<br>

                      จังหวัดพระนครศรีอยุธยา, 13000<br>
                      เบอร์โทร: 035 709 113<br>

                    </address>
                  </div>
                  <!-- /.col -->

                  <div class="col-sm-4 invoice-col">
                    ถึง
                    <address>
                      <strong>{{ Auth::user()->User_Name }}</strong><br>
                      {{ Auth::user()->User_Address }}<br>
                      เบอร์โทร: {{ Auth::user()->User_Tel }}<br>
                      อีเมลล์: {{ Auth::user()->email }}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">

                    <address>
                      <strong>เลขที่ใบเสร็จสินค้า #007612</strong><br><br>
                        รหัสการสั่งซื้อ: {{ $date[0]->Prosell_ID }}<br>
                        วันที่ซื้อ: {{ $date[0]->Prosell_creat }}<br>
                        ชื่อผู้ซื้อ:  {{ Auth::user()->User_Name }}
                    </address>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">


                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อชิ้น</th>
                        <th>ราคารวม</th>

                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $num =1;
                        $totalPirce =0;
                        ?>

                                  @foreach ($Car as $product )

                                    <tr>
                                      <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
                                      <td>{{ $product->Pro_Name }}</td>
                                      <td>&nbsp;{{ $product->Det_Num }} ชิ้น</td>
                                      <td>&nbsp;{{ $product->Pro_Price }} บาท</td>
                                      <td>&nbsp;{{ $product->Det_Num * $product->Pro_Price }} บาท</td>

                                    </tr>

                        <?php
                        $num ++;
                        $totalPirce += $product->Det_Num * $product->Pro_Price;
                        ?>
                                     @endforeach

                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-6">

                  </div>

                  <div class="col-xs-6">
                    <p class="lead">วันที่ : {{ Session::get('date') }}</p>

                    <div class="table-responsive">
                      <table class="table">

                        <tr>
                          <th>รวมราคาทั้งหมด :</th>
                          <td>{{ $totalPirce }}บาท</td>
                        </tr>

                      </table>
                    </div>


                  </div>
                  <!-- /.col -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ใบเสร็จการโอนเงิน: วันที่โอนเงิน({{ $date[0]->Prosell_orderdate }}) </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">

<img src=" <?php echo "Receipt/".$date[0]->Prosell_img ?>" class="img-rounded"  width="500" height="350" />

      </div>

    </div>
  </div>
</div>


                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
        <div class="col-xs-9">
          <a href="/ProductCarOrders"  class="btn btn-danger "><i class="fa fa-print"></i> ย้อนกลับ</a>
</div>
<div class="col-xs-2">
           <a href="/invoice-print" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> ปริ้นใบสั่งซื้อ</a>
</div>
<div class="col-xs-1">
           <a data-toggle="modal" data-target="#exampleModal" class="btn btn-success pull-left"><i class="fa fa-print"></i>ดูใบเสร็จการโอนเงิน</a>
</div>

        </div>
      </div>
              </section>
        </div>
        <!-- /.col-lg-12 -->

      </div>
      <!-- /.row -->

    </div>


       </div>

<br>
<br>
@endsection

@push('scripts')
<script>



document.getElementById("loader").style.display = "none";

var information =  new Vue({
    el: '#information',
    data: {
        'id'  :'',
        'quantity' :1,
        'cars' : false,
        'seach' : <?php if (Session::get('search') == 'ค้นหา' || Session::get('search') == null ) {echo 'true';}else {echo 'false';} ?>,
        'cancelsearch' :<?php if (Session::get('search')!='ค้นหา' && Session::get('search')!= null ) {echo 'true';}else {echo 'false';} ?>,



    },

    computed: {

  },
    methods: {


           addcars: function (event) {


    swal({
title: 'คุณแน่ใจ !',
text: 'คุณต้องการเพิ่มลงตร้าใช่ไหม',
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'ยืนยัน',
cancelButtonText : 'ยกเลิก',
closeOnConfirm: false




}).then(function (e) {



      axios.post('/Productaddcars', {
         id : event,
        quantity : information.quantity,
      }).then(function (response) {

location.reload();
         });
      swal(
        'ถูกเพิ่มเเล้ว !',
        'สินค้าของคุณถูกเพิ่มแล้ว.',
        'success'
      )

    }, function (dismiss) {

      // dismiss can be 'cancel', 'overlay',
      // 'close', and 'timer'
      if (dismiss === 'cancel') {
        swal(
          'ยกเลิกเเล้ว',
          'ไฟล์ที่คุณเลือกปลอดภัย :)',
          'error'
        )
      }
    })
           },


           deletecars: function (event) {

                 swal({
             title: 'คุณแน่ใจ !',
             text: 'คุณต้องการเพิ่มลงตร้าใช่ไหม',
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'ยืนยัน',
             cancelButtonText : 'ยกเลิก',
             closeOnConfirm: false




             }).then(function (e) {


               axios.post('/Productdeletecars', {
                  id : event,

               }).then(function (response) {

  location.reload();
                  });

                   swal(
                     'ถูกเพิ่มเเล้ว !',
                     'สินค้าของคุณถูกเพิ่มแล้ว.',
                     'success'
                   )

                 }, function (dismiss) {

                   // dismiss can be 'cancel', 'overlay',
                   // 'close', and 'timer'
                   if (dismiss === 'cancel') {
                     swal(
                       'ยกเลิกเเล้ว',
                       'ไฟล์ที่คุณเลือกปลอดภัย :)',
                       'error'
                     )
                   }
                 })

           },
           showcars: function () {
             if (this.cars == true) {
               this.cars = false;
             }else {
               this.cars = true;
             }

           },

    }
  })
</script>
@endpush
