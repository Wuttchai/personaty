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
          <div class="topnav" style="background-color: #DCDCDC;">
      <div class="row">
      <div class="col-md-2">
      <br>&nbsp;&nbsp;
      <span  v-on:click="showcars()" class="glyphicon glyphicon-shopping-cart" style="font-size:20px;color:#ef0e0e"></span>  <span class="badge badge-notify ">{{ Cart::content()->count() }}</span>


      </div>
      <div class="col-md-2">
      <div class="dropdown">
      <button onclick="myFunction1()" class="dropbtn" style="background-color: #ef0e0e;">ประเภทสินค้า<i class="fa fa-angle-down"></i></button>
      <div id="myDropdown1" class="dropdown-content">
      <a href="/ProductAyutaya?type=เฟอนิเจอร์">เฟอนิเจอร์</a>
      <a href="/ProductAyutaya?type=เบเกอรี่">เบเกอรี่</a>
      <a href="/ProductAyutaya?type=ศาลพระภูมิ">ศาลพระภูมิ</a>
      <a href="/ProductAyutaya?type=ของฝาก">ของฝาก</a>
      <a href="/ProductAyutaya">สินค้าทั้งหมด</a>
      </div>
      </div>

      </div>
      <div class="col-md-4">
      <div class="search-container">
      <form class="navbar-form" role="search"  method="GET">
      <div class="input-group ">
          <input type="text" class="form-control " style="border-color:red" placeholder="<?php echo  Session::get('search'); ?>" name="q">
          <div class="input-group-btn ">
              <button class="btn btn-danger btn-outline" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
          </div>
      </div>
      </form>
      </div>
      </div>
      <div class="col-md-2 pull-right">
      <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn" style="background-color: #ef0e0e;">กรองราคาสินค้า<i class="fa fa-angle-down"></i></button>
      <div id="myDropdown" class="dropdown-content">
      <a href="/ProductAyutaya?price=ASC">ถูกไปหาเเพง</a>
      <a href="/ProductAyutaya?price=DESC">เเพงไปหาถูก</a>
      <a href="/ProductAyutaya?price=one">ต่ำกว่า 1000</a>
      <a href="/ProductAyutaya?price=two">สูงกว่า 1000</a>
      </div>
      </div>

      </div>



      </div>


          </div>



@if (Cart::content() != null  && Cart::content() != "[]")
<br>
<div class="col-lg-2" >
</div>
<div class="col-md-8" v-if="cars" style="overflow-x:auto;">
    <div class="card card-default ">
        <div class="card-header card text-center bg-danger"><h5>ตระกร้าสินค้า</h5></div>

        <table class="table table-borderless " >
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

<?php $num1 =0;  $num =1; ?>

          @foreach (Cart::content() as $key1 => $product)

            <tr>
              <th scope="row">{{ $num }}</th>
              <td>{{ $product->name }}</td>
              <td>

                <select v-model="qtyedit['<?php echo $num1?>']['<?php echo $product->rowId ?>']" @click="editcars('<?php echo $product->rowId ?>','<?php echo $num1?>')">
                  <option v-for="n in <?php echo $product->options->size ?>" >@{{ n }} </option>

                  </select>
              ชิ้น</td>
              <td>{{ number_format($product->price*$product->qty) }} บาท</td>

              <td>
              &nbsp;&nbsp; <button  type="button"  class="btn btn-danger" v-on:click="deletecars('<?php echo $key1 ?>')"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button>
               </td>
            </tr>

<?php $num1 ++;  $num ++; ?>
             @endforeach
          </tbody>
          <tfoot>
             		<tr>
             			<td colspan="6" class="text-center">
             			ราคาสินค้าทั้งหมด :<?php echo Cart::subtotal(); ?> บาท</td>
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

</div>
@endif
@if(session('alert'))
<?php
  echo '<script type="text/javascript">';
  echo "setTimeout(function () { swal('มีรายการสั่งซื้อสินค้าอยู่!','กรุณาตรวจสอบรายการสั่งซื้อที่เมนูข้อมูลการสั่งซื้อ','error').then(function (response) {
    if (response == true) {
window.location.href = '/ProductCarOrders';
    }

  });";
  echo '}, 1000);</script>';
