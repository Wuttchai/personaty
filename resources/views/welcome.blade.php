@extends('layouts.app')

@section('content')
<div class="container"   >

   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">


          <div class="container">
    <h2 class="page-header">Bootstrap Data Flow Diagram</h2>

    <div class="col-xs-12 level0">
      <p class="lead text-center bg-info btn text-info center-block">What type of email do you want to send?</p>
      <div class="row">
        <div class="col-xs-6 text-center">
          <p class="btn"><span class="glyphicon glyphicon-arrow-down"></span>
        </div>
        <div class="col-xs-6 text-center">
          <p class="btn">
            <span class="glyphicon glyphicon-arrow-down"></span></p>
        </div>
      </div>
      <div class="row level1">
        <div class="col-xs-6 text-center">
          <p class="center-block"><span class="btn btn-warning btn-lg">Designing</span></p>
          <p class="btn center-block"><span class="glyphicon glyphicon-arrow-down"></span></p>
          <p class="center-block bg-info text-info btn">Is it directly related to fundraising?</p>
          <div class="row">
            <div class="col-xs-6 text-center">
              <p class="btn"><span class="glyphicon glyphicon-arrow-down"></span>
            </div>
            <div class="col-xs-6 text-center">
              <p class="btn">
                <span class="glyphicon glyphicon-arrow-down"></span></p>
            </div>
          </div>
          <div class="row level2">
            <div class="col-xs-6">
              <p class="center-block"><span class="btn btn-success btn-lg">Yes</span></p>
              <p class="btn">
                <span class="glyphicon glyphicon-arrow-down"></span></p>
              <p class="bg-success text-success btn text-wrap">Okay! You can proceed to step 3. </p>

            </div>
            <div class="col-xs-6 text-center">
              <p class="center-block"><span class="btn btn-danger btn-lg">No</span></p>
              <p class="btn center-block"><span class="glyphicon glyphicon-arrow-down"></span></p>
              <p class="btn bg-danger text-danger text-wrap">Content must be directly related to fundraising to use this service.</p>
            </div>
          </div>
        </div>
        <div class="col-xs-6 text-center">
          <p class="center-block"><span class="btn btn-success btn-lg">Back-End</span></p>
          <p class="btn center-block"><span class="glyphicon glyphicon-arrow-down"></span></p>

          <p class="bg-success text-success btn">Okay! Proceed to step 3.</p>
        </div>
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
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction1() {
    document.getElementById("myDropdown1").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

@endpush
