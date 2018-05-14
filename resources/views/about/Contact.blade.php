@extends('layouts.app')

@section('content')
<?php Counter::showAndCount('about') ?>
<div class="container"   >

   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="text-center">
                <h2>สถานที่ตั้ง</h2>
              </div>
              <hr>
            </div>
          </div>

    <div class="col-md-12 text-center">


      <h5>๑๒๓ หมู่ ๓ ตำบลหันตรา อำเภอพระนครศรีอยุธยา  จังหวัดพระนครศรีอยุธยา  ๑๓๐๐๐  </h5>
      <h5>โทรศัพท์ ๐-๓๕๗๐-๙๑๑๓    โทรสาร ๐-๓๕๗๐-๙๑๑๑</h5>


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

</script>

@endpush
