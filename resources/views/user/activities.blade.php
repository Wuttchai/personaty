@extends('layouts.app')
@section('content')

   <div class="row">
       <div class="col-md-12">

<?php Counter::showAndCount('activit') ?>


<hr width=80% size=3>


   <div class="row">
     <div class="col-md-6 col-md-offset-3">
       <div class="text-center">
         <h2>ข่าวกิจกรรม</h2>
       </div>
       <hr>
     </div>
   </div>



<div class="row">
   @foreach ($hotnews as $key1 => $hotnew)

   <a href="#" class="list-group-item">
         <div class="media col-md-3">
             <figure class="pull-left">
                 <img class="media-object img-rounded img-responsive" src="<?php echo "hotnew/".$hotnews[$key1]->Hotnews_img ?>"  >
             </figure>
         </div>
         <div class="col-md-9">
            <br>
             <h4 class="list-group-item-heading"> {{ $hotnews[$key1]->Hotnews_name }} </h4>
             <p class="list-group-item-text">{{ $hotnews[$key1]->Hotnews_detail }}</p>

              <h5> <span class="glyphicon glyphicon-calendar"></span>{{ $hotnews[$key1]->datefirst }}
              @if($hotnews[$key1]->datelast)
             - {{ $hotnews[$key1]->datelast }}</p>
              @endif
                     </h5>
         </div>

   </a>

@endforeach
 </div>
 <br>
<div class="row text-center">


       <div class="col-md-12 text-center">
         <div class="ficon">
                       {{ $hotnews->links() }}
                     </div>
       </div>
   </div>









<br>
<br>
       </div>
   </div>

@endsection
@push('scripts')

@endpush
