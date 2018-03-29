@extends('layouts.offcialapp')
@section('content')


<div class="container"  id="information"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

       <div class="col-md-12" id="dsds">
           <div class="card card-default ">
               <div class="card-header card text-center bg-info">จัดการข้อมูลวันที่เข้าเยี่ยม</div>
               <div class="card-header card ">


               </div>
               <div class="card-body" >
<div class="row">


    <div class="col-md-6" id="text">
    <div class="card card-cascade">

  <!--Card image-->
  <div class="view gradient-card-header blue-gradient">
  <div class="card-header card text-center bg-info"> กรอกข้อมูลวันที่ </div>

  </div>
  <!--/Card image-->

  <!--Card content-->
  <div class="card-body text-center" >
  <form action="/official/calender/add" method="post" class="form-group">
  {{ csrf_field() }}
  หมายเหตุ :
  <br />
<input type="text" name="name" placeholder="หมายเหตุการหยุด.." value="{{ old('name') }}"/>
@if ($errors->has('name'))
<br>
    <span class="text-danger">
        <strong>{{ $errors->first('name')  }}</strong>
    </span>
@endif
  <br /><br />
  วันที่เริ่ม :
  <br />
   <input type="text" name="datefirst"  id="datelast2" placeholder="วันที่เริ่ม.." class="datepicker" value="{{ old('datefirst') }}"/>
   @if ($errors->has('datefirst'))
   <br>
       <span class="text-danger">
           <strong>{{ $errors->first('datefirst')  }}</strong>
       </span>
   @endif
  <br /><br />
  วันที่สิ้นสุด :
  <br />

 <input type="text" name="datelast" id="datelast" class="datepicker" placeholder="วันที่สิ้นสุด.." value="{{ old('datelast') }}"/>
 @if ($errors->has('datelast'))
 <br>
     <span class="text-danger">
         <strong>{{ $errors->first('datelast')  }}</strong>
     </span>
 @endif
   <br /><br />
   <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary"/>
  </form>

  </div>



  </div>
  </div>

  <div class="col-md-6" >
<div  id='calendar'></div>
</div>
</div>
 @if(session('modalshow') == 'active')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">แก้ไขข้อมูลวันที่เข้าเยี่ยม</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 text-center">
              <form action="/official/calender/update{{ $info[0]->cal_id }}" method="post" class="form-group">
              {{ csrf_field() }}
              หมายเหตุ :
              <br />

            <input type="text" name="nameedit" value="{{ $info[0]->cal_name }}"/>
            @if ($errors->has('nameedit'))
            <br>
                <span class="text-danger">
                    <strong>{{ $errors->first('nameedit')  }}</strong>
                </span>
            @endif
              <br /><br />
              วันที่เริ่ม :
              <br />

<input type="text" name="datefirstedit" id="datelast" class="datepicker"  value="{{ $info[0]->cal_date }}" />
<input type="text" name="datefirstedit2"  value="{{ $info[0]->cal_date }}" hidden/>
@if ($errors->has('datefirstedit'))
<br>
    <span class="text-danger">
        <strong>{{ $errors->first('datefirstedit')  }}</strong>
    </span>
@endif
              <br /><br />
              วันที่สิ้นสุด :
              <br />
<input type="text" name="datelastedit" id="datelast2" class="datepicker"  value="{{ $info[0]->cal_last }}" />
<input type="text" name="datelastedit2"  value="{{ $info[0]->cal_last }}" hidden/>
@if ($errors->has('datelastedit'))
<br>
    <span class="text-danger">
        <strong>{{ $errors->first('datelastedit')  }}</strong>
    </span>
@endif
               <br /><br />

            </div>
          </div>

        </div>
        <div class="modal-footer">
          <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary"/>
         </form>
          <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                        document.getElementById('delete-form').submit();" >ลบ</button>
                        <form id="delete-form" action="/official/calender/delete{{$info[0]->cal_id }}" method="post" style="display: none;">
                            @csrf
                        </form>
        </div>
      </div>

    </div>
  </div>
  @endif
  @if(session('alert') == 'บันทึกข้อมูลเรียบร้อย!')
  <?php
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("เพิ่มข้อมูลเรียบร้อย!","","success");';
    echo '}, 1000);</script>';
  ?>
  @endif
  @if(session('alert') == 'แก้ไขข้อมูลเรียบร้อย!')
  <?php

    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("แก้ไขข้อมูลเรียบร้อย!","","success");';
    echo '}, 1000);</script>';
  ?>
  @endif
  @if(session('alert') == 'ลบเรียบร้อย!')
  <?php
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("ลบข้อมูลเรียบร้อย!","","success");';
    echo '}, 1000);</script>';
  ?>
  @endif
</div>
</div>



@endsection
@push('scripts')

<script>
document.getElementById("loader").style.display = "none";
  $(document).ready(function() {
      $('#calendar').fullCalendar({
        events : [
              @foreach($tasks as $task)
              {
                  title : '{{ $task->cal_name }}',
                  start : '{{ $task->cal_date }}',
                  color: 'red',

                  end:     '{{ $task->cal_last }}',

                  url : '/official/calender/detail{{ $task->cal_id }}',
                  displayEventTime: false
              },
              @endforeach
          ]});
           // uppercase H for 24-hour clock、

           $('.datepicker').datepicker({
               format: 'dd/mm/yyyy',
               todayBtn: true,
               language: 'th',
               thaiyear: true
           }).datepicker();
           $('.datepicker2').datepicker({
               format: 'dd/mm/yyyy',
               todayBtn: true,
               language: 'th',
               thaiyear: true
           }).datepicker();

           @if(session('modalshow') == 'active' && !$errors->first('name') && !$errors->first('datefirst') && !$errors->first('datelast'))

           $('#myModal').modal('show');



           @endif

  });


</script>
@endpush
