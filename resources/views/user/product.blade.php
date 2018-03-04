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
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
          <li class="divider"></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <div class="col-sm-6 col-md-6 text-right">
        <form class="navbar-form" role="search">
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="ค้นหา" name="q">
            <div class="input-group-btn ">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
    </div>
    <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span></a></li>
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



@if (session('carsTableList') != null)
<div class="col-lg-2" >
</div>
<div class="col-lg-8" >
    <div class="card card-default ">
        <div class="card-header card text-center bg-danger">ตระกร้าสินค้า</div>

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
              &nbsp;&nbsp; <button  type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button>
               </td>
            </tr>
<?php $num ++; ?>
             @endforeach

          </tbody>
          <tfoot>
             		<tr>
             			<td colspan="3">&nbsp;</td>
             			<td>Subtotal</td>
             			<td><?php echo "s" ?></td>
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
          @foreach ($products as $key1 => $product)

            {{ csrf_field() }}
          <a href="#" class="text-dark">

            <div class="col-lg-3 col-md-6  mb-12 " style="padding: 5px;">



                <img src="<?php echo "product/".$products[$key1]->Pro_img ?>" alt="xxx" class="img-thumbnail">
<div class="card h-100">
<br>
                <p class="text-center">{{ $products[$key1]->Pro_Name }}</p>
                <div class="row">
<div class=" col-md-6 ">

<p>{{ $products[$key1]->Pro_Price }} บาท<p>
</div>
</a>
<div class=" col-md-6 text-right">
  <input type="text" name="quantity" v-model="quantity" size="2" />
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


    }
  })
</script>
@endpush
