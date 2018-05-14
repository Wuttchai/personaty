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



<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61847.46570814449!2d100.58205004640126!3d14.342387081527562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e27582c403fc33%3A0xe7cb9f1e8aee3436!2z4LmA4Lij4Li34Lit4LiZ4LiI4Liz4LiI4Lix4LiH4Lir4Lin4Lix4LiU4Lie4Lij4Liw4LiZ4LiE4Lij4Lio4Lij4Li14Lit4Lii4Li44LiY4Lii4Liy!5e0!3m2!1sth!2sth!4v1522330134482" class="img-thumbnail" style="width: 1000px; height: 700px;" allowfullscreen></iframe>


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
