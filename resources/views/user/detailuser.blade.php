@extends('layouts.app')

@section('content')
<div class="container"   >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">



          <div class="row">
      			<div class="col-md-12 text-center">
      				<div class="text-center">
      					<h2>รายการสั่งซื้อสินค้า</h2>
      				</div>
      				<hr>
      			</div>
      		</div>
          <!-- /.row -->
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
      <?php $num = 1;  ?>
    @foreach($CarOrders as $Car)

      <tr>
        <td>{{ $num }}</td>
        <td>{{ $Car->Prosell_Quantity}} ชิ้น</td>
        <td>{{ $Car->Prosell_totalPirce}} บาท</td>
        <td>{{ $Car->Prosell_creat}}</td>
        <td>
@if($num == 1)
          <button  type="button"  v-on:click="editItem(item)" class="btn btn-warning"><i class="material-icons">ชำระเงิน</i></button>&nbsp;&nbsp;&nbsp;
@endif
        <a href="/ProductCardetail/<?php echo $Car->Prosell_ID ?>" clas>  <button  type="button" v-on:click="deleteItem(item)" class="btn btn-danger"><i class="material-icons">รายละเอียด</i></button></a>

        </td>

      </tr>
        <?php $num++;  ?>
  @endforeach
    </tbody>
  </table>

        </div>
        <!-- /.col-lg-12 -->
        <div class="col-sm-12">
        {{ $CarOrders->links() }}
        </div>
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


</script>
@endpush
