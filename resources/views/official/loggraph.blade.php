@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >
     <div class="col-md-10" id="dsds">
         <div class="card card-default ">
             <div class="card-header card text-center bg-warning">กราฟรายงานข้อมูลการจัดการ</div>

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
       {!! $chartjs->render()  !!}
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
