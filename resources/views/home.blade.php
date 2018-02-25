 @extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">


<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">

    <div class="item active">
      <img src="images/1518555580_5a8351bc5e454.jpeg" alt="Los Angeles" style="width:100%;">
      <div class="carousel-caption">
        <h3>งงงงงงงงงง</h3>

      </div>
    </div>

    <div class="item">
      <img src="images/1518555580_5a8351bc5e454.jpeg" alt="Chicago" style="width:100%;">
      <div class="carousel-caption">
        <h3>ขขขขขขขขขขขข</h3>

      </div>
    </div>

    <div class="item">
      <img src="images/1518555580_5a8351bc5e454.jpeg" alt="New York" style="width:100%;">
      <div class="carousel-caption">
        <h3>กกกกกกกกกก</h3>

      </div>
    </div>

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
