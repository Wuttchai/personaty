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
                      เลขที่บัญชี : xxxxx-xxxx-xxxx

                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">



                      ถึง<button type="button" class="btn btn-warning btn-sm pull-right" v-if="btnedit2" v-on:click='edit'>
            <span class="glyphicon glyphicon-edit"></span> จัดการข้อมูล
          </button>

          <button type="button" class="btn btn-danger btn-sm pull-right" v-if="btnedit3" v-on:click="deleteinfo()">
          <span class="fa fa-remove"></span> ลบ
          </button>  <p class="pull-right" style="padding-left: 10px;"> </p>
          <button type="button" class="btn btn-warning btn-sm pull-right"  v-if="btnedit3" v-on:click="showinfo()">
          <span class="fa fa-cog"></span> แก้ไข
          </button>


          <p class="pull-right" style="padding-left: 10px;"> </p>

          <button type="button" class="btn btn-success btn-sm pull-right"  data-toggle="modal" v-if="btnedit3" data-target="#exampleModal">
          <span class="glyphicon glyphicon-plus"></span> เพิ่มผู้รับสินค้า
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">กรุณากรอกข้อมูลผู้รับสินค้า</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">

                    <div v-bind:class="{'form-group':nameediterror , 'has-error has-feedback':nameediterror }">
                      <label for="exampleInputEmail1">ชื่อ-นามสกุล *</label>
                      <input type="text" class="form-control"  v-model="nameedit" required>
                  <span class="glyphicon glyphicon-remove form-control-feedback" v-if="nameediterror"></span>
                                  <span class="text-errors" v-if="nameediterror">
                                      <strong><h5>@{{ nameediterror }}</h5></strong>
                                  </span>
                  </div>


         	</div>
