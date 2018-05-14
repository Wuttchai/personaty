@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >
     <div class="col-md-10" id="dsds">
         <div class="card card-default ">
             <div class="card-header card text-center bg-warning">รายงานจำนวนคนเข้าดูเว็ปไซต์</div>

           </div>
</div>
           <br>
            <br>
             <br>
             <div class="row">
               <div class="col-md-10">



   </div>

 </div>

       </div>


<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">จำคนเข้าดูในแต่ละหน้า</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">จำคนเข้าดูเว็บไซต์</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">{!!$chartjs->render()!!}</div>
  <div class="tab-pane container fade" id="menu1">...</div>

</div>
   </div>

</div>

@endsection

@push('scripts')
<script>
document.getElementById("loader").style.display = "none";

$(document).ready(function() {

});
</script>
@endpush
