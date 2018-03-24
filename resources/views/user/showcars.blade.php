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

                <div class="col-md-6 col-md-offset-3" >
                  <div class="alert alert-info alert-dismissible"v-if="guide" >
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong >แนะนำ!</strong> คุณสามารถตรวจสอบการสั่งซื้อได้ที่ เมนู -> ชื่อ -> ข้อมูลการสั่งซื้อ
                   </div>
                   </div>
                   <div class="col-md-6 col-md-offset-3" v-if="savefile">
                     <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>บันทึกข้อมูล!</strong> คุณได้เพิ่มใบเสร็จโอนเงินเรียบร้อยเเล้ว
                      </div>
                      </div>


                <!-- this row will not appear when printing -->
                <div class="row no-print">
        <div class="col-xs-9">
          <a href="/Product/delete"  class="btn btn-danger "><i class="fa fa-print"></i> ย้อนกลับ</a>
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
                  <li class="active"><a data-toggle="tab" href="#menu1" class="text-dark" v-on:click="manu1()">เลือกจากไฟล์</a></li>
                  <li><a data-toggle="tab" href="#home" class="text-dark" v-on:click="home()">ถ่ายภาพ</a></li>

                </ul>

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


                                  <span class="btn btn-success btn-file" >
                                      Browse… <input type="file" id="imgInp" v-on:change="onFileChange">
                                  </span>
                                  <div class="form-group row">

                                  </div>
                                     <input type="text" id="namefile" class="form-control" readonly>




                        </div>

                              </div>
                     </div>

    </div>




                  <div id="home" class="tab-pane fade text-center">
                    <div class="row">
                      <div class="col-md-12 text-center">
                            <h5>ถ่ายภาพ</h5>
</div>
<div class="col-md-1 ">

</div>
                        <div class="col-md-5 ">
                              <div id="my_camera"></div>
</div>
                      <div class="col-md-5 ">

  <div id="results" ref="myid">ตัวอย่างรูป</div>

  </div>
  <div class="col-md-1 ">

  </div>

  <div class="col-md-12">
    <hr>

                          <input  class="btn btn-success" type=button value="ถ่ายภาพ" onClick="take_snapshot()">

                              <br>

</div>



                     </div>

</div>
                   </div>
</div>
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="alert alert-danger text-center" role="alert" v-if="fileofficeerror">
<strong>กรุณาตรวจสอบข้อมูล !</strong>   <div >@{{ fileofficeerror }}</div>
</div>
</div>
</div>
<br>
             <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-default" v-on:click="insert(<?php echo $Prosell_ID ?>)" >ยันยัน</button>
             </div>
           </div>

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
document.getElementById("results").style.display = "none";



function take_snapshot() {
  // take snapshot and get image data
  Webcam.snap( function(data_uri) {

    // display results in page
    document.getElementById('results').innerHTML =

      '<img src="'+data_uri+'" id="xxxx"/>';

this.image2 = data_uri;

      document.getElementById("results").style.display = "block";
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

	});


var information =  new Vue({
    el: '#information',
    data: {
        'id'  :'',
        'quantity' :1,
        'cars' : false,
        'seach' : <?php if (Session::get('search') == 'ค้นหา' || Session::get('search') == null ) {echo 'true';}else {echo 'false';} ?>,
        'cancelsearch' :<?php if (Session::get('search')!='ค้นหา' && Session::get('search')!= null ) {echo 'true';}else {echo 'false';} ?>,
        'image'  :'',
        'fileofficeerror':'',
        'guide' :true,
        'savefile':false,


    },

    computed: {

  },
    methods: {


      onFileChange(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
                   return;
               this.createImage(files[0]);
           },
           createImage(file) {
               let reader = new FileReader();
               let vm = this;
               reader.onload = (e) => {
                   vm.image = e.target.result;
               };
               reader.readAsDataURL(file);

           },

           insert: function (event) {
information.fileofficeerror ="";
if (document.getElementById('results').style.cssText == "display: block;") {

  this.image = document.getElementById('xxxx').src;


}
             axios.defaults.headers.post['formData'] = 'multipart/form-data';
             axios.post('/insert/receipt', {
                 id: event,
                 fileoffice: this.image,

               }).then(function (response) {
          if (response.data.messages != null) {

          if(response.data.messages.fileoffice != null){
          information.fileofficeerror = true;
          information.fileofficeerror = response.data.messages.fileoffice[0];
          }
          }else {
          information.guide = false;
          information.savefile = true;

$("#myModal").modal('hide');
          }




                 });


           },

           manu1: function () {

  information.fileofficeerror = false;
document.getElementById('results').style.cssText = "display: none;";
this.image ="";

           },
           home: function () {

  information.fileofficeerror = false;

document.getElementById("text").style.display = "none";
document.getElementById("namefile").value = "";
this.image ="";


           }
    }
  })
</script>
@endpush
