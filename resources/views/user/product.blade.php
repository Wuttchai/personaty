@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >
     <div class="col-md-10" id="dsds">
         <div class="card card-default ">
             <div class="card-header card text-center bg-warning">สินค้า</div>

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
   </div>

</div>

@endsection

@push('scripts')
<script>
document.getElementById("loader").style.display = "none";

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
           "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Thai.json"
       }
    } );
} );
</script>
@endpush
