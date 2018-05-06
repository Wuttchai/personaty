
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
      					<h2></h2>
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
                      <small class="pull-right">วันที่: {{ $date[0]->Prosell_creat }}</small>
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
                      <strong>{{ $date[0]->address_name }}</strong><br>
                      <h5 >ที่อยู่ : {{ $date[0]->address_at }} ต.{{ $date[0]->address_tumbon }} อ.{{ $date[0]->address_aumpor }}</h5>
                      <h5 > จ.{{ $date[0]->address_province }}
                      เบอร์โทร: {{ $date[0]->address_tel }}</h5>

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

                  <div class="col-xs-6">
                    <p class="lead">วันที่ : {{ $date[0]->Prosell_creat }}</p>

                    <div class="table-responsive">
                      <table class="table">

                        <tr>
                          <th>รวมราคาทั้งหมด :</th>
                          <td>{{ number_format($totalPirce) }}บาท</td>
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


<img src="{{ 'http://project3.test/ProductCardetail/' . $date[0]->Prosell_img }}" class="img-rounded"  width="500" height="350">

      </div>
      <div class="modal-footer">
        <div class="col-md-1">
          <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        </div>

          <button type="button" class="btn btn-warning" v-on:click="showabout()">ไม่อนุมัติการสั่งซื้อ</button>
          <button type="button" class="btn btn-primary" v-on:click="cleardata()">อนุมัติการสั่งซื้อ</button>
      </div>

    </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">กรุณาใส่หมายเลขพัสดุเพื่ออนุมัติการสั่งซื้อ </h4>
      </div>
      <div class="modal-body">


                  <div v-bind:class="{'form-group':nameerror , 'has-error has-feedback':nameerror }">

                                <label for="recipient-name" class="col-form-label">หมายเลขพัสดุ :</label>
                                  <input type="text" class="form-control"  id="name" placeholder="ใส่หมายเลขพัสดุ 13 หลัก" v-model="name"/>
                                <span class="glyphicon glyphicon-remove form-control-feedback" v-if="nameerror"></span>
                                <span class="text-errors" v-if="nameerror">
                                    <strong><h5>@{{ nameerror }}</h5></strong>
                                </span>
                            </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" v-if="buttoninsert" v-on:click="addcars({{ $date[0]->Prosell_ID }})">บันทึก</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">กรุณาใส่หมายเหตุที่ไม่อนุมัติ </h4>
      </div>
      <div class="modal-body">


                  <div v-bind:class="{'form-group':abouterror , 'has-error has-feedback':abouterror }">

                                <label for="recipient-name" class="col-form-label">หมายเหตุ :</label>
                                  <input type="text" class="form-control"  id="about" placeholder="ใส่หมายเหตุหมายเหตุในการไม่อนุมัติ" v-model="about"/>
                                <span class="glyphicon glyphicon-remove form-control-feedback" v-if="abouterror"></span>
                                <span class="text-errors" v-if="abouterror">
                                    <strong><h5>@{{ abouterror }}</h5></strong>
                                </span>
                            </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" v-if="buttoninsert" v-on:click="addabout({{ $date[0]->Prosell_ID }})">บันทึก</button>
      </div>
    </div>

  </div>
</div>
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
        <div class="col-xs-9">
          <a href="/official/productsell"  class="btn btn-danger "><i class="fa fa-mail-reply-all"></i> ย้อนกลับ</a>
</div>
<div class="col-xs-2">
           <a href="/invoice-print/{{$date[0]->Prosell_ID}}" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> ปริ้นใบสั่งซื้อ</a>
</div>
<div class="col-xs-1">
           <a data-toggle="modal" data-target="#exampleModal" class="btn btn-success pull-left"><i class="glyphicon glyphicon-zoom-in"></i> ดูใบเสร็จการโอนเงิน</a>
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
        'name'      :'',
        'nameerror' :'',
        'buttoninsert':true,
        'about':'',
        'abouterror':'',

    },

    computed: {

  },
    methods: {


           addcars: function (event) {
             information.buttoninsert = false ;
             information.nameerror = false ;
             axios.post('/emsadd', {
                id : event,
               quantity : information.name,
             }).then(function (response) {
if (response.data.messages != null) {
  if(response.data.messages.quantity != null){
information.nameerror = true;
information.nameerror = response.data.messages.quantity[0];
  }
information.buttoninsert = true ;
}else if (response.data[0] == 'true') {
  information.buttoninsert = true ;
  information.nameerror = true;
  information.nameerror = response.data[1];
}else {
  swal("สำเร็จ!","หมายเลขพัสดุถูกเพิ่มแล้ว","success").then(function (response) {
    if (response == true) {
location.reload();
    }

  });
}
                });
           },
           showabout: function () {
                     information.abouterror = false;
                      $("#myModal2").modal('show');
                   },
           cleardata: function () {
                     information.nameerror = false;
                      $("#myModal").modal('show');
                   },
                   addabout: function(event) {


                           axios.post('/emsadd', {
                             id : event,
                            about : information.about,
                            status : 'delete',
                           }).then(function (response) {
              if (response.data.messages != null) {
                if(response.data.messages.about != null){
              information.abouterror = true;
              information.abouterror = response.data.messages.about[0];
                }
              information.buttoninsert = true ;
              }else {
                swal("สำเร็จ!","หมายเหตุในการไม่อนุมัติถูกเพิ่มแล้ว","success").then(function (response) {
                  if (response == true) {
          location.reload();
                  }

                });
              }
                              });




           },




    }
  })
</script>
@endpush
