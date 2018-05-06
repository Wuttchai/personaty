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
        <th scope="col">ราคารวม</th>
        <th scope="col">สถานะ</th>
        <th scope="col">หมายเหตุ</th>
        <th scope="col">วันที่สั่งซื้อสินค้า</th>
        <th scope="col">วันที่จัดส่ง</th>
        <th scope="col">การจัดการ</th>
      </tr>
    </thead>
    <tbody>
      <?php $num = 1;  ?>
    @foreach($CarOrders as $Car)

      <tr>
        <td>{{ $num }}</td>
        <td>{{ number_format($Car->Prosell_totalPirce)}} บาท</td>

        <td>{{ $Car->Prosell_send}}</td>
        <td>{{ $Car->Prosell_about}}</td>
        <td>{{ $Car->Prosell_creat}}</td>
        <td>{{ $Car->Prosell_senddate}}</td>
        <td>


@if($Car->Prosell_send == 'ค้างชำระ')
<a href="/ProductCarorderdetail/<?php echo $Car->Prosell_ID ?>" clas>  <button  type="button"  class="btn btn-warning"><i class="material-icons">ชำระเงิน </i></button></a>
<a href="/ProductCarorderdelete/<?php echo $Car->Prosell_ID ?>" clas>  <button  type="button"  class="btn btn-danger"><i class="material-icons">ลบข้อมูล </i></button></a>
@else
<a href="/ProductCardetail/<?php echo $Car->Prosell_ID ?>" clas>  <button  type="button"  class="btn btn-primary"><i class="material-icons">รายละเอียด </i></button></a>
@endif





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
       </div>

<br>
<br>
@endsection

@push('scripts')
<script>



document.getElementById("loader").style.display = "none";


</script>
@endpush