<div class="form-group">
            <div v-bind:class="{'form-group':addressediterror , 'has-error has-feedback':addressediterror }">
              <label for="exampleInputAddress">บ้านเลขที่ *</label>
           		<input class="form-control"  v-model="addressedit" ></input>
  <span class="glyphicon glyphicon-remove form-control-feedback" v-if="addressediterror"></span>
                          <span class="text-errors" v-if="addressediterror">
                              <strong><h5>@{{ addressediterror }}</h5></strong>
                          </span>
	</div>
         	</div>

         	<div class="form-group">

            <div v-bind:class="{'form-group':tumbonediterror , 'has-error has-feedback':tumbonediterror }">
              <label for="exampleInputPhone">ตำบล *</label>
              <input type="text" class="form-control" v-model="tumbonedit"  required>
          <span class="glyphicon glyphicon-remove form-control-feedback" v-if="tumbonediterror"></span>
                          <span class="text-errors" v-if="tumbonediterror">
                              <strong><h5>@{{ tumbonediterror }}</h5></strong>
                          </span>
          </div>


         	</div>
         	<div class="form-group">

            <div v-bind:class="{'form-group':aumporediterror , 'has-error has-feedback':aumporediterror }">
              <label for="exampleInputPhone">อำเภอ *</label>
              <input type="text" class="form-control" v-model="aumporedit"  required>
          <span class="glyphicon glyphicon-remove form-control-feedback" v-if="aumporediterror"></span>
                          <span class="text-errors" v-if="aumporediterror">
                              <strong><h5>@{{ aumporediterror }}</h5></strong>
                          </span>
          </div>


         	</div>
         	<div class="form-group">

            <div v-bind:class="{'form-group':provinceediterror , 'has-error has-feedback':provinceediterror }">
              <label for="exampleInputPhone">จังหวัด *</label>
             <input type="text" class="form-control" v-model="provinceedit"  required>
          <span class="glyphicon glyphicon-remove form-control-feedback" v-if="provinceediterror"></span>
                          <span class="text-errors" v-if="provinceediterror">
                              <strong><h5>@{{ provinceediterror }}</h5></strong>
                          </span>
          </div>


         	</div>
         	<div class="form-group">

            <div v-bind:class="{'form-group':zipcodeediterror , 'has-error has-feedback':zipcodeediterror }">
              <label for="exampleInputPhone">รหัสไปรษณีย์ *</label>
              <input type="text" class="form-control" v-model="zipcodeedit"  maxlength="5" required>
          <span class="glyphicon glyphicon-remove form-control-feedback" v-if="zipcodeediterror"></span>
                          <span class="text-errors" v-if="zipcodeediterror">
                              <strong><h5>@{{ zipcodeediterror }}</h5></strong>
                          </span>
          </div>


         	</div>
         	<div class="form-group">

            <div v-bind:class="{'form-group':telediterror , 'has-error has-feedback':telediterror }">
              <label for="exampleInputPhone">เบอร์โทรศัพท์ *</label>
              <input type="text" class="form-control" v-model="teledit"  required>
          <span class="glyphicon glyphicon-remove form-control-feedback" v-if="telediterror"></span>
                          <span class="text-errors" v-if="telediterror">
                              <strong><h5>@{{ telediterror }}</h5></strong>
                          </span>
          </div>


         	</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                  <button type="button" v-on:click='insertaddress(<?php echo $Prosell_ID ?>)' class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
              </div>
            </div>
          </div>

                      <address>

                        <div v-if="btnselect">
                          @csrf

                      <div class="form-group row">
                      <div class="form-group">
                      <label for="exampleFormControlTextarea1">ชื่อ-นามสกุล </label>

                      <select class="form-control" name="name"  v-on:click="editaddress($event)">
                        <option :value="n.id"   v-for="n in listadd" >@{{ n.text }} </option>
                        </select>
                      </div>
                      </div>
                          <div class="form-group row">
                            <div class="form-group">
                      <label for="exampleFormControlTextarea1">ที่อยู่จัดส่ง</label>
                      <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" readonly>@{{listaddname}}</textarea>
                      </div>
                      <button type="button" class="btn btn-default btn-sm " v-if="btnedit" v-on:click='edit2'>
                      <span class="fa fa-mail-reply-all"></span> ย้อนกลับ
                      </button>  <p class="pull-right" style="padding-left: 10px;"> </p>
                      <button  class="btn btn-primary btn-sm pull-right" v-if="btnedit" v-on:click='insertadduser({{ $Prosell_ID }} ,$event)'>
                      <span class="glyphicon glyphicon-saved"></span> บันทึก
                      </button>
                      </div>

                    </div>

                        <strong v-if="btnedit2">ชื่อ : {{ $userdetail[0]->address_name }}</strong> <br v-if="btnedit2">

                        <h5 v-if="btnedit2">ที่อยู่ : {{ $userdetail[0]->address_at }} ต.{{ $userdetail[0]->address_tumbon }} อ.{{ $userdetail[0]->address_aumpor }}</h5>
                        <h5 v-if="btnedit2"> จ.{{ $userdetail[0]->address_province }}
                        เบอร์โทร: {{ $userdetail[0]->address_tel }}</h5>

                      </address>
                    </div>

                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">

                    ข้อมูลคนสั่งซื้อ
                                        <address>
                                        <strong> {{ Auth::user()->User_Name }} </strong><br>
                                      <h5 >  อีเมลล์: {{ Auth::user()->email }}</h5>
                                        <h5 >เบอร์โทร: {{ $userdetail[0]->address_tel }}</h5>
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

                                  @foreach ($Car as $product)

                                    <tr>
                                      <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
                                      <td>{{ $product->Pro_Name }}</td>
                                      <td>&nbsp;{{ $product->Det_Num }} ชิ้น</td>
                                      <td>&nbsp;{{ number_format($product->Pro_Price) }} บาท</td>
                                      <td>&nbsp;{{ number_format($product->Det_Num * $product->Pro_Price) }} บาท</td>

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
                  <!-- /.col -->
                  <div class="col-xs-6">


                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">ราคาสินค้าทั้งหมด :</th>
                          <td>{{  number_format($Car[0]->Det_total) }} บาท</td>
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



                <!-- this row will not appear when printing -->
                <div class="row no-print">
        <div class="col-xs-9">
          <a href="/Product/delete"  class="btn btn-danger "><i class="fa fa-remove"></i> ยกเลิก</a>
</div>
<div class="col-xs-2">
           <a href="/invoice-print/{{$Prosell_ID}}" target="_blank" class="btn btn-primary pull-right"></i><i class="fa fa-print"></i> ปริ้นใบสั่งซื้อ</a>
