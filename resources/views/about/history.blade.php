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
                <h2>ประวัติความเป็นมา</h2>
              </div>
              <hr>
            </div>
          </div>

          <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ประวัติความเป็นมาของบริษัทเริ่มต้นในปี พ.ศ. 2419 เราพบกับพ่อค้าวัย 28 ปีที่สนใจวิทยาศาสตร์อย่าง ฟริทซ์ เฮงเค็ล ในวันที่ 26 กันยายน ค.ศ. 1876 เขาและหุ้นส่วนอีกสองคนได้ร่วมก่อตั้ง          </h5>

                      <h5>บริษัทเฮงเค็ล แอนด์ ซี ที่เมืองอาเคิน และปล่อยผลิตภัณฑ์ตัวแรกออกสู่ตลาดนั่นคือ ผงซักฟอกเอนกประสงค์ที่มีส่วนผสมหลักของซิลิเกตช่วงหลายปีต่อมา กลุ่มผู้ประกอบการธุรกิจแบบครอบครัวชาว</h5>

          <h5>เยอรมนีกลุ่มนี้ร่วมกับพนักงานกว่าพันชีวิตได้ก่อร่างสร้างเฮงเค็ลให้ก้าวสู่บริษัทระดับโลก เฮงเค็ล ประเทศไทยเริ่มดำเนินธุรกิจในปี พ.ศ. 2515 และปัจจุบันมีสองกลุ่มธุรกิจ คือธุรกิจผลิตภัณฑ์ดูแลความ</h5>

        <h5>งามและธุรกิจเทคโนโลยีกาว</h5>

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
