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
      					<h2>สินค้าวิชาชีพ</h2>
      				</div>
      				<hr>
      			</div>
      		</div>

          <nav class="navbar navbar-default fixed-top-2" role="navigation" style="border-color:red">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
    <ul class="nav navbar-nav" >


      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ประเภทสินค้า <b class="caret"></b></a>

        <ul class="dropdown-menu" >
          <li><a href="/ProductAyutaya?type=เฟอนิเจอร์">เฟอนิเจอร์</a></li>
          <li><a href="/ProductAyutaya?type=ของฝาก">ของฝาก</a></li>
          <li class="divider"></li>
          <li><a href="/ProductAyutaya">ค่าเริ่มต้น</a></li>

        </ul>

      </li>
    </ul>
    <div class="col-sm-6 col-md-6 text-right">
        <form class="navbar-form" role="search"  method="GET">
        <div class="input-group ">
            <input type="text" class="form-control " style="border-color:red" placeholder="<?php echo  Session::get('search'); ?>" name="q">
            <div class="input-group-btn ">
                <button class="btn btn-danger btn-outline" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
            </div>
        </div>
        </form>
    </div>
    <ul class="nav navbar-nav navbar-right">

   <li><a ><span  v-on:click="showcars()" class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span>  <span class="badge badge-notify ">{{ Cart::content()->count() }}</span></a></li>




      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">กรองราคาสินค้า <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="/ProductAyutaya?price=ASC">ถูกไปหาเเพง</a></li>
          <li><a href="/ProductAyutaya?price=DESC">เเพงไปหาถูก</a></li>
          <li><a href="/ProductAyutaya?price=one">ต่ำกว่า 1000</a></li>
            <li><a href="/ProductAyutaya?price=two">สูงกว่า 1000</a></li>
          <li class="divider"></li>
          <li><a href="/ProductAyutaya">ค่าเริ่มต้น</a></li>
        </ul>
      </li>

    </ul>
  </div><!-- /.navbar-collapse -->
</nav>



@if (Cart::content() != null  && Cart::content() != "[]")
<div class="col-lg-2" >
</div>
<div class="col-lg-8" v-if="cars">
    <div class="card card-default ">
        <div   class="card-header card text-center bg-danger">ตระกร้าสินค้า</div>

        <table class="table table-borderless ">
          <thead>
            <tr>
              <th scope="col">ลำดับ</th>
              <th>ชื่อสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>ราคาสินค้า</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
<?php $num =1; ?>

          @foreach (Cart::content() as $key1 => $product)

            <tr>
              <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
              <td>{{ $product->name }}</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $product->qty }} ชิ้น</td>
              <td>&nbsp;{{ $product->price }} บาท</td>

              <td>
              &nbsp;&nbsp; <button  type="button"  class="btn btn-danger" v-on:click="deletecars('<?php echo $key1 ?>')"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button>
               </td>
            </tr>

<?php $num ++; ?>
             @endforeach
          </tbody>
          <tfoot>
             		<tr>
             			<td colspan="3">&nbsp;</td>
             			<td>ราคาสินค้าทั้งหมด :</td>
             			<td><?php echo Cart::subtotal(); ?> บาท</td>
             		</tr>

             	</tfoot>
        </table>
        <div class="col-lg-12 text-center">

          <form class="navbar-form"  action="/cart/confrimadd" method="get" >

                              {!! csrf_field() !!}
                              <input type="submit" class="btn btn-success btn-sm " value="บันทึกข้อมูลการสั่งซื้อ">
                          </form>
  </div>
      </div>
      @if(session('alert'))
      <?php
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("มีรายการสั่งซื้อสินค้าอยู่!","กรุณาตรวจสอบรายการสั่งซื้อที่เมนูข้อมูลการสั่งซื้อ","error");';
        echo '}, 1000);</script>';
      ?>
      @endif
</div>
@endif

 <div class="col-lg-12 ">
   <br>

      <div class="row ">

        @if($products == "[]")
        <div class="alert alert-danger text-center" role="alert">
 <strong>ไม่มีชื่อสินค้าที่ค้นหา !</strong>   กรุณาตรวจสอบข้อมูลที่กรอกอีกครั้ง
 </div>
        @endif
          @foreach ($products as $key1 => $product)
          <div class="col-md-4">

                <div class="thumbnail">
                    <br>
                  <img src="<?php echo "product/".$products[$key1]->Pro_img ?>" style="width:260px; height:146px;" class="img-responsive">
                  <div class="caption">
                    <h4 class="pull-right">{{ $products[$key1]->Pro_Price }} บาท</h4>
                    <h4 ><a href="#" class="text-dark">{{ $products[$key1]->Pro_Name }} </a></h4>
                    <p>{{ $products[$key1]->Pro_Detail }}</p>
                  </div>

                  <div class="space-ten"></div>
                  <div class="btn-ground text-right">
                    <select   v-model="quantity">
                      <option v-for="n in <?php echo $products[$key1]->Pro_Count ?>" >@{{ n }}</option>
                      </select>
                      <button type="button"  v-on:click="addcars(<?php echo $products[$key1]->Pro_ID ?>)" class="btn btn-default btn-md btn-warning" ><span class="glyphicon glyphicon-shopping-cart"></button>
                      <button type="button"  v-on:click="detail(<?php echo $products[$key1]->Pro_ID ?>)" class="btn btn-primary" ><i class="fa fa-search"></i>รายละเอียด</button>
                  </div>
                  <div class="space-ten"></div>
                </div>
              </div>
      @endforeach
        </div>
        </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <div class="modal fade product_view" id="product_view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                    <h3 class="modal-title">@{{Pro_Name }}</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 product_img">
                            <img :src="'{{asset('product')}}/' +  Pro_img "  class="img-responsive" style="width:425px; height:529px;"/>
                        </div>
                        <div class="col-md-6 product_content">

                            <p>รายละเอียดสินค้า : @{{ Pro_Detail }}</p>
                            <p>ประเภทสินค้า : @{{ Pro_Type }}</p>
                            <p>จำนวนสินค้า : @{{ Pro_Count }} ชิ้น</p>
                            <h3 class="cost">ราคาสินค้า : @{{ Pro_Price }} บาท</h3>


                            <div class="space-ten"></div>
                            <div class="btn-ground">
                                <button type="button" v-on:click="addcars(Pro_ID)" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart" ></span> Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">


           <div class="col-md-12 text-center">
             <div class="ficon">
                           {{ $products->links() }}
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
        'Pro_Count':'',
        'Pro_Detail':'',
        'Pro_ID':'',
        'Pro_Name':'',
        'Pro_Price':'',
        'Pro_Type':'',
        'Pro_img':'',


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
           detail: function (event) {

             var product_id =	event;

              var link = "/product/view/" + product_id;
              axios.get(link, {
              }).then(function (response) {

        information.Pro_Detail = response.data[0].Pro_Detail
        information.Pro_ID = response.data[0].Pro_ID
        information.Pro_Name = response.data[0].Pro_Name
        information.Pro_Price = response.data[0].Pro_Price
        information.Pro_Type = response.data[0].Pro_Type
        information.Pro_img = response.data[0].Pro_img
        information.Pro_Count = response.data[0].Pro_Count
$("#product_view").modal('show');



})

           },

    }
  })
</script>
@endpush
