@extends('layouts.app')

@section('content')
<div class="container"   >

   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">



            <div class="topnav" style="background-color: #DCDCDC;">
        <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-2">
        <div class="dropdown">
        <button onclick="myFunction1()" class="dropbtn" style="background-color: #ef0e0e;">เรียงตาม<i class="fa fa-angle-down"></i></button>
        <div id="myDropdown1" class="dropdown-content">
          <a href="/webboard?type=การเยี่ยมผู้ต้องขัง">การเยี่ยมผู้ต้องขัง</a>
          <a href="/webboard?type=การซื้อสินค้า">การซื้อสินค้า</a>
          <a href="/webboard?type=การเตรียมเอกสาร">การเตรียมเอกสาร</a>
          <a href="/webboard">ค่าเริ่มต้น</a>

        </div>
        </div>

        </div>
        <div class="col-md-4">
        <div class="search-container">
        <form class="navbar-form" role="search"  method="GET">
        <div class="input-group ">
            <input type="text" class="form-control " style="border-color:red" placeholder="<?php echo  Session::get('search'); ?>" name="q">
            <div class="input-group-btn ">
                <button class="btn btn-danger btn-outline" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
            </div>
        </div>
        </form>
        </div>
        </div>
        <div class="col-md-2 pull-right">

            <a><button type="button" class="btn btn-danger btn-outline" v-on:click="open()">ตั้งกระทู้
          </button></a>
        

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
