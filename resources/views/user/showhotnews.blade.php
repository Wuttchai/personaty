@extends('layouts.app')
@section('content')

   <div class="row">
       <div class="col-md-12">




<hr width=80% size=3>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h2>{{ $hotnew[0]->Hotnews_name }}</h2>
    </div>
    <hr>
  </div>

</div>


            <div class="row ">
              <div class="col-md-12 ">
 <img src="{{ asset('hotnew/' . $hotnew[0]->Hotnews_img) }}">

<h5> {{ $hotnew[0]->Hotnews_detail }}</h5>

               </div>

</div>




<br>
<br>
       </div>
   </div>

@endsection
@push('scripts')

@endpush
