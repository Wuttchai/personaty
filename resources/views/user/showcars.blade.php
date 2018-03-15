@extends('layouts.app')

@section('content')

<div class="container" id="information">


<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

     <div class="container" >

        <div class="col-mg-12 ">

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
                        รหัสการสั่งซื้อ: {{ $Prosell_ID }}<br>
                    วันที่ซื้อ: {{ Session::get('date') }}<br>
                      ชื่อผู้ซื้อ:  {{ Auth::user()->User_Name }}
                    </address>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <table class="table text-center">
            <thead class="thead-dark ">
              <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">จำนวน</th>
                <th scope="col">ราคารวม</th>
                <th scope="col">วันที่สั่งสินค้า</th>
                <th scope="col">จัดการ</th>
              </tr>
            </thead>
            <tbody>

                        <?php
                        $num =1;
                        $totalPirce =0;
                        ?>

                                  @foreach (Cart::content() as $key1 => $product)

                                    <tr>
                                      <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
                                      <td>{{ $product->name }}</td>
                                      <td>&nbsp;{{ $product->qty }} ชิ้น</td>
                                      <td>&nbsp;{{ $product->price }} บาท</td>
                                      <td>&nbsp;{{ $product->qty * $product->price }} บาท</td>

                                    </tr>

                        <?php
                        $num ++;
                        $totalPirce += $product->qty * $product->price;
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
                  <!-- /.col -->
                  <div class="col-xs-6">


                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">ราคาสินค้าทั้งหมด :</th>
                          <td>{{ Cart::subtotal() }} บาท</td>
                        </tr>


                      </table>

                  </div>
                  <!-- /.col -->

                </div>
                <!-- /.row -->
<div class="col-md-6 col-md-offset-3">
  <div class="alert alert-info alert-dismissible">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>แนะนำ!</strong> คุณสามารถตรวจสอบการสั่งซื้อได้ที่ เมนู -> ชื่อ -> ข้อมูลการสั่งซื้อ
   </div>
   </div>

                <!-- this row will not appear when printing -->
                <div class="row no-print">
        <div class="col-xs-9">
          <a href="/ProductAyutaya"  class="btn btn-danger "><i class="fa fa-print"></i> ย้อนกลับ</a>
</div>
<div class="col-xs-2">
           <a href="/invoice-print" target="_blank" class="btn btn-primary pull-right"></i> ปริ้นใบสั่งซื้อ</a>
</div>
<div class="col-xs-1">
           <button type="button"  class="btn btn-success pull-left" data-toggle="modal" data-target="#myModal"></i> ยืนยันการสั่งซื้อ</button>

</div>

        </div>
      </div>
              </section>

        </div>
        <!-- /.col-lg-12 -->

      </div>
      <!-- /.row -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Modal Header</h4>
             </div>
             <div class="modal-body">
               <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                   <div class="text-center">
                     <h2>ใบเสร็จการโอนเงิน</h2>
                   </div>
                   <hr>
                 </div>
               </div>
               <ul class="nav  nav-pills nav-justified">
                  <li class="active"><a data-toggle="tab" href="#menu1" class="text-dark">เลือกจากไฟล์</a></li>
                  <li><a data-toggle="tab" href="#home" class="text-dark">ถ่ายภาพ</a></li>

                </ul>
                <form enctype="multipart/form-data" method="post" action="/insert/Receipt/<?php echo $Prosell_ID ?>">
        {{ csrf_field() }}
                <div class="tab-content">
                  <div id="menu1" class="tab-pane fade in active text-center">
                    <div class="row">
                      <div class="col-md-6 col-md-offset-3">
<br>
                    <div class=" text-center" id="text">


                <img id='img-upload' class="img-rounded"  width="304" height="236" />
                <hr>
                </div>
                </div>
                <div class="col-md-6 col-md-offset-3">

                          <div class="form-group">
                            <div class="form-group row">
                                          <span class="btn btn-success btn-file" >
                                              Browse… <input type="file" id="imgInp" name="imgInp" class="form-control{{ $errors->has('imgInp') ? ' is-invalid' : '' }}" >
                                          </span>
                                          <div class="form-group row">

                                          </div>
                                             <input type="text" class="form-control" readonly>
                                             @if($errors->has('imgInp'))
                                          <span class="text-errors">
                                              <strong>{{ $errors->first('imgInp') }}</strong>
                                          </span>
                                          @endif
                                      </div>
                                </div>

                              </div>
                     </div>
    </div>




                  <div id="home" class="tab-pane fade text-center">
                    <div class=" text-center" id="text2">
                      <div id="results"></div>
                    <hr>
                    </div>
  <div class="col-md-6 col-md-offset-3">

                    <h5>กล้องถ่าย</h5>
                    <div id="my_camera"></div>
</div>
                    <form>
                      <input type=button value="ถ่ายภาพ" onClick="take_snapshot()">
                    </form>
                   </div>
</div>
<br>
             <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-default" >ยันยัน</button>
             </div>
           </div>
           </form>
         </div>
       </div>
    </div>

       </div>

<br>
<br>

@endsection

@push('scripts')
<script src="{{ asset('js/text.js') }}"></script>
<script language="JavaScript">

document.getElementById("loader").style.display = "none";
document.getElementById("text").style.display = "none";
document.getElementById("text2").style.display = "none";



function take_snapshot() {
  // take snapshot and get image data
  Webcam.snap( function(data_uri) {
    console.log(data_uri);
    // display results in page
    document.getElementById('results').innerHTML =

      '<img src="'+data_uri+'"/>';

      document.getElementById("text2").style.display = "block";
  } );
}

$(document).ready( function() {
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach( '#my_camera' );


  <?php
  if ($errors->has('imgInp') != null) {

  ?>
    $("#myModal").modal('show');

  $('.nav-pills a:first').tab('show')
    <?php
  }
  if ($errors->has('imgInp2') != null) {
  ?>

  $("#myModal").modal('show');

  $('.nav-pills a:last').tab('show')
  <?php
  }
  ?>
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.form-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
            document.getElementById("text").style.display = "block";
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});

//test

    function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#img-upload2').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);

      }
    }

    $("#imgInp2").change(function(){
      readURL2(this);
    });


	});


var information =  new Vue({
    el: '#information',
    data: {
        'id'  :'',
        'quantity' :1,
        'cars' : false,
        'seach' : <?php if (Session::get('search') == 'ค้นหา' || Session::get('search') == null ) {echo 'true';}else {echo 'false';} ?>,
        'cancelsearch' :<?php if (Session::get('search')!='ค้นหา' && Session::get('search')!= null ) {echo 'true';}else {echo 'false';} ?>,
        'imgage'  :'',


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