?>
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
            @if (Cart::content() != null  && Cart::content() != "[]")
            @isset(Cart::content()->groupBy('name')[$products[$key1]->Pro_Name][0]->name)
              @if (Cart::content()->groupBy('name')[$products[$key1]->Pro_Name][0]->name == $products[$key1]->Pro_Name)
            <?php  $products[$key1]->Pro_Count = $products[$key1]->Pro_Count - Cart::content()->groupBy('name')[$products[$key1]->Pro_Name][0]->qty;  ?>

              @endif

              @endisset

            @endif
                <div class="thumbnail" style="border-color: #e80b0b" >
                    <br>

                    <div class="preview col text-center">
                   <div class="app-figure" id="zoom-fig">
                      <a id="Zoom-1" class="MagicZoom"  href="<?php echo "product/".$products[$key1]->Pro_img ?>" >
                   <img src="<?php echo "product/".$products[$key1]->Pro_img ?> " alt="" style="width: 10px;"/> </a>


                   </div>


                   </div>

                  <div class="caption">
                    <h4 class="pull-right">{{  number_format($products[$key1]->Pro_Price) }} บาท</h4>
                    <h4 ><a href="#" class="text-dark">{{ $products[$key1]->Pro_Name }} </a></h4>
                    <p>{{ $products[$key1]->Pro_Detail }}</p>
                  </div>

                  <div class="space-ten"></div>
                  <div class="btn-ground text-right">
                    @if ($products[$key1]->Pro_Count != 0 )
                    <select   v-model="items[<?php echo $key1 ?>].<?php echo $products[$key1]->Pro_Name?>">
                      <option v-for="n in <?php echo $products[$key1]->Pro_Count ?>" >@{{ n }} </option>
                      </select>
                        @endif
                          @if ($products[$key1]->Pro_Count != 0 )
                      <button type="button"  v-on:click="addcars(<?php echo $products[$key1]->Pro_ID ?>,'<?php echo $products[$key1]->Pro_Name?>','<?php echo $key1?>')" class="btn btn-default btn-md btn-warning" ><span class="glyphicon glyphicon-shopping-cart"></button>
                          @endif
                          @if ($products[$key1]->Pro_Count == 0 )
                      <button   class="btn btn-default btn-md btn-danger" >สินค้าหมด</button>
                          @endif
                    <a href="/product/view/<?php echo $products[$key1]->Pro_ID ?>"><button type="button"  v-on:click="detail()" class="btn btn-primary" ><i class="fa fa-search"></i>รายละเอียด</button></a>
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



 <div class="preview col">


<div class="app-figure" id="zoom-fig">
<a id="Zoom-1" class="MagicZoom"  href="http://project3.test/product/1523283933_5acb77ddbd314.png" >
<img src="http://project3.test/product/1523283933_5acb77ddbd314.png" alt=""/> </a>

</div>


</div>
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
function myFunction1() {
    document.getElementById("myDropdown1").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
var information =  new Vue({
    el: '#information',
    data: {
        'id'  :'',
        'qtyedit': [
        <?php  foreach (Cart::content() as $key1 => $product): ?>
      { '<?php echo $product->rowId ?>': <?php echo $product->qty ?> },
           <?php endforeach; ?>
    ],
    'oldqtyedit': [
    <?php  foreach (Cart::content() as $key1 => $product): ?>
  { '<?php echo $product->rowId ?>': '<?php echo $product->qty ?>' },
       <?php endforeach; ?>
],
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
        'items': [
          <?php foreach($products as $key1 => $product): ?>
      { '<?php echo $products[$key1]->Pro_Name ?>': 1 },
           <?php endforeach; ?>
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
    location.reload();
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
                  });
                   swal(
                     'ถูกเพิ่มเเล้ว !',
                     'สินค้าของคุณถูกเพิ่มแล้ว.',
                     'success'
                   ).then(function (response) {
                     if (response == true) {
                 location.reload();
                     }

                   });

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
