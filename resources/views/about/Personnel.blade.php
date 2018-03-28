@extends('layouts.app')

@section('content')
<div class="container"   >

   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="text-center">
                <h2>ทำเนียบผู้บริหาร</h2>
              </div>
              <hr>
            </div>
          </div>
          @if($about != '[]')

          <div class="item">

<img src=" <?php echo "about/".$about[0]->Person_Num ?>" class="img-rounded">


  </div>
  @endif
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
