@extends('layouts.offcialapp')

@section('content')
<div class="container"   >

   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">



          <div class="row">
      			<div class="col-md-12 text-center">
							<div class="card">
 				         <div class="card-header">Category</div>
 				         <div class="card-body ">
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



</script>
@endpush
