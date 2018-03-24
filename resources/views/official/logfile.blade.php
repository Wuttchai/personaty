@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >
     <div class="card card-default ">
         <div class="card-header card text-center bg-info">จัดการข้อมูลเจ้าหน้าที่</div>

<div class="card-header card ">



</div>


         <div class="card-body" >

<div class="row">
<div class="col-md-12" style="overflow-x:auto;">




  <table id="example" class="display nowrap" cellspacing="0" width="120%">
      <thead>
          <tr>
            <th>ชื่อผู้จัดการ</th>
            <th>ข้อมูลที่จัดการ</th>
            <th>รหัสโปรเจค</th>
            <th>การจัดการ</th>
            <th>ที่อยู่ไอพี</th>
            <th>เวลาที่จัดการ</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th>ชื่อผู้จัดการ</th>
              <th>ข้อมูลที่จัดการ</th>
              <th>รหัสโปรเจค</th>
              <th>การจัดการ</th>
              <th>ที่อยู่ไอพี</th>
              <th>เวลาที่จัดการ</th>
          </tr>
      </tfoot>
      <tbody>





          @foreach($logfile as $value)
                          <tr >
                            <td>{{$value->official_Name}}</td>
                            <td>{{$value->table_log}}</td>
                            <td>{{$value->project_log}}</td>
                            <td>{{$value->Log_Event}}</td>
                            <td>{{$value->Log_IP}}</td>
                            <td>{{$value->Log_Time}}</td>
                          </tr>
                          @endforeach





      </tbody>
  </table>





                      </div>
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
