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
      					<h2>กระทู้สอบถาม</h2>
      				</div>
      				<hr>
      			</div>
      		</div>
          <!-- /.row -->
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
            <input type="text" class="form-control" placeholder="<?php echo  Session::get('search'); ?>" name="q">
            <div class="input-group-btn ">
                <button class="btn btn-default" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
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
          <div class="col-sm-4">
  <div class="panel panel-default">
  <div class="panel-heading">
  <strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
  </div>
  <div class="panel-body">
  Panel content
  </div><!-- /panel-body -->
  </div><!-- /panel panel-default -->
  </div>
  <div class="col-sm-4">
<div class="panel panel-default">
<div class="panel-heading">
<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
</div>
<div class="panel-body">
Panel content
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div>
  <div class="col-sm-4 ">
<div class="panel panel-default">
<div class="panel-heading">
<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
</div>
<div class="panel-body">
Panel content
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div>
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