</div>
<div class="col-xs-1">
           <button type="button"  class="btn btn-success pull-left" data-toggle="modal" data-target="#myModal"></i><i class="glyphicon glyphicon-floppy-open"></i> ยืนยันการสั่งซื้อ</button>

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
               <h4 class="modal-title">กรุณาเพิ่มใบเสร็จการโอนเงิน</h4>
             </div>
             <div class="modal-body">
               <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                   <div class="text-center">
                     <h2>เพิ่มใบเสร็จการโอนเงิน</h2>
                     <h4>เลขที่บัญชีของเรือนจำ : xxxxx-xxxx-xxxx </h4>
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
       <div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaledit" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลผู้รับสินค้า</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <div class="form-group">

                 <div v-bind:class="{'form-group':nameediterror , 'has-error has-feedback':nameediterror }">
                   <label for="exampleInputEmail1">ชื่อ-นามสกุล *</label>
                   <input type="text" class="form-control"  v-model="nameedit2" required>
               <span class="glyphicon glyphicon-remove form-control-feedback" v-if="nameediterror"></span>
                               <span class="text-errors" v-if="nameediterror">
                                   <strong><h5>@{{ nameediterror }}</h5></strong>
                               </span>
               </div>


       </div>
       <div class="form-group">
         <div v-bind:class="{'form-group':addressediterror , 'has-error has-feedback':addressediterror }">
           <label for="exampleInputAddress">บ้านเลขที่ *</label>
           <input class="form-control"  v-model="addressedit2" ></input>
       <span class="glyphicon glyphicon-remove form-control-feedback" v-if="addressediterror"></span>
                       <span class="text-errors" v-if="addressediterror">
                           <strong><h5>@{{ addressediterror }}</h5></strong>
                       </span>
       </div>
       </div>

       <div class="form-group">

         <div v-bind:class="{'form-group':tumbonediterror , 'has-error has-feedback':tumbonediterror }">
           <label for="exampleInputPhone">ตำบล *</label>
           <input type="text" class="form-control" v-model="tumbonedit2"  required>
       <span class="glyphicon glyphicon-remove form-control-feedback" v-if="tumbonediterror"></span>
                       <span class="text-errors" v-if="tumbonediterror">
                           <strong><h5>@{{ tumbonediterror }}</h5></strong>
                       </span>
       </div>


       </div>
       <div class="form-group">

         <div v-bind:class="{'form-group':aumporediterror , 'has-error has-feedback':aumporediterror }">
           <label for="exampleInputPhone">อำเภอ *</label>
           <input type="text" class="form-control" v-model="aumporedit2"  required>
       <span class="glyphicon glyphicon-remove form-control-feedback" v-if="aumporediterror"></span>
                       <span class="text-errors" v-if="aumporediterror">
                           <strong><h5>@{{ aumporediterror }}</h5></strong>
                       </span>
       </div>


       </div>
       <div class="form-group">

         <div v-bind:class="{'form-group':provinceediterror , 'has-error has-feedback':provinceediterror }">
           <label for="exampleInputPhone">จังหวัด *</label>
          <input type="text" class="form-control" v-model="provinceedit2"  required>
       <span class="glyphicon glyphicon-remove form-control-feedback" v-if="provinceediterror"></span>
                       <span class="text-errors" v-if="provinceediterror">
                           <strong><h5>@{{ provinceediterror }}</h5></strong>
                       </span>
       </div>


       </div>
       <div class="form-group">

         <div v-bind:class="{'form-group':zipcodeediterror , 'has-error has-feedback':zipcodeediterror }">
           <label for="exampleInputPhone">รหัสไปรษณีย์ *</label>
           <input type="text" class="form-control" v-model="zipcodeedit2"  maxlength="5" required>
       <span class="glyphicon glyphicon-remove form-control-feedback" v-if="zipcodeediterror"></span>
                       <span class="text-errors" v-if="zipcodeediterror">
                           <strong><h5>@{{ zipcodeediterror }}</h5></strong>
                       </span>
       </div>


       </div>
       <div class="form-group">

         <div v-bind:class="{'form-group':telediterror , 'has-error has-feedback':telediterror }">
           <label for="exampleInputPhone">เบอร์โทรศัพท์ *</label>
           <input type="text" class="form-control" v-model="teledit2"  required>
       <span class="glyphicon glyphicon-remove form-control-feedback" v-if="telediterror"></span>
                       <span class="text-errors" v-if="telediterror">
                           <strong><h5>@{{ telediterror }}</h5></strong>
                       </span>
       </div>


       </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
               <button type="button" v-on:click='updateaddress(<?php echo $Prosell_ID ?>)' class="btn btn-primary">บันทึกการแก้ไข</button>
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
        'btnedit':false,
        'btnedit2':true,
        'btnedit3':false,
        'btnselect':false,
        'btneditform':false,
        'listadd':[

    ],
