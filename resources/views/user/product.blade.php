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

          <nav class="navbar navbar-default fixed-top-2" role="navigation">
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
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">


      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ประเภทสินค้า <b class="caret"></b></a>

        <ul class="dropdown-menu" >
          <li><a href="#">เฟอนิเจอร์</a></li>
          <li><a href="ProductAyutaya">ของฝาก</a></li>

        </ul>

      </li>
    </ul>
    <div class="col-sm-6 col-md-6 text-right">
        <form class="navbar-form" role="search"  method="GET">
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="<?php echo  Session::get('search'); ?>" name="q">
            <div class="input-group-btn ">
                <button class="btn btn-default" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
            </div>
        </div>
        </form>
    </div>
    <ul class="nav navbar-nav navbar-right">
   <li><a ><span  v-on:click="showcars()" class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span></a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">กรองราคาสินค้า <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">ถูกไปหาเเพง</a></li>
          <li><a href="#">เเพงไปหาถูก</a></li>
          <li><a href="#">ต่ำกว่า 1000</a></li>
            <li><a href="#">สูงกว่า 1000</a></li>
          <li class="divider"></li>
          <li><a href="#">คืนค่า</a></li>
        </ul>
      </li>

    </ul>
  </div><!-- /.navbar-collapse -->
</nav>



@if (Cart::content() != null)
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
              <th>ราคาสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
<?php $num =1; ?>

          @foreach (Cart::content() as $key1 => $product)

            <tr>
              <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
              <td>{{ $product->name }}</td>
              <td>&nbsp;{{ $product->price }} บาท</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $product->qty }} ชิ้น</td>
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
             			<td>Subtotal</td>
             			<td><?php echo Cart::subtotal(); ?></td>
             		</tr>
             		<tr>
             			<td colspan="3">&nbsp;</td>
             			<td>Tax</td>
             			<td><?php echo Cart::tax(); ?></td>
             		</tr>
             		<tr>
             			<td colspan="3">&nbsp;</td>
             			<td>Total</td>
             			<td><?php echo Cart::total(); ?></td>
             		</tr>
             	</tfoot>
        </table>
        <div class="col-lg-12 text-center">
        <form action="" method="POST" class="side-by-side">
                              {!! csrf_field() !!}
                              <input type="submit" class="btn btn-success btn-sm " value="ยืนยันการซื้อ">
                          </form>
  </div>
      </div>

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


          <a href="#" class="text-dark">

            <div class="col-lg-3 col-md-6  mb-12 " style="padding: 5px;">



                <img src="<?php echo "product/".$products[$key1]->Pro_img ?>" alt="xxx" class="img-thumbnail">
<div class="card h-100">
<br>
                <p class="text-center"><?php echo $products[$key1]->Pro_Name ?></p>
                <div class="row">
<div class=" col-md-6 ">

<p>{{ $products[$key1]->Pro_Price }} บาท<p>
</div>
</a>
<div class=" col-md-6 text-right">
  <select   v-model="quantity">

                                        <option v-for="n in <?php echo $products[$key1]->Pro_Count ?>" >@{{ n }}</option>

                                    </select>

<button type="button"  v-on:click="addcars(<?php echo $products[$key1]->Pro_ID ?>)" class="btn btn-default btn-md btn-warning" ><span class="glyphicon glyphicon-shopping-cart"></button>

</div>

</div>


</div>
<div class="card-footer">
                  <small class="text-dark">&#9733; &#9733; &#9733; &#9733; &#9734;</small>

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
        'seach' : <?php if (Session::get('search')== null ) {echo 'true';}else {echo 'false';} ?>,
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



      axios.post('http://project3.test/Productaddcars', {
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


               axios.post('http://project3.test/Productdeletecars', {
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
