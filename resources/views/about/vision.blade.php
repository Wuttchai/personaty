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
                <h2>วิสัยทัศน์และพันธกิจ</h2>
              </div>
              <hr>
            </div>
          </div>
<h4><i class="fa fa-circle-o" style="font-size:24px;color:red"></i> วิสัยทัศน์ <i class="fa fa-circle-o" style="font-size:24px;color:red"></i></h4>
<br>
      <h5 >เรือนจำจังหวัดพระนครศรีอยุธยา เป็นเรือนจำส่วนภูมิภาค ที่มีความมั่นคง ปลอดภัย มีประสิทธิภาพในการควบคุม แก้ไข และพัฒนาพฤตินิสัยผู้ต้องขัง</h5>
  <br>

      <h4><i class="fa fa-circle-o" style="font-size:24px;color:red"></i> พันธกิจ <i class="fa fa-circle-o" style="font-size:24px;color:red"></i></h4>

      <div class="row">
        <div class="col-md-12 ">

<h5 >1.	ควบคุมผู้ต้องขังให้สอดคล้องกับพันธกิจกรมราชทัณฑ์อย่างมืออาชีพ</h5>
<h5 >2.	ร่วมมือกันในองค์กรและกับภาคส่วนภายนอก บำบัดฟื้นฟู และแก้ไขพฤตินิสัยของผู้ต้องขังอย่างมีประสิทธิภาพ</h5>
<h5 >3.	รวมพลังกันในองค์กรและภาคส่วนภายนอกในการแก้ไขปัญหายาเสพติด ให้ได้ผลอย่างยั่งยืน</h5>
<h5 >4.	พัฒนาเสริมสร้างบุคลากรในองค์กรให้มีความเป็นมืออาชีพ</h5>
<h5 >5.	พัฒนาระบบบริหารจัดการงานภายในองค์กรโดยยึดหลักธรรมาภิบาล</h5>
</div>
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

</script>

@endpush