'listaddname':'',
'nameedit':'',
'addressedit':'',
'tumbonedit':'',
'aumporedit':'',
'provinceedit':'',
'zipcodeedit':'',
'teledit':'',
'nameedit2':'',
'addressedit2':'',
'tumbonedit2':'',
'aumporedit2':'',
'provinceedit2':'',
'zipcodeedit2':'',
'teledit2':'',
'nameediterror':false,
'addressediterror':false,
'tumbonediterror':false,
'aumporediterror':false,
'provinceediterror':false,
'zipcodeediterror':false,
'telediterror':false,
'addressid':'',

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
          swal(
            'บันทึกข้อมูล !',
            'คุณได้เพิ่มใบเสร็จโอนเงินเรียบร้อยเเล้ว.',
            'success'
          ).then(function (response) {
            if (response == true) {
    window.location.href = '/ProductCarOrders';
            }

          });


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


},
edit: function () {

  var link = "/user/showaddres";

  axios.get(link, {
  }).then(function (response) {

    var text = response.data[0].address_at +" ต."+ response.data[0].address_tumbon+" อ."+ response.data[0].address_aumpor+" จ."+ response.data[0].address_province+" ปณ."+ response.data[0].address_zipcode+" โทร."+ response.data[0].address_tel;



for (let i=0; i<response.data.length; i++) {
  var textloop = response.data[i].address_at +" ต."+ response.data[i].address_tumbon+" อ."+ response.data[i].address_aumpor+" จ."+ response.data[i].address_province+" ปณ."+ response.data[i].address_zipcode+" โทร."+ response.data[i].address_tel;

  information.listadd.push({
         id: [i],
       })
  information.listadd[i].text = response.data[i].address_name;
  information.listadd[i].value = response.data[i].address_name;
  information.listadd[i].addressid = response.data[i].address_id;
  information.listadd[i].address = textloop;

}
information.addressid = response.data[0].address_id;
information.listaddname=text;
information.btnedit2= false;
information.btnedit3= true;
information.btnedit= true;
information.btnselect= true;
  })

           },
           insertadduser: function (event ,event2) {

axios.post('/user/editsendcon'+event, {
    idaddres: information.addressid,

  }).then(function (response) {
 location.reload();
});
           },

           edit2: function () {
     this.btnedit= false;
             this.btnedit2= true;
             this.btnselect= false;
this.btnedit3= false;
this.listadd=[];

           },
           editaddress: function (event) {

               var targetId = event.currentTarget.value;
               information.listaddname=information.listadd[targetId].address;

               information.addressid = information.listadd[targetId].addressid;
           },
           insertaddress: function (event) {

             information.addressediterror = false;
            information.aumporediterror = false;
            information.nameediterror = false;
            information.provinceediterror = false;
            information.telediterror = false;
            information.tumbonediterror  = false;
            information.zipcodeediterror = false;

             axios.post('/user/editsend/'+event, {

                 name:information.nameedit,
                 address:information.addressedit,
                 tumbon:information.tumbonedit,
                 aumpor:information.aumporedit,
                 province:information.provinceedit,
                 zipcode:information.zipcodeedit,
                 tel:information.teledit,
               }).then(function (response) {
                 if (response.data.messages != null) {
                 if(response.data.messages.address != null){
                 information.addressediterror = true;
                 information.addressediterror = response.data.messages.address[0];
                 }
                 if(response.data.messages.aumpor != null){
                 information.aumporediterror = true;
                 information.aumporediterror= response.data.messages.aumpor[0];
                 }
                 if(response.data.messages.name != null){
                 information.nameediterror = true;
                 information.nameediterror = response.data.messages.name[0];
                 }
                 if(response.data.messages.province != null){
                 information.provinceediterror = true;
                 information.provinceediterror = response.data.messages.province[0];
                 }
                 if(response.data.messages.tel != null){
                 information.telediterror = true;
                 information.telediterror = response.data.messages.tel[0];
                 }
                 if(response.data.messages.tumbon != null){
                 information.tumbonediterror  = true;
                 information.tumbonediterror  = response.data.messages.tumbon[0];
                 }
                  if(response.data.messages.zipcode != null){
                  information.zipcodeediterror = true;
                  information.zipcodeediterror = response.data.messages.zipcode[0];
                  }
                 }else {
                   location.reload();
}
                 });
           },
           showinfo: function () {
var addressid =	information.addressid;
var link = "/showinfo/address"+addressid;

axios.get(link, {
}).then(function (response) {

information.nameedit2 = response.data[0].address_name;
information.addressedit2= response.data[0].address_at;
information.tumbonedit2= response.data[0].address_tumbon;
information.aumporedit2= response.data[0].address_aumpor;
information.provinceedit2= response.data[0].address_province;
information.zipcodeedit2= response.data[0].address_zipcode;
information.teledit2= response.data[0].address_tel;

$("#exampleModaledit").modal('show');

})
           },
           updateaddress: function (event) {

      information.addressediterror = false;
     information.aumporediterror = false;
     information.nameediterror = false;
     information.provinceediterror = false;
     information.telediterror = false;
     information.tumbonediterror  = false;
     information.zipcodeediterror = false;

      axios.post('/update/infoaddress/'+event, {
          idaddress:information.addressid,
          name:information.nameedit2,
          address:information.addressedit2,
          tumbon:information.tumbonedit2,
          aumpor:information.aumporedit2,
          province:information.provinceedit2,
          zipcode:information.zipcodeedit2,
          tel:information.teledit2,
        }).then(function (response) {
          if (response.data.messages != null) {
          if(response.data.messages.address != null){
          information.addressediterror = true;
          information.addressediterror = response.data.messages.address[0];
          }
          if(response.data.messages.aumpor != null){
          information.aumporediterror = true;
          information.aumporediterror= response.data.messages.aumpor[0];
          }
          if(response.data.messages.name != null){
          information.nameediterror = true;
          information.nameediterror = response.data.messages.name[0];
          }
          if(response.data.messages.province != null){
          information.provinceediterror = true;
          information.provinceediterror = response.data.messages.province[0];
          }
          if(response.data.messages.tel != null){
          information.telediterror = true;
          information.telediterror = response.data.messages.tel[0];
          }
          if(response.data.messages.tumbon != null){
          information.tumbonediterror  = true;
          information.tumbonediterror  = response.data.messages.tumbon[0];
          }
           if(response.data.messages.zipcode != null){
           information.zipcodeediterror = true;
           information.zipcodeediterror = response.data.messages.zipcode[0];
           }
          }else {
            location.reload();
 }
 })
           },
           deleteinfo: function () {


swal({
title: 'คุณแน่ใจ !',
text: 'คุณจะไม่สามารถกู้คืนไฟล์ที่ลบนี้ได้',
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'ยืนยัน',
cancelButtonText : 'ยกเลิก',
closeOnConfirm: false




}).then(function () {

  axios.get('/deleteinfo/address'+information.addressid, {
    }).then(function (response) {
var erroradd = response.data;
  if (erroradd == 'true') {
    swal(
      'ไม่อนุญาติ',
      'กรุณาเก็บข้อมูลผู้รับสินค้าไว้อย่างน้อย1คน ',
      'error'
    )
  }else {
    location.reload();
  }
  });
  if (erroradd != 'true') {
  swal(
    'ถูกลบเเล้ว !',
    'ไฟล์ของคุณถูกลบแล้ว.',
    'success'
  )
}
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
    }
  })
</script>
@endpush
