@extends('layouts.app')

@section('content')
<div class="container"   >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" id="information">

     <div class="container">




        <!-- /.col-lg-3 -->




          <div class="row">
      			<div class="col-md-12 text-center">
      				<div class="text-center">
      					<h2>{{ $product[0]->Pro_Name }}</h2>
      				</div>
      				<hr>
      			</div>
      		</div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-6 text-center">

              @if (Cart::content() != null  && Cart::content() != "[]")
              @isset(Cart::content()->groupBy('name')[$product[0]->Pro_Name][0]->name)
                @if (Cart::content()->groupBy('name')[$product[0]->Pro_Name][0]->name == $product[0]->Pro_Name)
              <?php  $product[0]->Pro_Count = $product[0]->Pro_Count-Cart::content()->groupBy('name')[$product[0]->Pro_Name][0]->qty; ?>

                @endif

                @endisset

              @endif
<a id="Zoom-1" class="MagicZoom" title="Show your product in stunning detail with Magic Zoom."
                     href="<?php echo "/product/".$product[0]->Pro_img ?>"
                 >
                     <img src="<?php echo "/product/".$product[0]->Pro_img ?>" style="height:300px"/>
                 </a>

               </div>
               <div class="row">
                 <div class="col-md-6 text-center">
                   <p>รายละเอียดสินค้า : {{ $product[0]->Pro_Detail }}</p>
                   <p>ประเภทสินค้า : {{ $product[0]->Pro_Type }}</p>
                   <p>จำนวนสินค้า : {{ $product[0]->Pro_Count }} ชิ้น</p>
                   <h3 class="cost">ราคาสินค้า : {{ number_format($product[0]->Pro_Price) }} บาท</h3>


                   <div class="space-ten"></div>
                   <div class="btn-ground">

                     @if ($product[0]->Pro_Count != 0 )
                     <select v-model="items[<?php echo '0' ?>].<?php echo $product[0]->Pro_Name?>">
                       <option v-for="n in <?php echo $product[0]->Pro_Count ?>" >@{{ n }} </option>
                       </select>
                         @endif
                           @if ($product[0]->Pro_Count != 0 )
                       <button type="button"  v-on:click="addcars(<?php echo $product[0]->Pro_ID ?>,'<?php echo $product[0]->Pro_Name ?>','0')" class="btn btn-default btn-md btn-primary" ><span class="glyphicon glyphicon-shopping-cart">เพิ่มลงตระกร้า</button>
                           @endif
                           @if ($product[0]->Pro_Count == 0 )
                       <button   class="btn btn-default btn-md btn-danger" >สินค้าหมด</button>
                           @endif

                   </div>
             </div>
 </div>

      </div>
      <!-- /.row -->
      <br>
      <br>
      <div class="row no-print">
  <div class="col-xs-9">
  <a href="/ProductAyutaya"  class="btn btn-danger "><i class="fa fa-mail-reply-all"></i> ย้อนกลับ</a>
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

        'items': [

      { '<?php echo $product[0]->Pro_Name ?>': 1 },

    ],

    },

    computed: {

  },
    methods: {


           addcars: function (event , event2 , event3) {
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
        quantity : information.items[event3][event2],
      }).then(function (response) {


         });
      swal(
        'ถูกเพิ่มเเล้ว !',
        'สินค้าของคุณถูกเพิ่มแล้ว.',
        'success'
      ).then(function (response) {
        if (response == true) {
    window.location.href = '/ProductAyutaya'
        }

      });

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
                   if (dismiss === 'cancel') {
                     swal(
                       'ยกเลิกเเล้ว',
                       'ไฟล์ที่คุณเลือกปลอดภัย :)',
                       'error'
                     )
                   }
                 })

           },


           editcars: function (event, event2) {

            if (information.oldqtyedit[event2][event] != information.qtyedit[event2][event]) {
              axios.post('/Producteditcars', {
                 id : event,
                 qty : information.qtyedit[event2][event],
              }).then(function (response) {

              swal({
          title: 'แก้ไขจำนวนสินค้าสำเร็จ !',
          text: '',
          type: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ยืนยัน',

          closeOnConfirm: false

          }).then(function (e) {

              location.reload();
            });


   });
   }
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
